<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{SchoolPeriod,Level,SectionType,Section,Student};

class YearController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $school_periods = SchoolPeriod::all();
        return view ('schoolYear.index')->with('school_periods', $school_periods);
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
        $input = $request->all();
        SchoolPeriod::create($input);
        return redirect('SchoolYear')->with('flash_message', 'Addedd!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $school_period = SchoolPeriod::find($id);
        $levels = Level::all();
        $section_type = SectionType::all();
        $sections = $school_period->sections()->with('section_type')
                                            ->with('level')
                                            ->with('school_period')
                                            ->get();
        
        $sectionCount = $school_period->sections()->count();
                                            
        return view('SchoolYear.show', [
            'levels' => $levels,
            'section_type' => $section_type,
            'sections' => $sections,
            'school_period' => $school_period,
            
            'sectionCount' => $sectionCount 
        ]);;
    
    }
    public function showStudent($id)
{
    // Encuentra la sección correspondiente al ID proporcionado
    $section = Section::find($id);

    // Obtén los estudiantes que están asociados a esta sección utilizando una relación definida en el modelo Student
    $sectionsStudents = Student::whereHas('studentSections', function ($query) use ($section) {
        $query->where('id_section', $section->id);
    })->get();

    // Contar la cantidad de estudiantes en esta sección
    $studentCount = $sectionsStudents->count();

    // Devuelve una vista con la información de la sección y los estudiantes
    return view('schoolYear.studentShow', [
        'section' => $section,
        'sectionsStudents' => $sectionsStudents,
        'studentCount' => $studentCount 
    ]);
}

    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(SchoolPeriod $school_period)
    {

    
        return response()->json([
            'id'=> $school_period->id,
            'period_name'=> $school_period->period_name,
            'start_date'=> $school_period->start_date,
            'end_date'=> $school_period->end_date,
            'status'=> $school_period->status,

        ]);
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

        
        $school_period = SchoolPeriod::find($id);
        $input = $request->all();
        $school_period->update($input);
        return redirect('SchoolYear')->with('flash_message', 'Updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        SchoolPeriod::destroy($id);
        return redirect('SchoolYear')->with('flash_message', 'deleted!');  
    }
}
