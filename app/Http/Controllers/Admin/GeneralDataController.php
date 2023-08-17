<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\App;
use Illuminate\Http\Request;
use App\Models\Employee;
use App\Models\Student;
use App\Models\Subject;
use App\Models\Section;
use App\Models\SchoolPeriod;


class GeneralDataController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


     public function __construct()
     {
         $this->middleware('auth');
     }



    public function index()
    {
        $school = App::make('App\Models\School_Info')->first();
        $period = SchoolPeriod::first();
        $students = Student::count();
        $subjects = Subject::count();
        $sections = Section::count();
        $teachers = Employee::whereHas('roles', function ($query) {
            $query->where('role_name', '!=', 'Admin');
        })->count();
        

        return view('schoolData.index',compact('students', 'subjects', 'sections', 'teachers'),[
            'school' => $school,
            'period' => $period
        ]);
    }
    public function indexTeacher()
    {
        $school = App::make('App\Models\School_Info')->first();
        $period = SchoolPeriod::first();
        $students = Student::count();
        $subjects = Subject::count();
        $sections = Section::count();
        $teachers = Employee::whereHas('roles', function ($query) {
            $query->where('role_name', '!=', 'Admin');
        })->count();
        

        return view('schoolData.index',compact('students', 'subjects', 'sections', 'teachers'),[
            'school' => $school,
            'period' => $period
        ]);
    }
    

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
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