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
                            <i class="fa-solid fa-plus"></i> &nbsp; Registrar
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
                                        <th colspan=5 class="text-secondary opacity-7"></th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @foreach ($teacher as $employee)
                                        <tr>
                                            <td class="align-middle text-center text-sm">{{ $loop->iteration }}</td>
                                            <td class="align-middle text-uppercase text-sm ">
                                                {{ $employee->roles->role_name }}</td>
                                            <td>
                                                <div class="d-flex px-2 py-1">
                                                    <div>
                                                        <img src="{{ $employee->url_img }}"
                                                            class="avatar avatar-sm me-3 border-radius-lg" alt="user1">
                                                    </div>
                                                    <div class="d-flex flex-column justify-content-center">
                                                        <h6 class="mb-0 text-sm">{{ $employee->name }}</h6>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>{{ $employee->lastname }}</td>
                                            <td>{{ $employee->email }}</td>
                                            <td class="align-middle text-uppercase text-sm ">{{ $employee->phone_number }}
                                            </td>
                                            <td class="align-middle text-uppercase text-sm">
                                                <a href="{{ route('teacher.show', $employee->id) }}"
                                                    class="btn btn-success"><i class="fa-solid fa-eye fa-xl"></i> &nbsp;
                                                    Ver</a>
                                            </td>
                                            <td class="align-middle text-uppercase text-sm">

                                                <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                                    data-bs-target="#EditarProfesor"
                                                    data-url="{{ route('teacher.edit', $employee) }}"
                                                    data-send="{{ route('teacher.ajax.edit', $employee) }}"
                                                    enctype="multipart/form-data">
                                                    <i class="fa-solid fa-pencil fa-xl"></i> &nbsp; Editar
                                                </button>
                                                <button type="button" class="btn btn-primary ms-2 me-2"
                                                    data-bs-toggle="modal" data-bs-target="#SubjectTeacherModal"
                                                    data-url="{{ route('teacher.AddSubjec', [$employee]) }}"
                                                    data-send="{{ route('teacher.AddSubjectAjax', [$employee]) }}">
                                                    <i class="fa-solid fa-chalkboard-user fa-xl"></i> &nbsp; Asignar Cursos
                                                </button>

                                                <a class="btn btn-success me-3"
                                                    href="{{ route('teacher.teacherSubject', $employee->id) }}">
                                                    <i class="fa-solid fa-eye fa-xl"></i> &nbsp; Ver Cursos a cargo
                                                </a>

                                                <form class="alertDelete" method="POST"
                                                    action="{{ route('teacher.destroy', $employee) }}"
                                                    accept-charset="UTF-8" style="display:inline">
                                                    {{ method_field('DELETE') }}
                                                    {{ csrf_field() }}
                                                    <button type="submit" class="btn btn-danger" title="Delete Teacher"><i
                                                            class="fa fa-trash-o fa-xl" aria-hidden="true"></i> &nbsp;
                                                        Eliminar</button>
                                                </form>
                                            </td>
                                        <tr>
                                    @endforeach
                                </tbody>

                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection



