@extends('layouts.masterpage')

@section('content')
    <br>
    <div class="container-fluid py-4">
        <div class="row" style="display: flex; justify-content: center;">
            <div class="col-xl-9">
                <div class="card-header p-3 pt-2">
                    <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3 mt-n4">
                        <h5 class="text-white text-capitalize text-center">Bienvenido {{ Auth::user()->employee->name }}</h5>
                    </div>
                    <br>
                    <div class="col text-center" style= "display:flex;">
                        <img class=" img img-fluid text-start m-5" src="/{{ Auth::user()->employee->url_img }}"
                            style= "width: 30%; height: 20%; border-radius: 8%;">
                        <div class="contenedor" style=padding:7%;>

                            <div class="row bg-gradient-primary shadow-primary border-radius-lg">
                                <div class="col p-2 text-white text-capitalize text-center">INFORMACION GENERAL</div>
                            </div>

                            <div class="row  ">
                                <div class="col pt-4">USUARIO: {{ Auth::user()->username }} </div>
                                <div class="col pt-4">ROL: {{ Auth::user()->employee->roles->role_name }}</div>
                            </div>

                            <div class="row ">
                                <div class="col pt-4">NOMBRES: {{ Auth::user()->employee->name }}</div>
                                <div class="col pt-4">CODIGO: {{ Auth::user()->id }}</div>
                            </div>

                            <div class="row ">
                                <div class="col pt-4">APELLIDOS: {{ Auth::user()->employee->lastname }} </div>
                                <div class="col pt-4">CELULAR: {{ Auth::user()->employee->phone_number }}</div>
                            </div>

                            <div class="row ">
                                <div class="col pt-4">CORREO: {{ Auth::user()->employee->email }}</div>
                                <div class="col pt-4">F. CREACION: {{ Auth::user()->employee->created_at }}</div>
                            </div>

                            <br><br>
                            @if (Auth::user()->employee->roles->role_name=='Profesor')
                                <div class="col text-center">
                                    <a href="{{ route('user.editprofile') }}" class="btn btn-success"><i
                                            class="fa-solid fa-pencil fa-xl"></i> &nbsp; Modificar usuario</a>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
