<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\{Employee,Roles,Subject};

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $teachers = Employee::whereHas('roles', function ($query) {
            $query->where('role_name', '!=', 'Admin');
        })->get();
        $roles = Roles::all();
        $subject = Subject::all();
    
        return view('teacher.index', [
            'teacher' => $teachers,
            'roles' => $roles,
            'subjects' => $subject, 
        ]);

    }
    public function AsignarSubject(Request $request, Employee $employee)
    {
        $subjectId = $request->input('id_subject');
        
        if ($employee->teacherSubjects()->where('id_subject', $subjectId)->exists()) {
            return redirect()->route('teacher.index')->with('error_message', 'Error!');
        }else{
            $employee->teacherSubjects()->attach($subjectId);
    
        return redirect()->route('teacher.index')->with('flash_message', 'Addedd!');
        }
        
    }
    public function AsignarSubjectAjax(Request $request, Employee $employee)
    {
        $subjectId = $request->input('id_subject');
        
        if ($employee->teacherSubjects()->where('id_subject', $subjectId)->exists()) {
            return response()->json([
                'error_message' => 'Error!'
            ]);
        }
        
        $employee->teacherSubjects()->attach($subjectId);
    
        $teacherName = $employee->name . ' ' . $employee->lastname;
    
        return response()->json([
            'teacher_name' => $teacherName
        ]);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function checkTeacher(Request $request)
    {
       $email=$request->input('email');

       $valueEmail=Employee::where('email',$email)->exists();
       return response()->json(['valueEmail'=>$valueEmail]);
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
        
        if ($request->hasFile('url_img') && $request->file('url_img')->isValid()) {
        $imagen = $request->file('url_img');
        $nombreArchivo = md5(time() . $imagen->getClientOriginalName()) . '.' . $imagen->getClientOriginalExtension();
        $rutaArchivo = 'assets/img/fotos/' . $nombreArchivo;

        $imagen->move(public_path('assets/img/fotos/'), $nombreArchivo);

        $input['url_img'] = $rutaArchivo;
        }else {
            $input['url_img'] = 'assets/img/login-bg/default.png'; 
        }
        Employee::create($input);
        return redirect()->route('teacher.index')->with('flash_message', 'Addedd!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $teacher = Employee::find($id);
        return view('teacher.show', compact('teacher'));
    }

    public function showSubject(Employee $employee)
    {        
        $subjects = $employee->teacherSubjects;
        
        /*cualquiera de los 2
        $subjects = $employee->teacherSubjects()
            ->wherePivot('id_teacher', $employee->id) // Filtrar por id_teacher
            ->get();*/

        return view('teacher.teacherSubject',[
            'teachers' => $employee,
            'subjects' => $subjects]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function edit(Employee $employee)
    {
        return response()->json([
            'id_role'=>$employee->id_role,
            'role_name'=>$employee->roles->role_name,
            'name'=>$employee->name,
            'lastname'=>$employee->lastname,
            'email'=>$employee->email,
            'phone_number'=>$employee->phone_number,
            'url_img'=>$employee->url_img
        ]);
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Employee $employee)
    {
        $input = $request->all();

        if ($request->hasFile('url_img') && $request->file('url_img')->isValid()) {
            $imagen = $request->file('url_img');
            $nombreArchivo = md5(time() . $imagen->getClientOriginalName()) . '.' . $imagen->getClientOriginalExtension();
            $rutaArchivo = 'assets/img/fotos/' . $nombreArchivo;
    
            // Eliminar imagen anterior
            if ($employee->url_img != '') {
                $rutaImagenAnterior = public_path($employee->url_img);
                if (file_exists($rutaImagenAnterior)) {
                    unlink($rutaImagenAnterior);
                }
            }
            $imagen->move(public_path('assets/img/fotos/'), $nombreArchivo);
            $input['url_img'] = $rutaArchivo;
        } else {
            $input['url_img'] = $employee->url_img;
        }

        $employee->update($input);
        return redirect()->route('teacher.index')->with('flash_message', 'Updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $teacher =Employee::find($id);
        $imagen=$teacher->url_img;
        $teacher->delete();
        
        if ($imagen !== 'assets/img/login-bg/default.png') {
            if (!empty($imagen) && file_exists(public_path($imagen))) {
                unlink(public_path($imagen));
            }
        }
        return redirect()->route('teacher.index')->with('flash_message', 'Deleted!');  
    }

    public function destroySubject(Employee $employee,Subject $subject)
    {
        $employee->teacherSubjects()->detach($subject);
        
        return redirect()->route('teacher.teacherSubject', $employee)->with('flash_message', 'deleted!');
    }
}
