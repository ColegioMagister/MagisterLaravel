<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{
    Level,
    SchoolPeriod,
    Section,
    SectionType,
    Student,
    Subject,
    TeacherSections,
    Schedule,
    AssessmentType
};
use Carbon\Carbon;
use DateTime;

date_default_timezone_set("America/Lima");

class SectionController extends Controller
{
    public function index()
    {
        $school_periods = SchoolPeriod::where('status', 1)->get();

        return view('sections.index', [
            'school_periods' => $school_periods
        ]);
    }

    public function innerShow(SchoolPeriod $school_period)
    {
        $levels = Level::all();
        $section_type = SectionType::all();
        $sections = $school_period->sections()->with('school_period')
                                            ->with('section_type')
                                            ->with('level')
                                            ->get();

        return view('sections.innershow', [
            'levels' => $levels,
            'section_type' => $section_type,
            'sections' => $sections,
            'school_period' => $school_period
        ]);
    }

    
    public function getAjaxUpdate(Section $section)
    {
        return response()->json([
            'id_sectiontype' => $section->id_sectiontype,
            'id_period' => $section->id_period,
            'id_level' => $section->id_level,
            'section_name' => $section->section_name,
            'sectionType_name' => $section->section_type->section_type,
            'level_name' => $section->level->description,
        ]);
    }


    public function store(Request $request, SchoolPeriod $school_period)
    {
        Section::create([
            'id_period' => $request['id_period'],
            'id_level' => $request['id_level'],
            'id_sectiontype' => $request['id_sectiontype'],
            'section_name' => $request['section_name']
        ]);

        return redirect()->route('sections.index', $school_period)->with('flash_message', 'Addedd!');
    }


    public function show(Section $section)
    {
        $section_data = $section->where('id',$section->id)
                                ->with('level')
                                ->with('school_period')
                                ->with('section_type')
                                ->first();

        $section_students = $section->studentSections->sortByDesc('pivot.id');

        $students = Student::with('studentSections')
                            ->get()
                            ->filter(function($student){
                                return $student->studentSections->count() == 0;
                            });

        $section_subjects = $section->subjectSection()
                                    ->with(['teacherInSections' => function($query) use ($section){
                                        $query->where('id_section', $section->id)
                                            ->with('teacher:id,name,lastname');
                                    }])
                                    ->get();

        $subjects = Subject::whereNotIn('id', $section_subjects->pluck('id'))->get();

        return view('sections.show', [
            'section' => $section_data,
            'section_students' => $section_students,
            'students' => $students,
            'subjects' => $subjects,
            'section_subjects' => $section_subjects
        ]);
    }


    public function registerStudent(Request $request, Section $section)
    {
        $student_status = $request['student_active'] == 'on' ? 1 : 0;
        $student = Student::findOrFail($request['id_student_section']);

        $section->studentSections()->attach($student, [
            'status' => $student_status
        ]);

        return redirect()->route('sections.show', $section)->with('flash_message', 'Addedd!');
    }

    public function registerSubject(Request $request, Section $section)
    {
        $subject = Subject::findOrFail($request['id_subject_section']);
        $section->subjectSection()->attach($subject);
    
        return redirect()->route('sections.show', $section)->with('flash_message', 'Addedd!');
    }

    public function getAjaxStudentUpdate(Section $section, Student $student)
    {
        $status = $student->studentSections()
                ->wherePivot('id_section', $section->id)
                ->first()->pivot->status;

        $nameStr = $student->dni.' | '.$student->name.' '.$student->lastname;

        return response()->json([
            'status' => $status,
            'completeName' => $nameStr
        ]); 
    }


    public function getAjaxSubjectUpdate(Section $section, Subject $subject)
    {
        $teacher_arr = $subject->teacherSubjects()->get()->toarray();

        return response()->json([
            'content' => $teacher_arr,
        ]);
    }   
    

    public function updateStudent(Request $request, Section $section, Student $student)
    {
        $status = $request['student_active'] == 'on' ? 1 : 0;
    
        $student->studentSections()->updateExistingPivot($section, [
            'status' => $status
        ]);

        return redirect()->route('sections.show', $section)->with('flash_message', 'Updated!');
    }


    public function updateSubject(Request $request, Section $section, Subject $subject)
    {
        TeacherSections::updateOrInsert(
            ['id_subject' => $subject->id, 'id_section' => $section->id],
            ['id_teacher' => $request['id_teacher_section']]
        );

        return redirect()->route('sections.show', $section)->with('flash_message', 'Updated!');
    }


    public function update(Request $request, Section $section)
    {
        $input = $request->all();
        $school_period = $section->school_period;
        $section->update($input);

        return redirect()->route('sections.index', $school_period)->with('flash_message', 'Updated!');
    }



    public function destroy(Section $section)
    {
        $school_period = $section->school_period;
        $section->delete();

        return redirect()->route('sections.index', $school_period)->with('flash_message', 'deleted!');
    }


    public function subjectDelete(Section $section, Subject $subject)
    {
        $section->subjectSection()->detach($subject);

        return redirect()->route('sections.show', $section)->with('flash_message', 'deleted!');
    }


    public function studentDetached(Section $section, Student $student)
    {
        $student->studentSections()->detach($section);

        return redirect()->route('sections.show', $section)->with('flash_message', 'deleted!');
    }






    /* ------------ SCHEDULES METHODS --------------*/


