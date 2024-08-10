@extends('layouts.masterpage')

@section('content')
<div class="container-fluid py-4"> 
      <div class="row">
        <div class="col-xl-4 col-sm-6 mb-xl-0 mb-4">
          <div class="card">
            <div class="card-header p-3 pt-2">
              <div class="icon icon-xl icon-shape bg-gradient-primary shadow-primary text-center border-radius-xl mt-n4 position-absolute" style="max-height:15vw;">
                <i class="material-icons opacity-10">face</i>
              </div>
              <div class="text-center pt-5">
                <h4 class=" mb-1 text-capitalize" style="font-size: 1.4vw;">ALUMNOS</h4>
                
                <!-- base de datos -->
                <h2 class="m-3">{{ $students }}</h2>
              </div>
            </div>
            <br>
          </div>
        </div>


        <div class="col-xl-4 col-sm-6 mb-xl-0 mb-4">
          <div class="card">
            <div class="card-header p-3 pt-2">
            <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3 mt-n4">
              <h5 class="text-white text-capitalize text-center" style="font-size: 1.6vw;">I.E.P. MAGISTER</h5>
            </div>
            <br>
            <img src="data:image/jpg;base64,
            {{base64_encode(file_get_contents(base_path('public/'.$school->url_img)))}}" class="avatar avatar-xxl  position-absolute" >              <div class="text-end pt-1">
                <h5 class="mb-2" style="font-size: 1vw;">{{$school->tax_number}}</h5>
                <h5 class="mb-2" style="font-size: 1vw;">{{$school->phone_number}}</h5>
                <h5 class="mb-2" style="font-size: 1vw;">{{$school->city}}, Perú</h5>
                <h5 class="mb-2" style="font-size: 1vw;">{{$school->email}}</h5>
                <h5 class="mb-2" style="font-size: 1vw;">{{$school->adress}}</h5>
              </div>
            </div>
            <br>
          </div>
        </div>


        
        <div class="col-xl-4 col-sm-6 mb-xl-0 mb-4">
          <div class="card">
            <div class="card-header p-3 pt-2">
              <div class="icon icon-xl icon-shape bg-gradient-primary shadow-primary text-center border-radius-xl mt-n4 position-absolute" style="max-height:15vw;">
                <i class="material-icons opacity-10">book</i>
              </div>
              <div class="text-center pt-5">
                <h4 class=" mb-1 text-capitalize" style="font-size: 1.4vw;">MATERIAS</h4>
                <!-- base de datos -->
                <h2 class="m-3">{{ $subjects }}</h2>
              </div>
            </div>
            <br>
          </div>
        </div>
      <div> <br> <br> </div>
      <div class="col-xl-4 col-sm-6 mb-xl-0 mb-4">
          <div class="card">
            <div class="card-header p-3 pt-2">
              <div class="icon icon-xl icon-shape bg-gradient-primary shadow-primary text-center border-radius-xl mt-n4 position-absolute" style="max-height:15vw;">
                <i class="material-icons opacity-10">home</i>
              </div>
              <div class="text-center pt-5">
                <h4 class=" mb-1 text-capitalize" style="font-size: 1.4vw;">SECCIONES</h4>
                <!-- base de datos -->
                <h2 class="m-3">{{ $sections }}</h2>
              </div>
            </div>
            <br>
          </div>
        </div>



        <div class="col-xl-4 col-sm-6 mb-xl-0 mb-4">
          <div class="card">
            <div class="card-header p-3 pt-2">
              <div class="icon icon-xl icon-shape bg-gradient-primary shadow-primary text-center border-radius-xl mt-n4 position-absolute" style="max-height:15vw;">
                <i class="material-icons opacity-10">person</i>
              </div>
              <div class="text-center pt-5">
                <h4 class=" mb-1 text-capitalize" style="font-size: 1.4vw;">PROFESORES</h4>
                <!-- base de datos -->
                <h2 class="m-3">{{ $teachers }}</h2>
              </div>
            </div>
            <br>
          </div>
        </div>




        <div class="col-xl-4 col-sm-6 mb-xl-0 mb-4">
          <div class="card">
            <div class="card-header p-3 pt-2">
              <div class="icon icon-xl icon-shape bg-gradient-primary shadow-primary text-center border-radius-xl mt-n4 position-absolute" style="max-height:15vw;">
                <i class="material-icons opacity-10">grade</i>
              </div>
              <div class="text-center pt-2">
                <h4 class=" mb-1 text-capitalize" style="font-size: 1.4vw;">PERIODO</h4>
                <h4 class=" mb-1 text-capitalize" style="font-size: 1.4vw;">ACADEMICO</h4>
                <!-- base de datos -->
                <h2 class="m-3">{{$period->period_name ?? null}}</h2>
              </div>
            </div>
            <br>
          </div>
        </div>





      </div>


@endsection
