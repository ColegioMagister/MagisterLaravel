<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\School_info;
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
        $students = Student::count();
        $subjects = Subject::count();
        $sections = Section::count();
        $teachers = Employee::whereHas('roles', function ($query) {
            $query->where('role_name', '!=', 'Admin');
        })->count();
        $school = School_Info::first();
        $period = SchoolPeriod::first();

        return view('schoolData.index',compact('students', 'subjects', 'sections', 'teachers'),[
            'school' => $school,
            'period' => $period
        ]);
    }
    public function indexTeacher()
    {
        $students = Student::count();
        $subjects = Subject::count();
        $sections = Section::count();
        $teachers = Employee::whereHas('roles', function ($query) {
            $query->where('role_name', '!=', 'Admin');
        })->count();
        $school = School_Info::first();
        $period = SchoolPeriod::first();

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