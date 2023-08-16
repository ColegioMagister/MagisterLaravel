<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{Section,Level,SectionType,SchoolPeriod,
    Assessment,Attendance,Student,Subject,Student_has_assessments,Schedule,
    Student_in_section,TeacherSections

};

class TeacherSectionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = auth()->user();
        $school_periods = SchoolPeriod::where('status', 1)
            ->whereHas('sections', function ($query) use ($user) {
                $query->whereHas('teacherInSections', function ($query) use ($user) {
                    $query->where('id_teacher', $user->employee->id);
                });
            })
            ->get();
    
        return view('teacherView.index', [
            'school_periods' => $school_periods
        ]);
    }
    

    

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(SchoolPeriod $school_period) {
        $teacher = auth()->user();
        $levels = Level::all();
        $section_type = SectionType::all();
    
        $sections = Section::whereHas('teacherInSections', function ($query) use ($teacher) {
                $query->where('id_teacher', $teacher->employee->id);
            })
            ->whereHas('school_period', function ($query) use ($school_period) {
                $query->where('id', $school_period->id);
            })
            ->with('section_type')
            ->with('level')
            ->with('school_period')
            ->get();
    
        return view('teacherView.section', [
            'levels' => $levels,
            'section_type' => $section_type,
            'sections' => $sections,
            'school_period' => $school_period
        ]);
    }
    
    
    

  

    public function showDetails(Section $section)
{
    $section_data = $section->where('id', $section->id)
        ->with('level')
        ->with('school_period')
        ->with('section_type')
        ->first();
    $teacher = auth()->user();

    $subjectIds = TeacherSections::where('id_teacher', $teacher->employee->id)
        ->where('id_section', $section->id)
        ->pluck('id_subject'); // Obtener las IDs de las materias que el profesor enseña en la sección

    $subjects = Subject::whereIn('id', $subjectIds)->get(); // Obtener las materias correspondientes a las IDs

    return view('teacherView.subject', [
        'section' => $section_data,
        'subjects' => $subjects,
    ]);
}

    public function index2(Section $section, Subject $subject)
    {
        $assessments = Assessment::where('id_section', $section->id)
            ->where('id_subject', $subject->id)
            ->get();
            
        $schedules = Schedule::where('id_section', $section->id)
            ->where('id_subject', $subject->id)
            ->with('weekday')
            ->get();
    
        return view('teacherView.assessmentAttendaces', [
            'section' => $section,
            'subject' => $subject,
            'assessments' => $assessments,
            'schedules' => $schedules
        ]);
    }
    


    public function showAssess(Section $section , Subject $subject)
    {

        $assessments = Assessment::where('id_section', $section->id)
        ->where('id_subject', $subject->id)
        ->get();

        $studentsInSection = Student::whereHas('studentSections', function ($query) use ($section) {
            $query->where('id_section', $section->id);
        })->get();
        
        $studentsWithAssessments = Student_has_assessments::whereHas('assessment', function ($query) use ($section) {
            $query->where('id_section', $section->id);
        })
        ->with('student')
        ->whereIn('id_assessment', $assessments->pluck('id')) 
        ->get();

        $assessments = Assessment::where('id_section', $section->id)
        ->where('id_subject', $subject->id)
        ->get();
    

        return view('teacherView.assessment', [
        'section' => $section,
        'subject' => $subject,
        'students_Assessments' => $studentsWithAssessments,
        'assessments' => $assessments,
        'studentInSections'=>$studentsInSection,
        ]);
    }
    
    
    public function registerNota(Request $request) {
        
        $id_student = $request->input('id_student');
        $id_assessment = $request->input('id_assessment');
        
        // Verificar si ya existe la combinación en la tabla pivot
        $existingEntry =Student_has_assessments::where('id_student', $id_student)
            ->where('id_assessment', $id_assessment)
            ->exists();
    
        if ($existingEntry) {
            return redirect()->back()->with('error_message', 'Error!');
        }
        
        $grade = max(min($request->input('grade'), 20), 0); 
        $assessment_status = ($grade <= 12) ? 0 : 1;
        
        // Obtener el objeto de modelo Assessment usando el ID
        $assessment = Assessment::findOrFail($id_assessment);
    
        $assessment->studentAssessment()->syncWithoutDetaching([
            $id_student => [
                'grade' => $grade,
                'status' => $assessment_status,
            ],
        ]);
    
        return redirect()->back()->with('flash_message', 'Addedd!');
    }
    


    

    

 
    
  
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getAjaxStudentUpdateNota(Student $student, Assessment $assessment)
    {
        $grade=$student->studentAssessment()
            ->wherePivot('id_assessment',$assessment->id)
            ->first()->pivot->grade;

        $nameAss=$student->name;

        return response()->json([
            'grade'=>$grade,
            'nameStudent'=>$nameAss
        ]);

    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateStudentNota(Request $request, Student $student, Assessment $assessment)
    {
        $grade = max(min($request->input('grade'), 20), 0); 
        $assessment_status = ($grade <= 12) ? 0 : 1; 
    
        // Obtener la sección y el tema a través de las relaciones
        $section = $assessment->section;
        $subject = $assessment->subject;
    
        // Actualizar la relación en la tabla pivot
        $student->studentAssessment()->updateExistingPivot($assessment->id, [
            'grade' => $grade,
            'status' => $assessment_status,
        ]);
      
    
        return redirect()->route('teacherView.assessment', [
            'section' => $section,
            'subject' => $subject
        ])->with('flash_message', 'Updated!');
    }

    public function showAttendance(Section $section, Subject $subject, Schedule $schedule)
{
    $studentInSectionIds = Student_in_section::where('id_section', $section->id)->pluck('id');
    
    $studentsInSection = Student_in_section::whereIn('id', $studentInSectionIds)
    ->whereDoesntHave('attendances', function ($query) use ($schedule) {
        $query->where('id_schedule', $schedule->id);
    })
    ->with('student') 
    ->get();

    $attendanceData = Attendance::whereHas('studentSections', function ($query) use ($section) {
        $query->where('id_section', $section->id);
    })
    ->whereHas('schedules', function ($query) use ($schedule) {
        $query->where('id_schedule', $schedule->id);
    })
    ->whereIn('id_student', function ($query) use ($section, $subject) {
        $query->select('id_student')
            ->from('section_has_subjects')
            ->where('id_section', $section->id)
            ->where('id_subject', $subject->id);
    })
    ->with('schedules', 'studentSections.student')
    ->get();


    return view('teacherView.attedance', [
        'section' => $section,
        'subject' => $subject,
        'schedules' => $schedule,
        'studentsInSections' => $studentsInSection,
        'attendanceData' => $attendanceData,
    ]);
}

    

public function registerAttendance(Request $request)
{
    $scheduleId = $request->input('id_schedule');
    $attendanceData = $request->input('attendance', []);
    

    foreach ($attendanceData as $studentId => $status) {
        $attendanceStatus = isset($status) ? 1 : 0;


        Attendance::updateOrCreate(
            [
                'id_student' => $studentId,
                'id_schedule' => $scheduleId,
            ],
            [
                'status' => $attendanceStatus,
            ]
        );
    }

    return redirect()->back()->with('flash_message', 'Addedd!');
}

    
    

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }
    

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
