<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{
    Level,
    SchoolPeriod,
    Section,
    SectionType
};

class SectionController extends Controller
{
    public function index()
    {
        $levels = Level::all();
        $school_periods = SchoolPeriod::all();
        $section_type = SectionType::all();
        $sections = Section::all();

        return view('sections.index', [
            'levels' => $levels,
            'school_periods' => $school_periods,
            'section_type' => $section_type,
            'sections' => $sections
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

    
    public function getAjaxUpdate(Section $section)
    {
        return response()->json([
            'id_sectiontype' => $section->id_sectiontype,
            'id_period' => $section->id_period,
            'id_level' => $section->id_level,
            'section_name' => $section->section_name,
            'total_amount' => $section->total_amount,
            'sectionType_name' => $section->section_type->section_type,
            'level_name' => $section->level->description,
            'period_name' => $section->school_period->period_name
        ]);
    }

    public function store(Request $request)
    {
        $input = $request->all();

        Section::create($input);

        return redirect()->route('sections.index')->with('flash_message', 'Addedd!');
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
    public function update(Request $request, Section $section)
    {
        $input = $request->all();

        $section->update($input);

        return redirect()->route('sections.index')->with('flash_message', 'Updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Section $section)
    {
        $section->delete();

        return redirect()->route('sections.index')->with('flash_message', 'deleted!');
    }
}
