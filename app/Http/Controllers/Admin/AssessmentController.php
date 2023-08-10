<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AssessmentType;


class AssessmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $assessments = AssessmentType::all();

        return view('assessment.index', [
            'assessments' => $assessments
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        AssessmentType::create([
            'assessment_name' => $request['assessment_name'],
            'value' => $request['assessment_value']
        ]);

        return redirect()->route('assessment.index')->with('flash_message', 'Addedd!');
    }


    public function getEditAjaxData(AssessmentType $assessment)
    {
        return response()->json([
            'name' => $assessment->assessment_name,
            'value' => floor($assessment->value)
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, AssessmentType $assessment)
    {
        $assessment->update([
            'assessment_name' => $request['assessment_name'],
            'value' => $request['assessment_value']
        ]);

        return redirect()->route('assessment.index')->with('flash_message', 'Updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(AssessmentType $assessment)
    {
        $assessment->delete();

        return redirect()->route('assessment.index')->with('flash_message', 'deleted!');
    }
}
