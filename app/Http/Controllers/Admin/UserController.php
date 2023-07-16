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
        $rutaArchivo = 'assets/img/fotos/' . $nombreArchivo;

        $imagen->move(public_path('assets/img/fotos/'), $nombreArchivo);

        $input['url_img'] = $rutaArchivo;
    }
        Employee::create($input);
        return redirect('Profesor')->with('flash_message', 'Addedd!');
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

        if ($request->hasFile('url_img') && $request->file('url_img')->isValid()) {
            $imagen = $request->file('url_img');
            $nombreArchivo = md5(time() . $imagen->getClientOriginalName()) . '.' . $imagen->getClientOriginalExtension();
            $rutaArchivo = 'assets/img/fotos/' . $nombreArchivo;
    
            // Eliminar imagen anterior
            if ($teacher->url_img != '') {
                $rutaImagenAnterior = public_path($teacher->url_img);
                if (file_exists($rutaImagenAnterior)) {
                    unlink($rutaImagenAnterior);
                }
            }
            $imagen->move(public_path('assets/img/fotos/'), $nombreArchivo);
            $input['url_img'] = $rutaArchivo;
        } else {
            // Conservar la ruta de la imagen existente si no se carga una nueva imagen
            $input['url_img'] = $teacher->url_img;
        }

        $teacher->update($input);
        return redirect('Profesor')->with('flash_message', 'Updated!'); 
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
        
        if (!empty($imagen) && file_exists(public_path($imagen))){
            unlink(public_path($imagen));
        }
        return redirect('Profesor')->with('flash_message', 'deleted!');  
    }
}
