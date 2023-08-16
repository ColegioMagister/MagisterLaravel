@extends('layouts.masterpage')

@section('content')
<div class="container-fluid py-4">
<div class="row">
<div class="col-12">
<div class="card my-4">
                <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                    <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                        <h6 class="text-white text-capitalize ps-3">Profesores</h6>
                    </div>
                    <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#ModRegTeacher">
                        <i class="fa-solid fa-plus"></i> &nbsp; Ingresar
                    </button>
                </div>
    <div class="card-body px-0 pb-2">
    <div class="table-responsive p-0">
        <table class="table align-items-center mb-0">
            <thead>
                <tr>
                <th class="text-center opacity-7">ID</th>
                <th class="text-uppercase text-secondary ps-2">Rol</th>
                <th class="text-uppercase text-secondary ps-2 ">Nombre</th>
                <th class="text-uppercase text-secondary ps-2 ">Apellidos</th>
                <th class="text-uppercase text-secondary ps-2">Email</th>
                <th class="text-uppercase text-secondary ps-2">Telefono</th>
                <th colspan=2 class="text-secondary opacity-7"></th>
                </tr>
            </thead>
            <tbody>
            
                @foreach($teacher as $item)
                    <tr>
                        <td class="align-middle text-center text-sm">{{ $loop->iteration }}</td>
                        <td class="align-middle text-uppercase text-sm ">{{ $item->roles->role_name }}</td>
                        <td >
                            <div class="d-flex px-2 py-1">
                                <div>
                                    <img src="{{ $item->url_img}}   " class="avatar avatar-sm me-3 border-radius-lg" alt="user1">
                                </div>
                                <div class="d-flex flex-column justify-content-center">
                                        <h6 class="mb-0 text-sm">{{ $item->name }}</h6>
                                </div>
                            </div>
                        </td>
                        <td >{{ $item->lastname }}</td>
                        <td>{{ $item->email }}</td>
                        <td class="align-middle text-uppercase text-sm ">{{ $item->phone_number }}</td>
                        <td class="align-middle text-uppercase text-sm">
                            <a href="{{route('teacher.show',$item->id)}}" class="btn btn-success"><i class="fa-solid fa-eye fa-xl"></i> &nbsp; Ver</a>
                        </td>  
                        <td class="align-middle text-uppercase text-sm">
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#EditarProfesor{{ $item->id }}" enctype="multipart/form-data">
                                <i class="fa-solid fa-pencil fa-xl"></i> &nbsp; Editar
                        </button>
                        <button type="button" class="btn btn-primary ms-2 me-2"
                        data-bs-toggle="modal" data-bs-target="#SubjectTeacherModal"
                        data-url="{{ route('teacher.AddSubjec', [$item]) }}"
                        data-send="{{ route('teacher.AddSubjectAjax', [$item]) }}">
                    <i class="fa-solid fa-chalkboard-user fa-xl"></i> &nbsp; Asignar Cursos
                </button>
                    <a class="btn btn-success me-3" href="{{ route('teacher.teacherSubject', $item->id)}}">
                        <i class="fa-solid fa-eye fa-xl"></i> &nbsp; Ver Cursos a cargo
                    </a>
                    <!-- #MODAL EDITAR-------------------------  -->
                        <div class="modal fade" id="EditarProfesor{{ $item->id }}" tabindex="-1" aria-labelledby="EditarProfesor" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header bg-gradient-primary">
                                            <h5 class="modal-title text-white" >Editar Profesor</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                                                                                    <!-- #para que cargue  -->
                                        <form role="form" class="text-start alertEdits" method="POST" action="{{ url('Profesor/'. $item->id) }}" enctype="multipart/form-data">
                                        {!! csrf_field() !!}
                                        @method("PATCH")
                                            <div class="modal-body">
                                                <div class="input-group input-group-outline mt-2 mb-4">
                                                    <div class="col-6">
                                                        <div class="input-group input-group-outline me-2 focused is-focused">
                                                            <select class="form-control" name="id_role" id="id_role">
                                                                <option selected disabled>Elige un Rol </option>
                                                            @foreach($roles as $rol)
                                                                <option value="{{$rol->id}}"> {{$rol->id}} - {{$rol->role_name}}</option>
                                                            @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-6">
                                                        <div class="input-group input-group-outline me-2 focused is-focused">
                                                            <label class="form-label">Nombres</label>
                                                            <input type="text" class="form-control" value="{{$item->name}}" name="name" required>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="input-group input-group-outline mt-2 mb-4 focused is-focused">
                                                    <label class="form-label">Apellidos</label>
                                                    <input type="text" class="form-control" value="{{$item->lastname}}" name="lastname" required>
                                                </div>
                                                <div class="input-group input-group-outline mt-2 mb-4">
                                                    <div class="col-6">
                                                        <div class="input-group input-group-outline me-2 focused is-focused">
                                                            <label class="form-label">Correo</label>
                                                            <input type="email" class="form-control" value="{{$item->email}}" name="email" required>
                                                        </div>  
                                                    </div>
                                                    <div class="col-6">
                                                        <div class="input-group input-group-outline me-2 focused is-focused">
                                                            <label class="form-label">Celular</label>
                                                            <input type="number" class="form-control" value="{{$item->phone_number}}" name="phone_number" required>
                                                        </div>
                                                    </div>
                                                
                                                </div>
                                                <span class="text-secondary text-xs ms-1" for="url_img">Foto del Profesor</span>
                                                <div class="input-group input-group-outline mb-3 focused is-focused">
                                                    <input type="file" class="form-control" id="url_img"  name="url_img">
                                                </div>
                                                <img id="previewImage" class="avatar avatar-sm me-3 border-radius-lg" alt="Vista previa de la imagen" src="{{$item->url_img}}">
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary mx-2" data-bs-dismiss="modal">Cerrar</button>
                                                <button type="submit" value="Actualizar" class="btn btn-primary " data-bs-toggle="modal">
                                                    <i class="fa-solid fa-plus"></i> Actualizar</button>
                                            </div>
                                        </form>        
                                    </div>
                                </div>
                            </div>
                        </td>
                        <td class="align-middle text-uppercase text-sm">
                            <form  class="alertDelete" method="POST" action="{{ url('/Profesor' . '/' . $item->id) }}" accept-charset="UTF-8" style="display:inline">
                                {{ method_field('DELETE') }}
                                {{ csrf_field() }}
                                <button type="submit" class="btn btn-danger" title="Delete Teacher" ><i class="fa fa-trash-o fa-xl"
                                        aria-hidden="true"></i> &nbsp; Eliminar</button>
                            </form>
                        </td>
                    <tr>
                 @endforeach  
            </tbody>
            <!-- #MODAL REGISTRAR-------------------------  -->
            <div class="modal fade" id="ModRegTeacher" tabindex="-1" aria-labelledby="ModRegTeacher" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header bg-gradient-primary">
                        <h5 class="modal-title text-white" id="ModRegTeacher">Registrar Profesor</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        
                                                                            <!-- #para que cargue  -->
                        <form class="text-start" role="form" method="POST" action="{{ url('Profesor') }}" enctype="multipart/form-data">
                        {!! csrf_field() !!}
                            <div class="modal-body">
                                <div class="input-group input-group-outline mt-2 mb-4">
                                    <div class="col-6">
                                        <div class="input-group input-group-outline me-2">
                                            <select class="form-control" name="id_role" id="id_role">
                                                    <option selected disabled> Elige un Rol </option>
                                                @foreach($roles as $rol)
                                                    <option value="{{$rol->id}}"> {{$rol->id}} - {{$rol->role_name}}</option>
                                                @endforeach
		            						</select>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="input-group input-group-outline me-2">
                                            <label class="form-label">Nombres</label>
                                            <input type="text" class="form-control" name="name" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="input-group input-group-outline mt-2 mb-4">
                                    <label class="form-label">Apellidos</label>
                                    <input type="text" class="form-control" name="lastname" required>
                                </div>  
                                <div class="input-group input-group-outline mt-2 mb-4">
                                    <div class="col-6">
                                        <div class="input-group input-group-outline me-2">
                                            <label class="form-label">Correo</label>
                                            <input type="email" class="form-control" name="email" required>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="input-group input-group-outline me-2">
                                            <label class="form-label">Celular</label>
                                            <input type="number" class="form-control" name="phone_number" required>
                                        </div>
                                    </div>
                                </div>
                                <span class="text-secondary text-xs ms-1" for="url_img">Foto del Profesor</span>
                                <div class="input-group input-group-outline mb-3">
                                    <input type="file" class="form-control" id="url_img" name="url_img">
                                </div>
                                    <img id="previewImage" class="avatar avatar-sm me-3 border-radius-lg" alt="Vista previa de la imagen">
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary mx-2" data-bs-dismiss="modal">Cerrar</button>
                                <input class="btn btn-primary" type="submit" value="Registrar">
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



@section('modals')


<div class="modal fade" id="SubjectTeacherModal" tabindex="-1" aria-labelledby="SubjectTeacherModal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-gradient-primary">
                <h5 class="modal-title text-white">Asignar Materia</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <form role="form" id="SubjectTeacherModal-form" class="text-start" method="POST" action="{{ route('teacherView.registerNota') }}">
                @csrf
                <div class="modal-body">
                    <div class="input-group input-group-outline mt-2 mb-4">
                        <div class="col-12">
                            <div class="input-group input-group-outline me-2">
                                <div class="input-group input-group-outline me-2">
                                    <div class="input-group input-group-outline mb-3 focused is-focused w-100">
                                        <input type="text" disabled class="form-control teacher_name" name="teacher_name" value="">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="input-group input-group-outline me-2">
                            <select class="form-select" name="id_subject" id="" required>
                                <option value="" selected disabled> Selecciona Materia </option>
                                @foreach ($subjects as $subject)
                                    <option value="{{$subject->id}}"> {{$subject->subject_name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary mx-2" data-bs-dismiss="modal">Cerrar</button>
                    <input type="submit" value="Registrar" class="btn btn-primary">
                </div>
            </form>
        </div>
    </div>
</div>

@endsection