    public function scheduleIndex(Request $request, Section $section)
    {
        if($request->ajax())
        {
            $weekDays = $section->schedules()->with('subject:id,subject_name')
                                            ->get(
                                                ['id',
                                                'id_section',
                                                'id_subject',
                                                'id_weekday',
                                                'end_datetime',
                                                'start_datetime'
                                                ])
                                                ->groupBy('id_weekday');
                                                
            $periodEndDate = new DateTime($section->school_period->end_date);
            $events = array();
                              
            foreach($weekDays as $weekday)
            {
                $start_date = explode(" ", ($weekday->first())->start_datetime)[0];

                $subjects = $weekday->filter(function($subject) use($start_date){
                    return explode(" ", $subject->start_datetime)[0] == $start_date;
                });

                foreach($subjects as $subject)
                {
                    $dayOfWeekday = $subject->id_weekday;
                    $event_date = (Carbon::now())->startOfWeek()->addDays(($subject->id_weekday)-2)->format('Y-m-d');
                    $start_date = $event_date.'T'.explode(" ", $subject->start_datetime)[1];
                    $end_date = $event_date.'T'.explode(" ", $subject->end_datetime)[1];

                    array_push($events, [
                        'className' => [$subject->id_subject],
                        'title' => $subject->subject->subject_name,
                        'start' => $start_date,
                        'end' => $end_date,
                        'allDay' => false
                    ]);
                }
            }
            return response()->json($events);
        }

        $subjects = $section->subjectSection;
        $section = $section->where('id', $section->id)
                            ->with('level')
                            ->with('school_period')
                            ->with('section_type')
                            ->first();

        return view('sections.schedules.index', [
            'subjects' => $subjects,
            'section' => $section
        ]);
    }

    

    public function storeSchedules(Request $request, Section $section)
    {
        $d = $request->all();
        $ids = array();
        $period_dates = $section->school_period()
                                ->first(['id', 'start_date', 'end_date']);

        Schedule::where('id_section', $section->id)->delete();

        foreach($d['events'] as $event)
        {
            $item = $event['Item'][0];
            $start = $item['start'];
            $end = $item['end'];
            $id = $item['id'];

            $start_split = explode('T', $start);
            $start_date = $start_split[0];
            $start_time = $start_split[1];
            $end_split = explode('T', $end);
            $end_date = $end_split[0];
            $end_time = $end_split[1];

            $dayOfWeek = ((Carbon::parse($start_date))->dayOfWeek);
            
            $stdate_carbon = Carbon::parse($period_dates->start_date);
            $start_dt = new DateTime(($stdate_carbon->weekday() == $dayOfWeek ? $stdate_carbon : $stdate_carbon->next($dayOfWeek))->format('Y-m-d'));
            $end_dt = new DateTime($period_dates->end_date);

            $datesOfDayWeek = array();

            while($start_dt <= $end_dt){
                array_push($datesOfDayWeek, $start_dt->format('Y-m-d'));
                $start_dt->modify('+7 day');
            }

            foreach($datesOfDayWeek as $dateOfWeek)
            {
                $startTimestamp = $dateOfWeek." ".$start_time;
                $endTimestamp = $dateOfWeek." ".$end_time;

                Schedule::create([
                    'id_section' => $section->id,
                    'id_weekday' => $dayOfWeek+1,
                    'id_subject' => $id,
                    'start_datetime' => $startTimestamp,
                    'end_datetime' => $endTimestamp
                ]);
            }
        }

        return response()->json([
            'message' => 'stored'
        ]);

    }




    /*---------- ASSESSMENTS METHODS -----------*/

    public function assessmentIndex(Section $section, Subject $subject)
    {
        $section = $section->where('id', $section->id)
                            ->with('school_period')
                            ->with('level')
                            ->with('section_type')
                            ->first();

        $assessments = $subject->assessments()->where('id_section', $section->id)->get();

        $validYears = $subject->schedules()->where('id_section', $section->id)->get()
                                ->pluck('start_datetime')
                                ->map(function($date){
                                    return explode("-", explode(" ", $date)[0])[0];
                                })->unique();

        $assessmentsTypes = AssessmentType::all();

        return view('sections.assessments.index', [
            'section' => $section,
            'subject' => $subject,
            'assessments' => $assessments,
            'validYears' => $validYears,
            'assessmentsTypes' => $assessmentsTypes
        ]);
    }

    public function ajaxLoadDate(Request $request, Section $section, Subject $subject)
    {
        $data = $request->all();

        if($data['type'] == 'loadYear')
        {
            $year = $data['year'];
            $months = $subject->schedules()->where('id_section', $section->id)->get()
                                ->pluck('start_datetime')
                                ->map(function($date){
                                    return explode('-', explode(" ", $date)[0]);
                                })->filter(function ($date) use($year){
                                    return $date[0] == $year;
                                })->map(function($year){
                                    return $year[1];
                                })->unique();

            return response()->json($months);
        }
        elseif($data['type'] == 'loadMonth')
        {
            $year = $data['year'];
            $month = $data['month'];
            $days = $subject->schedules()->where('id_section', $section->id)->get()
                            ->pluck('start_datetime')
                            ->map(function($date){
                                return explode('-', explode(" ", $date)[0]);
                            })->filter(function ($date) use($year,$month){
                                return $date[0] == $year && $date[1] == $month;
                            })->map(function($day){
                                return $day[2];
                            })->unique()->toArray();
            sort($days);

            return response()->json($days);
        }
        
    }


    public function registerAssessment(Request $request, Section $section, Subject $subject)
    {

    }

}
