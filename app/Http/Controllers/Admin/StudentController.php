<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{Student, School_Info};

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $students = Student::all();
        return view('students.index')->with('students', $students);
    }


    public function ReporteAlumnos()
    {
        $students = Student::all();
        $schools = School_Info::all();
        $totalStudents = $students->count();

        $pdf = \PDF::loadView('reportes.alumnos', compact('students', 'schools', 'totalStudents'));

        $pdf_name = 'libreta.pdf';
        return $pdf->stream($pdf_name);
    }

    public function ReporteLibreta(Student $student)
    {

        try {

            $student = Student::findOrFail($student->id);

            $assessments = $student->studentAssessment;
            $sections = $student->studentSections;
            $schools = School_Info::all();

            $PromedioXSubject = [];

            foreach ($sections as $section) {
                foreach ($section->subjectSection as $subject) {
                    $totalsubject = 0;
                    $totalAssessments = 0;

                    foreach ($assessments as $assessment) {
                        if ($assessment->subject->id === $subject->id) {
                            $totalGrades = $assessment->pivot->grade;
                            $assessmentPeso = $assessment->assessmentType->value;

                            $totalsubject += ($totalGrades * $assessmentPeso);
                            $totalAssessments += $assessmentPeso;

                        }
                    }

                    $PromedioXSubject[$subject->id] = ($totalAssessments > 0) ? ($totalsubject / $totalAssessments) : 0;

                }
            }

            $pdf = \PDF::loadView('reportes.libreta', compact('student', 'schools', 'assessments', 'sections', 'PromedioXSubject'));

            $pdf_name = 'libreta.pdf';
            return $pdf->stream($pdf_name);

            ///por ahora
        } catch (\Throwable $th) {
            return redirect()->route('students.index')->with('error_message', 'Error!');

        }
    }

    public function checkStudent(Request $request)
    {
        $dni = $request->input('dni');
        $valueDni = Student::where('dni', $dni)->exists();
        return response()->json(['valueDni' => $valueDni]);
    }
    public function store(Request $request)
    {
        $input = $request->all();

        if ($request->hasFile('url_img') && $request->file('url_img')->isValid()) {
            $imagen = $request->file('url_img');
            $nombreArchivo = md5(time() . $imagen->getClientOriginalName()) . '.' . $imagen->getClientOriginalExtension();
            $rutaArchivo = 'assets/img/fotos/' . $nombreArchivo;

            $imagen->move(public_path('assets/img/fotos/'), $nombreArchivo);
            $input['url_img'] = $rutaArchivo;
        } else {
            $input['url_img'] = 'assets/img/login-bg/default.png';
        }

        Student::create($input);
        return redirect()->route('students.index')->with('flash_message', 'Addedd!');

    }


    public function show(Student $student)
    {
        return view('students.show', compact('student'));
    }


    public function edit(Student $student)
    {
        return response()->json($student);
    }



    public function update(Request $request, $id)
    {
        $student = Student::find($id);
        $input = $request->all();

        if ($request->hasFile('url_img') && $request->file('url_img')->isValid()) {
            $imagen = $request->file('url_img');
            $nombreArchivo = md5(time() . $imagen->getClientOriginalName()) . '.' . $imagen->getClientOriginalExtension();
            $rutaArchivo = 'assets/img/fotos/' . $nombreArchivo;

            if ($student->url_img != 'assets/img/login-bg/default.png') {
                $rutaImagenAnterior = public_path($student->url_img);
                if (file_exists($rutaImagenAnterior)) {
                    unlink($rutaImagenAnterior);
                }
            }
            $imagen->move(public_path('assets/img/fotos/'), $nombreArchivo);
            $input['url_img'] = $rutaArchivo;
        } else {
            $input['url_img'] = $student->url_img;
        }

        $student->update($input);
        return redirect()->route('students.index')->with('flash_message', 'Updated!');

    }


    public function destroy($id)
    {

        try {
            $student = Student::find($id);
            $imagen = $student->url_img;
            $student->delete();
    
            if ($imagen !== 'assets/img/login-bg/default.png') {
                if (!empty($imagen) && file_exists(public_path($imagen))) {
                    unlink(public_path($imagen));
                }
            }
    
            return redirect()->route('students.index')->with('flash_message', 'deleted!');
        } catch (\Throwable $th) {
            return redirect()->route('students.index')->with('error_message', 'Error!');
        }
      

    }

}


