<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Subject;

class SubjectsController extends Controller
{

    public function index()
    {
        $subjects = Subject::all();
        return view('subject.index')->with('subjects', $subjects);
    }


    public function checkSubject(Request $request)
    {

        $subject_name = $request->input('subject_name');
        $valueSubject = Subject::where('subject_name', $subject_name)->exists();
        return response()->json(['valueSubject' => $valueSubject]);

    }
    public function store(Request $request)
    {
        $input = $request->all();
        Subject::create($input);
        return redirect()->route('subject.index')->with('flash_message', 'Addedd!');
    }


    public function edit(Subject $subject)
    {
        return response()->json($subject);

    }


    public function update(Request $request, Subject $subject)
    {
        $input = $request->all();
        $subject->update($input);
        return redirect()->route('subject.index')->with('flash_message', 'Updated!');
    }

    public function destroy($id)
    {
        try {
            Subject::destroy($id);
            return redirect()->route('subject.index')->with('flash_message', 'deleted!');
        } catch (\Throwable $th) {
            return redirect()->route('subject.index')->with('error_message', 'Error!');
        }

    }
}
