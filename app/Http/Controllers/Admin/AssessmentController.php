<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AssessmentType;


class AssessmentController extends Controller
{
 
    public function index()
    {
        $assessments = AssessmentType::all();

        return view('assessment.index', [
            'assessments' => $assessments
        ]);
    }


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


    public function update(Request $request, AssessmentType $assessment)
    {
        $assessment->update([
            'assessment_name' => $request['assessment_name'],
            'value' => $request['assessment_value']
        ]);

        return redirect()->route('assessment.index')->with('flash_message', 'Updated!');
    }

    public function destroy(AssessmentType $assessment)
    {
        try {
            $assessment->delete();

            return redirect()->route('assessment.index')->with('flash_message', 'deleted!');
        } catch (\Throwable $th) {
            return redirect()->route('assessment.index')->with('error_message', 'Error!');
        }

    }
}
