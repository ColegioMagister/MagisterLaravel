@extends('layouts.masterpage')

@section('content')

<div class="row">
<div class="col-12">
<div class="card my-4">
<div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
<div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
    <h6 class="text-white text-capitalize ps-3">ALUMNOS</h6>
</div>
<button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#ModRegAlumno">
    <i class="fa-solid fa-plus"></i> &nbsp; Ingresar
</button>
</div>
<div class="card-body px-0 pb-2">
<div class="table-responsive p-0">
<table class="table align-items-center mb-0">
<thead>
<tr>
<th class="text-center opacity-7">ID</th>
<th class="text-uppercase text-secondary ps-2">Nombre</th>
<th class="text-uppercase text-secondary ps-2 ">Telefono</th>
<th class="text-uppercase text-secondary ps-2 ">Correo</th>
<th class="text-uppercase text-secondary ps-2">Sexo</th>
<th colspan=2 class="text-secondary opacity-7"></th>
</tr>
</thead>
    <tbody>
        
        <tr>
            <td class="align-middle text-center text-sm"></td>
            <td >
                <div class="d-flex px-2 py-1">
                    <div>
                        <img src="" class="avatar avatar-sm me-3 border-radius-lg" alt="user1">
                    </div>
                    <div class="d-flex flex-column justify-content-center">
                            <h6 class="mb-0 text-sm"></h6>
                    </div>
                </div>
            </td>
            <td class="align-middle text-uppercase text-sm "></td>
            <td ></td>
            <td>    </td>
            <td class="align-middle text-uppercase text-sm">
                <a href="javascript:;" class="text-secondary font-weight-bold text-xs" data-toggle="tooltip" data-original-title="Edit user">
                Editar
                </a>
            </td>
            <td class="align-middle text-uppercase text-sm">
                <a href="javascript:;" class="text-secondary font-weight-bold text-xs" data-toggle="tooltip" data-original-title="Edit user">
                Eliminar
                </a>
            </td>
        <tr>
        
    </tbody>
</table>
</div>
</div>
</div>
</div>
</div>

<div class="modal fade" id="ModRegAlumno" tabindex="-1" aria-labelledby="ModRegAlumno" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header bg-gradient-primary">
                    <h5 class="modal-title text-white" id="ModRegAlumno">Registrar Estudiante</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                                                                                 <!-- #para que cargue  -->
                    <form role="form" class="text-start" method="POST" action="{{ url('student') }}" enctype="multipart/form-data">
                    {!! csrf_field() !!}

                        <div class="modal-body">
                            <p> Ingresar Datos del Estudiante: </p>
                            <div class="input-group input-group-outline mt-2 mb-4">

                                <div class="col-6">
                                    <div class="input-group input-group-outline me-2">
                                        <label class="form-label">Nombres</label>
                                        <input type="text" class="form-control" name="nombre" required>
                                    </div>
                                </div>
                            
                                <div class="col-6">
                                    <div class="input-group input-group-outline">
                                        <label class="form-label">Apellidos</label>
                                        <input type="text" class="form-control" name="apellido" required>
                                    </div>
                                </div>

                            </div>


                            <div class="input-group input-group-outline mt-2 mb-4">

                                <div class="col-4">
                                    <div class="input-group input-group-outline me-2">
                                        <label class="form-label">Nacimiento</label>
                                        <input type="text" class="form-control" name="fNacimiento" required>
                                    </div>
                                </div>

                                <div class="col-4">
                                    <div class="input-group input-group-outline me-2">
                                        <label class="form-label">Genero</label>
                                        <input type="text" class="form-control" name="genero" required>
                                    </div>
                                </div>

                                <div class="col-4">
                                    <div class="input-group input-group-outline">
                                        <label class="form-label">Celular</label>
                                        <input type="password" class="form-control" name="celular" required>
                                    </div>
                                </div>
                            
                            </div>

                            <div class="input-group input-group-outline mb-3">
                                <label class="form-label">dni</label>
                                <input type="text" class="form-control" name="dni" required>
                            </div>

                            <span class="text-secondary text-xs ms-1" for="url_img">Foto del estudiante</span>
                            <div class="input-group input-group-outline mb-3">
                                <input type="file" class="form-control" id="url_img" name="url_img">
                            </div>
                                <img id="previewImage" class="avatar avatar-sm me-3 border-radius-lg" alt="Vista previa de la imagen">
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary mx-2" data-bs-dismiss="modal">Cerrar</button>
                            <input class="btn btn-primary" type="submit" name="submit" value="Registrar">
                        </div>
                    </form>
                    
                </div>
            </div>
        </div>
    </div>
</div>
<script>
  document.getElementById('url_img').addEventListener('change', function (e) {
    var file = e.target.files[0];
    var reader = new FileReader();
    
    reader.onload = function (event) {
      document.getElementById('previewImage').setAttribute('src', event.target.result);
    }
    
    reader.readAsDataURL(file);
  });
</script>





@endsection
