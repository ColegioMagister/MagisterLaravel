
@extends('layouts.masterpage')

@section('content')

<div class="container-fluid py-4">
<div class="row">
<div class="col-12">
<div class="card my-4">
                <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                    <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                        <h6 class="text-white text-capitalize ps-3">Alumnos</h6>
                    </div>
                    <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#ModRegAlumno">
                        <i class="fa-solid fa-plus"></i> Ingresar
                    </button>
                </div>
    <div class="card-body px-0 pb-2">
    <div class="table-responsive p-0">
        <table class="table align-items-center mb-0">
            <thead>
                <tr>
                <th class="text-center opacity-7">ID</th>
                <th class="text-uppercase text-secondary ps-2">Nombre</th>
                <th class="text-uppercase text-secondary ps-2">Apellido</th>
                <th class="text-uppercase text-secondary ps-2 ">Fecha de Nacimiento</th>
                <th class="text-uppercase text-secondary ps-2 ">Género</th>
                <th class="text-uppercase text-secondary ps-2">Teléfono</th>
                <th class="text-uppercase text-secondary ps-2">Dni</th>
                <th colspan=2 class="text-secondary opacity-7"></th>
                
                </tr>
            </thead>
            <tbody>
                @foreach($students as $item)
                    <tr>
                        <td class="align-middle text-center text-sm">{{ $loop->iteration }}</td>
                        <td >
                            <div class="d-flex px-2 py-1">
                                <div class="modal_img" data-bs-toggle="modal">
                                    <img src="{{ $item->url_img}}" class="avatar avatar-sm me-3 border-radius-lg" alt="user1">
                                </div>
                                <div class="d-flex flex-column justify-content-center">
                                        <h6 class="align-middle text-uppercase text-sm" >{{ $item->name }}</h6>
                                </div>
                            </div>
                        </td>
                        <td class="align-middle text-uppercase text-sm ">{{ $item->lastname }}</td>
                        <td >{{ $item->bithdate }}</td>
                        <td>{{ $item->gender }}</td>
                        <td class="align-middle text-uppercase text-sm ">{{ $item->phone_number }}</td>
                        <td class="align-middle text-uppercase text-sm ">{{ $item->dni }}</td>
                        <td class="align-middle text-uppercase text-sm">
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#EditarEstudiante{{ $item->id }}" enctype="multipart/form-data">
                                    <i class="fa-solid fa-plus"></i> Editar
                            </button>
                            <!-- #MODAL EDITAR-------------------------  -->
                            <div class="modal fade" id="EditarEstudiante{{ $item->id }}" tabindex="-1" aria-labelledby="EditarEstudiante" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header bg-gradient-primary">
                                        <h5 class="modal-title text-white" >Editar Estudiante</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>                                                    
                                        <form role="form" class="text-start" method="POST" action="{{ url('Students/'. $item->id) }}" enctype="multipart/form-data">
                                        {!! csrf_field() !!}
                                        <input type="hidden" name="_method" value="PUT">
                                        @method("PATCH")
                                            <div class="modal-body">
                                                <div class="input-group input-group-outline mt-2 mb-4">
                                                    <div class="col-6">
                                                        <div class="input-group input-group-outline me-2 focused is-focused">
                                                            <label class="form-label">Nombres</label>
                                                            <input type="text" class="form-control"  value="{{$item->name}}" name="name" >
                                                        </div>
                                                    </div>
                                                    <div class="col-6">
                                                        <div class="input-group input-group-outline focused is-focused">
                                                            <label class="form-label">Apellidos</label>
                                                            <input type="text" class="form-control"  value="{{$item->lastname}}" name="lastname" >
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="input-group input-group-outline mt-2 mb-4">
                                                    <div class="col-4">
                                                        <div class="input-group input-group-outline me-2 focused is-focused">
                                                            <label class="form-label ">Nacimiento</label>
                                                            <input type="date" class="form-control"  value="{{$item->bithdate}}" name="bithdate" >
                                                        </div>
                                                    </div>
                            
                                                    <div class="col-4">
                                                        <div class="input-group input-group-outline me-2 focused is-focused">
                                                            <label class="form-label">Genero</label>
                                                            <input type="text" class="form-control"  value="{{$item->gender}}" name="gender" >
                                                        </div>
                                                    </div>
                            
                                                    <div class="col-4">
                                                        <div class="input-group input-group-outline focused is-focused">
                                                            <label class="form-label">Celular</label>
                                                            <input type="number" class="form-control"  value="{{$item->phone_number}}" name="phone_number">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="input-group input-group-outline mb-3 focused is-focused">
                                                    <label class="form-label">dni</label>
                                                    <input type="number" class="form-control"  value="{{$item->dni}}" name="dni">
                                                </div>
                                                <span class="text-secondary text-xs ms-1" for="url_img">Foto del estudiante</span>
                                                <div class="input-group input-group-outline mb-3d">
                                                    <input type="file" class="form-control" id="url_img" name="url_img" >
                                                </div>
                                                <img id="previewImage" class="avatar avatar-sm me-3 border-radius-lg" alt="Vista previa de la imagen" src="{{$item->url_img}}">
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary mx-2" data-bs-dismiss="modal">Cerrar</button>
                                                <input type="submit" value="Actualizar" class="btn btn-primary">
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </td>
                        <td class="align-middle text-uppercase text-sm">
                            <form method="POST" action="{{ url('/Students' . '/' . $item->id) }}" accept-charset="UTF-8" style="display:inline">
                                {{ method_field('DELETE') }}
                                {{ csrf_field() }}
                                <button type="submit" class="btn btn-danger btn-sm" title="Delete Student" onclick='return confirm("Confirm delete?")'><i class="fa fa-trash-o" aria-hidden="true"></i>Eliminar</button>
                            </form>
                        </td>
                    <tr>
                @endforeach 
            </tbody>
                <!-- #MODAL REGISTRAR-------------------------  -->
                <div class="modal fade" id="ModRegAlumno" tabindex="-1" aria-labelledby="ModRegAlumno" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header bg-gradient-primary">
                            <h5 class="modal-title text-white" >Registrar Estudiante</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                                                                                        <!-- #para que cargue  -->
                            <form role="form" class="text-start" method="POST" action="{{ url('Students') }}" enctype="multipart/form-data">
                            {!! csrf_field() !!}
                                <div class="modal-body">
                                    <div class="input-group input-group-outline mt-2 mb-4">
                                        <div class="col-6">
                                            <div class="input-group input-group-outline me-2">
                                                <label class="form-label">Nombres</label>
                                                <input type="text" class="form-control" name="name" required>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="input-group input-group-outline">
                                                <label class="form-label">Apellidos</label>
                                                <input type="text" class="form-control" name="lastname" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="input-group input-group-outline mt-2 mb-4">
                                        <div class="col-4">
                                            <div class="input-group input-group-outline me-2">
                                                <label class="form-label ">Nacimiento</label>
                                                <input type="date" class="form-control" name="bithdate"  required>
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <div class="input-group input-group-outline me-2">
                                                <label class="form-label">Genero</label>
                                                <input type="text" class="form-control" name="gender" required>
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <div class="input-group input-group-outline">
                                                <label class="form-label">Celular</label>
                                                <input type="number" class="form-control" name="phone_number" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="input-group input-group-outline mb-3">
                                        <label class="form-label">dni</label>
                                        <input type="number" class="form-control" name="dni" required>
                                    </div>
                                    <span class="text-secondary text-xs ms-1" for="url_img">Foto del estudiante</span>
                                    <div class="input-group input-group-outline mb-3">
                                        <input type="file" class="form-control" id="url_img" name="url_img">
                                    </div>
                                    <img id="previewImage" class="avatar avatar-sm me-3 border-radius-lg" alt="Vista previa de la imagen">
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary mx-2" data-bs-dismiss="modal">Cerrar</button>
                                    <input type="submit" value="Registrar" class="btn btn-primary">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
        </table>
    </div>
    </div>
</div>
</div>
</div>
</div>

@endsection

