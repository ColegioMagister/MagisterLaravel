@extends('layouts.masterpage')

@section('content')


<div class="container-fluid py-4"> 
    <div class="row" style="display: flex; justify-content: center;">
    <div class="col-xl-9 text-center">
          <div class="card">
            <div class="card-header p-3 pt-2">
            <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3 mt-n4">
              <h5 class="text-white text-capitalize text-center">{{$user->employee->name}} {{$user->employee->lastname}}</h5>
            </div>
            <br>
            <div class="period-box" style= "border-radius: 50%";>
              <img src="/{{$user->employee->url_img }}" class="im" style= "width: 20%;border-radius: 8%;";>
              
            </div>

          <div class="row" style= padding:7%;>
            <div class="row bg-gradient-primary shadow-primary border-radius-lg">
                <div class="col p-2 text-white text-capitalize text-center">INFORMACION PERSONAL</div>
                <div class="col p-2 text-white text-capitalize text-center">INFORMACION ACADEMICA</div>
            </div>
              <div class="row text-center ">
                <div class="col pt-4">NOMBRES: {{$user->employee->name}}</div>
                <div class="col pt-4">ROL: {{$user->role_name}}</div>
                
              </div>
              <div class="row text-center">
                <div class="col pt-4">APELLIDOS: {{$user->employee->lastname}}</div>
                <div class="col pt-4">CODIGO: {{$user->id}}</div>
            </div>
            <div class="row text-center">

                <div class="col pt-4">CELULAR: {{$user->employee->phone_number}}</div>
                <div class="col pt-4">USUARIO: {{$user->username}}</div>
            </div>

            <div class="row text-center">
                <div class="col pt-4">CORREO: {{$user->employee->email}}</div>
                <div class="col pt-4">F. CREACION: {{$user->created_at}}</div>
            </div>
            
              
          </div>
            <a href="{{route('user.index')}}" class="btn btn-primary"><i class="fa-solid fa-chevron-left"></i> &nbsp; Volver</a>
            </div>
            <br>
          </div>
      </div>


          


    </div>
</div>













@endsection