@section('modals')
    <!-- #MODAL REGISTRAR-------------------------  -->
    <div class="modal fade" id="ModRegTeacher" tabindex="-1" aria-labelledby="ModRegTeacher" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-gradient-primary">
                    <h5 class="modal-title text-white" id="ModRegTeacher">Registrar Profesor</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <!-- #para que cargue  -->
                <form id="teacher_register" class="text-start" role="form" method="POST"
                    action="{{ route('teacher.store') }}" enctype="multipart/form-data">
                    {!! csrf_field() !!}
                    <div class="modal-body">
                        <span id="complet_campos" class="invalid-feedback" role="alert">
                            <i class="fa-solid fa-triangle-exclamation fa-bounce"></i>
                            Completar todos los campos
                        </span>
                        <div class="input-group input-group-outline mt-2 mb-4">
                            <div class="col-6">
                                <div class="input-group input-group-outline me-2">
                                    <select class="form-control" name="id_role" id="id_role" required>
                                        <option value="" selected disabled> Elige un Rol </option>
                                        @foreach ($roles as $rol)
                                            <option value="{{ $rol->id }}" required> {{ $rol->id }} -
                                                {{ $rol->role_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <span id="rol_null" class="invalid-feedback" role="alert">
                                    <i class="fa-solid fa-triangle-exclamation fa-bounce"></i>
                                    Tiene que escoger un rol
                                </span>
                            </div>
                            <div class="col-6">
                                <div class="input-group input-group-outline me-2">
                                    <label class="form-label">Nombres</label>
                                    <input id="name" type="text" class="form-control" name="name" required>
                                </div>
                                <span id="name_invalid" class="invalid-feedback" role="alert">
                                    <i class="fa-solid fa-triangle-exclamation fa-bounce"></i>
                                    Solo se aceptan letras
                                </span>
                            </div>

                        </div>
                        <div class="input-group input-group-outline mt-2 mb-4">
                            <label class="form-label">Apellidos</label>
                            <input id="lastname" type="text" class="form-control" name="lastname" required>
                            <span id="lastname_invalid" class="invalid-feedback" role="alert">
                                <i class="fa-solid fa-triangle-exclamation fa-bounce"></i>
                                Solo se aceptan letras
                            </span>
                        </div>
                        <div class="input-group input-group-outline mt-2 mb-4">
                            <div class="col-6">
                                <div class="input-group input-group-outline me-2">
                                    <label class="form-label">Correo</label>
                                    <input id="email" type="email" class="form-control" name="email" required>
                                </div>
                                <span id="email_repit" class="invalid-feedback" role="alert">
                                    <i class="fa-solid fa-triangle-exclamation fa-bounce"></i>
                                    El correo ya está registrado
                                </span>
                                <span id="email_invalid" class="invalid-feedback" role="alert">
                                    <i class="fa-solid fa-triangle-exclamation fa-bounce"></i>
                                    Ingrese un correo valido
                                </span>
                            </div>
                            <div class="col-6">
                                <div class="input-group input-group-outline me-2">
                                    <label class="form-label">Celular</label>
                                    <input id="phone_number" type="text" class="form-control" name="phone_number"
                                        required>
                                </div>
                                <span id="phone_invalid" class="invalid-feedback" role="alert">
                                    <i class="fa-solid fa-triangle-exclamation fa-bounce"></i>
                                    Debe tener 9 numeros, no se aceptan letras
                                </span>

                            </div>
                        </div>
                        <span class="text-secondary text-xs ms-1" for="url_img">Foto del Profesor</span>
                        <div class="input-group input-group-outline mb-3">
                            <input type="file" class="form-control" id="url_img" name="url_img">
                        </div>
                        <img id="previewImage" class="avatar avatar-sm me-3 border-radius-lg"
                            alt="Vista previa de la imagen">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary mx-2" data-bs-dismiss="modal">Cerrar</button>
                        <button id="btnTeacher" type="submit" class="btn btn-primary">{{ __('REGISTRARSE') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- #MODAL EDITAR-------------------------  -->
    <div class="modal fade" id="EditarProfesor" tabindex="-1" aria-labelledby="EditarProfesor" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-gradient-primary">
                    <h5 class="modal-title text-white">Editar Profesor</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <!-- #para que cargue  -->
                <form role="form" id="edit-teacher-form" class="text-start alertEdits" method="POST" action=""
                    enctype="multipart/form-data">
                    @method('PATCH')
                    @csrf
                    <div class="modal-body">

                        <div class="input-group input-group-outline mt-2 mb-4">
                            <div class="col-6">
                                <div class="input-group input-group-outline me-2 focused is-focused">
                                    <select class="form-control id_role" name="id_role">
                                        <option class="role_name" selected disabled> </option>
                                        @foreach ($roles as $rol)
                                            <option id="id_role_edit" value="{{ $rol->id }}"> {{ $rol->id }} -
                                                {{ $rol->role_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="input-group input-group-outline me-2 focused is-focused">
                                    <label class="form-label">Nombres</label>
                                    <input id="name_edit" type="text" class="form-control name" name="name">
                                </div>
                                <span id="name_invalid_edit" class="invalid-feedback" role="alert">
                                    <i class="fa-solid fa-triangle-exclamation fa-bounce"></i>
                                    Solo se aceptan letras
                                </span>
                            </div>
                        </div>
                        <div class="input-group input-group-outline mt-2 mb-4 focused is-focused">
                            <label class="form-label">Apellidos</label>
                            <input id="lastname_edit" type="text" class="form-control lastname" name="lastname">
                            <span id="lastname_invalid_edit" class="invalid-feedback" role="alert">
                                <i class="fa-solid fa-triangle-exclamation fa-bounce"></i>
                                Solo se aceptan letras
                            </span>
                        </div>
                        <div class="input-group input-group-outline mt-2 mb-4">
                            <div class="col-6">
                                <div class="input-group input-group-outline me-2 focused is-focused">
                                    <label class="form-label">Correo</label>
                                    <input id="email_edit" type="email" class="form-control email" name="email">
                                </div>
                                <span id="email_repit_edit" class="invalid-feedback" role="alert">
                                    <i class="fa-solid fa-triangle-exclamation fa-bounce"></i>
                                    El correo ya está registrado
                                </span>
                                <span id="email_invalid_edit" class="invalid-feedback" role="alert">
                                    <i class="fa-solid fa-triangle-exclamation fa-bounce"></i>
                                    Ingrese un correo valido
                                </span>
                            </div>
                            <div class="col-6">
                                <div class="input-group input-group-outline me-2 focused is-focused">
                                    <label class="form-label">Celular</label>
                                    <input id="phone_number_edit" type="text" class="form-control phone_number"
                                        name="phone_number">
                                </div>
                                <span id="phone_invalid_edit" class="invalid-feedback" role="alert">
                                    <i class="fa-solid fa-triangle-exclamation fa-bounce"></i>
                                    Debe tener 9 numeros, no se aceptan letras
                                </span>
                            </div>

                        </div>
                        <span class="text-secondary text-xs ms-1" for="url_img">Foto del Profesor</span>
                        <div class="input-group input-group-outline mb-3 focused is-focused">
                            <input type="file" class="form-control url_img" id="url_img" name="url_img">
                        </div>
                        <img id="previewImage" class="avatar avatar-sm me-3 border-radius-lg"
                            alt="Vista previa de la imagen">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary mx-2" data-bs-dismiss="modal">Cerrar</button>
                        <button id="btnEditTeacher" type="submit"
                            class="btn btn-primary">{{ __('ACTUALIZAR') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <div class="modal fade" id="SubjectTeacherModal" tabindex="-1" aria-labelledby="SubjectTeacherModal"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-gradient-primary">
                    <h5 class="modal-title text-white">Asignar Materia</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <form role="form" id="SubjectTeacherModal-form" class="text-start" method="POST"
                    action="{{ route('teacherView.registerNota') }}">
                    @csrf
                    <div class="modal-body">
                        <div class="input-group input-group-outline mt-2 mb-4">
                            <div class="col-12">
                                <div class="input-group input-group-outline me-2">
                                    <div class="input-group input-group-outline me-2">
                                        <div class="input-group input-group-outline mb-3 focused is-focused w-100">
                                            <input type="text" disabled class="form-control teacher_name"
                                                name="teacher_name" value="">
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
                                        <option value="{{ $subject->id }}"> {{ $subject->subject_name }}</option>
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
