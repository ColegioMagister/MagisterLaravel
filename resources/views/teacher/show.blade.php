@extends('layouts.masterpage')

@section('content')


<div class="container-fluid py-4"> 
    <div class="row" style="display: flex; justify-content: center;">
    <div class="col-xl-9 text-center">
          <div class="card">
            <div class="card-header p-3 pt-2">
            <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3 mt-n4">
              <h5 class="text-white text-capitalize text-center">{{$teacher -> name}} {{$teacher -> lastname}}</h5>
            </div>
            <br>
            <div class="period-box" style= "border-radius: 50%";>
              <img src="/{{$teacher->url_img }}" class="im" style= "width: 20%;border-radius: 8%;";>
              
            </div>

          <div class="row" style= padding:7%;>
          <div class="card-header p-6 pt-1">
            <div class="row bg-gradient-primary shadow-primary border-radius-lg">
                <div class="p-2 text-white text-capitalize text-center ">INFORMACION GENERAL</div>
            </div>
            </div>
              <div class="row text-center ">
                <div class="pt-1">NOMBRES: {{$teacher -> name}}</div>
                <div class="pt-4">APELLIDOS: {{$teacher -> lastname}}</div>
                <div class="pt-4">CODIGO: {{$teacher -> id}}</div>
                <div class="pt-4">CELULAR: {{$teacher -> phone_number}}</div>
                <div class="pt-4">CORREO: {{$teacher -> email}}</div>
                <div class="pt-4">F. CREACION: {{$teacher -> created_at}}</div>
              </div>

            </div>
            <a href="{{route('teacher.index')}}" class="btn btn-primary"><i class="fa-solid fa-chevron-left"></i> &nbsp; Volver</a>
            </div>
            <br>
          </div>
      </div>


          


    </div>
</div>













@endsection