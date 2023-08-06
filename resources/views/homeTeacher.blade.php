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
                <p class="text-sm mb-0 text-capitalize">INFO</p>
                <h4 class="mb-0">INFO</h4>
              </div>
            </div>
            <hr class="dark horizontal my-0">
            <div class="card-footer p-3">
              <p class="mb-0"><span class="text-success text-sm font-weight-bolder">DATOS </span>INFO</p>
            </div>
          </div>
        </div>
        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
          <div class="card">
            <div class="card-header p-3 pt-2">
              <div class="icon icon-lg icon-shape bg-gradient-primary shadow-primary text-center border-radius-xl mt-n4 position-absolute">
                <i class="material-icons opacity-10">person</i>
              </div>
              <div class="text-end pt-1">
                <p class="text-sm mb-0 text-capitalize">Alumnos</p>
                <h4 class="mb-0">INFO</h4>
              </div>
            </div>
            <hr class="dark horizontal my-0">
            <div class="card-footer p-3">
              <p class="mb-0"><span class="text-success text-sm font-weight-bolder">DATOS </span>INFO</p>
            </div>
          </div>
        </div>
        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
          <div class="card">
            <div class="card-header p-3 pt-2">
              <div class="icon icon-lg icon-shape bg-gradient-success shadow-success text-center border-radius-xl mt-n4 position-absolute">
                <i class="material-icons opacity-10">person</i>
              </div>
              <div class="text-end pt-1">
                <p class="text-sm mb-0 text-capitalize">INFO</p>
                <h4 class="mb-0">INFO</h4>
              </div>
            </div>
            <hr class="dark horizontal my-0">
            <div class="card-footer p-3">
              <p class="mb-0"><span class="text-danger text-sm font-weight-bolder">DATOS</span> INFO</p>
            </div>
          </div>
        </div>
        <div class="col-xl-3 col-sm-6">
          <div class="card">
            <div class="card-header p-3 pt-2">
              <div class="icon icon-lg icon-shape bg-gradient-info shadow-info text-center border-radius-xl mt-n4 position-absolute">
                <i class="material-icons opacity-10">weekend</i>
              </div>
              <div class="text-end pt-1">
                <p class="text-sm mb-0 text-capitalize">INFO</p>
                <h4 class="mb-0">INFO</h4>
              </div>
            </div>
            <hr class="dark horizontal my-0">
            <div class="card-footer p-3">
              <p class="mb-0"><span class="text-success text-sm font-weight-bolder">DATOS </span>INFO</p>
            </div>
          </div>
        </div>
      </div>
      <div class="row mt-4">
        <div class="col-lg-4 col-md-6 mt-4 mb-4">
          <div class="card z-index-2 ">
            <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2 bg-transparent">
              <div  tabindex="-1" aria-labelledby="ModRegAlumno" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header bg-gradient-primary">
                            <h5 class="modal-title text-white">Registrar Materias</h5>
                        </div>
                        <!-- #para que cargue  -->
                        <form role="form" class="text-start" method="POST" action="{{ url('Home') }}"
                            enctype="multipart/form-data">
                            {!! csrf_field() !!}
                            <div class="modal-body">
                                <div class="input-group input-group-outline mt-2 mb-4">
                                    <div class="col-6">
                                        <div class="input-group input-group-outline me-2">
                                            <label class="form-label">Materia</label>
                                            <input type="text" class="form-control" name="subject_name" required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                              <input type="submit" value="Registrar" class="btn btn-primary">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            </div>
          </div>
        </div>
        <div class="col-lg-4 col-md-6 mt-4 mb-4">
          <div class="card z-index-2  ">
            <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2 bg-transparent">
              <div class="bg-gradient-success shadow-success border-radius-lg py-3 pe-1">
                <div class="chart">
                  <canvas id="chart-line" class="chart-canvas" height="170" style="display: block; box-sizing: border-box; height: 170px; width: 255.3px;" width="255"></canvas>
                </div>
              </div>
            </div>
            <div class="card-body">
              <h6 class="mb-0 "> DATA </h6>
              <p class="text-sm "> (<span class="font-weight-bolder">data</span>) extra data </p>
              <hr class="dark horizontal">
              <div class="d-flex ">
                <i class="material-icons text-sm my-auto me-1">schedule</i>
                <p class="mb-0 text-sm"> actualizado hace X minutos </p>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-4 mt-4 mb-3">
          <div class="card z-index-2 ">
            <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2 bg-transparent">
              <div class="bg-gradient-dark shadow-dark border-radius-lg py-3 pe-1">
                <div class="chart">
                  <canvas id="chart-line-tasks" class="chart-canvas" height="170" style="display: block; box-sizing: border-box; height: 170px; width: 255.3px;" width="255"></canvas>
                </div>
              </div>
            </div>
            <div class="card-body">
              <h6 class="mb-0 ">Data</h6>
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
