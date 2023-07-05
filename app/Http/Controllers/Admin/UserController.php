<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\{Employee,Roles};

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $teacher = Employee::all();
        $roles=Roles::all();
        return view ('teacher.index',[
            "teacher"=>$teacher,
            "roles"=>$roles
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
        $input = $request->all();
        
        if ($request->hasFile('url_img') && $request->file('url_img')->isValid()) {
        $imagen = $request->file('url_img');
        $nombreArchivo = md5(time() . $imagen->getClientOriginalName()) . '.' . $imagen->getClientOriginalExtension();
        $rutaArchivo = 'assets/img/profesores/' . $nombreArchivo;

        $imagen->move(public_path('assets/img/profesores/'), $nombreArchivo);

        $input['url_img'] = $rutaArchivo;
    }
        Employee::create($input);
        return redirect('Profesor')->with('flash_message', 'Teacher Addedd!');
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
        $teacher = Employee::find($id);
        $input = $request->all();
        $teacher->update($input);
        return redirect('Profesor')->with('flash_message', 'student Updated!'); 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Employee::destroy($id);
        return redirect('Profesor')->with('flash_message', 'Teacher deleted!');  
    }
}
