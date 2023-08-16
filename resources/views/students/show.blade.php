@extends('layouts.masterpage')

@section('content')


<div class="container-fluid py-4"> 
    <div class="row" style="display: flex; justify-content: center;">
    <div class="col-xl-9 text-center">
          <div class="card">
            <div class="card-header p-3 pt-2">
            <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3 mt-n4">
              <h5 class="text-white text-capitalize text-center">{{$student ->name}} {{$student->lastname}}</h5>
            </div>
            <br>
            <div class="period-box" style= "border-radius: 50%";>
              <img src="/{{$student->url_img }}" class="im" style= "width: 20%;border-radius: 8%;";>
              
            </div>

          <div class="row" style= padding:7%;>
            <div class="row bg-gradient-primary shadow-primary border-radius-lg">
                <div class="col p-2 text-white text-capitalize text-center">INFORMACION PERSONAL</div>
                <div class="col p-2 text-white text-capitalize text-center">CONTACTO</div>
            </div>
              <div class="row text-center ">
                <div class="col pt-4">NOMBRE: {{$student->name}}</div>
                <div class="col pt-4">CODIGO: {{$student->id}}</div>
                
              </div>
              <div class="row text-center">
                <div class="col pt-4">APELLIDOS: {{$student->lastname}}</div>
                <div class="col pt-4">CELULAR: {{$student->phone_number}}</div>
            </div>
            <div class="row text-center">

                <div class="col pt-4">NACIMIENTO: {{$student->bithdate}}</div>
                <div class="col pt-4">DNI: {{$student->dni}}  </div>
                
              </div>
              <div class="row text-center">
                <div class="col pt-4">GENERO: {{$student->gender}}  </div>
                <div class="col pt-4"> </div>
              </div>  
              
            </div>
            <a href="{{route('students.index')}}" class="btn btn-primary"><i class="fa-solid fa-chevron-left"></i> &nbsp; Volver</a>
            </div>
            <br>
          </div>
      </div>


          


    </div>
</div>













@endsection