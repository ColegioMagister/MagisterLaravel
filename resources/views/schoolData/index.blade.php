@extends('layouts.masterpage')

@section('content')
<div class="container-fluid py-4"> 
        <div class="row">
        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
          <div class="card">
            <div class="card-header p-3 pt-2">
              <div class="icon icon-lg icon-shape bg-gradient-dark shadow-dark text-center border-radius-xl mt-n4 position-absolute">
                <i class="material-icons opacity-10">weekend</i>
              </div>
              <div class="text-end pt-1">
                <p class="text-sm mb-0 text-capitalize">Nombre de escuela</p>
                <!-- base de datos -->
                <h4 class="mb-0">{{$school->school_name}}</h4>
              </div>
            </div>
            <hr class="dark horizontal my-0">
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#" enctype="multipart/form-data">
                              <i class="fa-solid fa-plus"></i> Editar
              </button>
            
          </div>
        </div>
        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
          <div class="card">
            <div class="card-header p-3 pt-2">
              <div class="icon icon-lg icon-shape bg-gradient-primary shadow-primary text-center border-radius-xl mt-n4 position-absolute">
                <i class="material-icons opacity-10">person</i>
              </div>
              <div class="text-end pt-1">
                <p class="text-sm mb-0 text-capitalize">Número de impuesto</p>
                <!-- base de datos -->
                <h4 class="mb-0">{{$school->tax_number}}</h4>
              </div>
            </div>
            <hr class="dark horizontal my-0">
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#" enctype="multipart/form-data">
                              <i class="fa-solid fa-plus"></i> Editar
              </button>
          </div>
        </div>
        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
          <div class="card">
            <div class="card-header p-3 pt-2">
              <div class="icon icon-lg icon-shape bg-gradient-success shadow-success text-center border-radius-xl mt-n4 position-absolute">
                <i class="material-icons opacity-10">person</i>
              </div>
              <div class="text-end pt-1">
                <p class="text-sm mb-0 text-capitalize">Correo Educativo</p>
                <!-- base de datos -->
                <h4 class="mb-0">{{$school->email}}</h4>
              </div>
            </div>
            <hr class="dark horizontal my-0">
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#" enctype="multipart/form-data">
                              <i class="fa-solid fa-plus"></i> Editar
              </button>
          </div>
        </div>
        <div class="col-xl-3 col-sm-6">
          <div class="card">
            <div class="card-header p-3 pt-2">
              <div class="icon icon-lg icon-shape bg-gradient-info shadow-info text-center border-radius-xl mt-n4 position-absolute">
                <i class="material-icons opacity-10">weekend</i>
              </div>
              <div class="text-end pt-1">
                <p class="text-sm mb-0 text-capitalize">Numero Telefonico</p>
                <!-- base de datos -->
                <h4 class="mb-0">{{$school->phone_number}}</h4>
              </div>
            </div>
            <hr class="dark horizontal my-0">
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#" enctype="multipart/form-data">
                              <i class="fa-solid fa-plus"></i> Editar
              </button>
          </div>
        </div>
      </div>

      <div class="row mt-5">
        <div class="col-lg-6 col-md-6 mt-4 mb-4">
          <div class="card z-index-2 ">
            <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2 bg-transparent">
              <div class="bg-gradient-primary shadow-primary border-radius-lg py-3 pe-1">
                <div class="chart">
                  <canvas id="chart-bars" class="chart-canvas" height="170" style="display: block; box-sizing: border-box; height: 170px; width: 255.3px;" width="255"></canvas>
                </div>
              </div>
            </div>
            <div class="card-body">
              <h6 class="mb-0 ">Direccion Ubicada</h6>
              <!-- base de datos -->
              <p class="text-sm ">{{$school->city}};{{$school->adress}}</p>
              <hr class="dark horizontal">
              <div class="d-flex ">
                <i class="material-icons text-sm my-auto me-1">schedule</i>
                <!-- base de datos -->
                <p class="mb-0 text-sm"> extra ssss </p>
              </div>
            </div>
          </div>
        </div>

        
        <div class="col-lg-6 mt-4 mb-3">
          <div class="card z-index-2 ">
            <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2 bg-transparent">
              <div class="bg-gradient-dark shadow-dark border-radius-lg py-3 pe-1">
                <div class="chart">
                  <canvas id="chart-line-tasks" class="chart-canvas" height="170" style="display: block; box-sizing: border-box; height: 170px; width: 255.3px;" width="255"></canvas>
                </div>
              </div>
            </div>
            <div class="card-body">
              <h6 class="mb-0 ">Imagen Educativo</h6>
              <p class="text-sm ">extra data</p>
              <hr class="dark horizontal">
              <div class="d-flex ">
                <i class="material-icons text-sm my-auto me-1">schedule</i>
                <p class="mb-0 text-sm">actualizado ahora mismo</p>
              </div>
            </div>
          </div>
        </div>
      </div>    </div>
@endsection
