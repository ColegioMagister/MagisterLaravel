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
                        <i class="fa-solid fa-plus"></i> Registrar
                    </button>
                    <td class="align-middle text-uppercase text-sm">
                        <a href="{{route('reportes.alumnos')}}" class="btn btn-primary" type="submit">
                            <i class="fa-solid fa-plus"></i> Descargar Lista de alumnos
                        </a>  
                    </td>
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
                                    <th colspan=4 class="text-secondary opacity-7"></th>

                                </tr>
                            </thead>
                            <tbody>
                                @foreach($students as $student)
                                <tr>
                                    <td class="align-middle text-center text-sm">{{ $loop->iteration }}</td>
                                    <td>
                                        <div class="d-flex px-2 py-1">
                                            <div class="modal_img" data-bs-toggle="modal">
                                                <img src="{{ $student->url_img}}"
                                                    class="avatar avatar-sm me-3 border-radius-lg" alt="user1">
                                            </div>
                                            <div class="d-flex flex-column justify-content-center">
                                                <h6 class="align-middle text-uppercase text-sm">{{ $student->name }}</h6>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="align-middle text-uppercase text-sm ">{{ $student->lastname }}</td>
                                    <td>{{ $student->bithdate }}</td>
                                    <td>{{ $student->gender }}</td>
                                    <td class="align-middle text-uppercase text-sm ">{{ $student->phone_number }}</td>
                                    <td class="align-middle text-uppercase text-sm ">{{ $student->dni }}</td>
                                    <td class="align-middle text-uppercase text-sm">
                                        <a href="{{route('students.show',$student->id)}}" class="btn btn-success"><i class="fa-solid fa-eye fa-xl"></i> &nbsp; Ver</a>

                                        <button type="submit" class="btn btn-primary" data-bs-toggle="modal"
                                            data-bs-target="#EditarEstudiante" data-url='{{route('students.edit',$student)}}'
                                             data-send="{{route('students.ajax.edit', $student)}}" enctype="multipart/form-data">
                                             <i class="fa-solid fa-pencil fa-xl"></i> &nbsp; Editar
                                        </button>
                                          
                                        <form class="alertDelete" method="POST"
                                            action="{{ route('students.destroy',$student) }}" accept-charset="UTF-8"
                                            style="display:inline">
                                            @method('DELETE')
                                            @csrf
                                            <button type="submit" class="btn btn-danger"
                                                title="Delete Student"><i class="fa fa-trash-o fa-xl"
                                        aria-hidden="true"></i> &nbsp; Eliminar</button>
                                        </form>
                                        <a href="{{route('reportes.libreta', $student->id)}}" class="btn btn-primary" type="submit">
                                            <i class="fa-solid fa-plus"></i> Descargar
                                        </a>  
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
<!------------- #MODAL REGISTRAR-------------------------  -->

<div class="modal fade" id="ModRegAlumno" tabindex="-1" aria-labelledby="ModRegAlumno" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-gradient-primary">
                <h5 class="modal-title text-white">Registrar Estudiante</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <!-- #para que cargue  -->
            <form id="student_register" role="form" class="text-start" method="POST" action="{{route('students.store') }}"
                enctype="multipart/form-data">
                {!! csrf_field() !!}
                <div class="modal-body">
                    <div class="input-group input-group-outline mt-2 mb-4">
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
                        <div class="col-6">
                            <div class="input-group input-group-outline">
                                <label class="form-label">Apellidos</label>
                                <input id="lastname" type="text" class="form-control" name="lastname" required>
                            </div>
                            <span id="lastname_invalid" class="invalid-feedback" role="alert">
                                <i class="fa-solid fa-triangle-exclamation fa-bounce"></i>
                                Solo se aceptan letras
                            </span>
                        </div>
                    </div>
                    <div class="input-group input-group-outline mt-2 mb-4">
                        <div class="col-6">
                            <div class="input-group input-group-outline me-2 focused is-focused">
                                <label class="form-label ">Nacimiento</label>
                                <input id="birthday" type="date" class="form-control" name="bithdate" required>
                            </div>
                            <span id="date_invalid" class="invalid-feedback" role="alert">
                                <i class="fa-solid fa-triangle-exclamation fa-bounce"></i>
                                Escoja una fecha
                            </span>
                        </div>
                        <div class="col-6">
                            <div class="input-group input-group-outline focused is-focused">
                                <select id="gender" class="form-control" name="gender" required>
                                    <option value="" selected disabled>Genero</option>
                                    <option value="Masculino">Masculino</option>
                                    <option value="Femenino">Femenino</option>
                                </select>
                            </div>
                            <span id="gender_null" class="invalid-feedback" role="alert">
                                <i class="fa-solid fa-triangle-exclamation fa-bounce"></i>
                                Seleccione una opción
                            </span>
                        </div>
                       
                    </div>
                    <div class="input-group input-group-outline mt-2 mb-4">
                        <div class="col-6">
                            <div class="input-group input-group-outline me-2">
                                <label class="form-label">Dni</label>
                                <input id="dni" type="text" class="form-control" name="dni" required>
                            </div>
                            <span id="dni_invalid" class="invalid-feedback" role="alert">
                                <i class="fa-solid fa-triangle-exclamation fa-bounce"></i>
                                Debe tener 8 numeros
                            </span>
                            <span id="dni_repit" class="invalid-feedback" role="alert">
                                <i class="fa-solid fa-triangle-exclamation fa-bounce"></i>
                                Dni ya se encuentra registrado
                            </span>
                        </div>
                        <div class="col-6">
                            <div class="input-group input-group-outline">
                                <label class="form-label">Celular</label>
                                <input id="phone" type="text" class="form-control" name="phone_number" required>
                            </div>
                            <span id="phone_invalid" class="invalid-feedback"  role="alert">
                                <i class="fa-solid fa-triangle-exclamation fa-bounce"></i>
                                Debe tener 9 numeros
                            </span>
                        </div>
                    </div>
                    <span class="text-secondary text-xs ms-1" for="url_img">Foto del Alumno</span>
                    <div class="input-group input-group-outline mb-3">
                        <input type="file" class="form-control" id="url_img" name="url_img">
                    </div>
                        <img id="previewImage" class="avatar avatar-sm me-3 border-radius-lg" alt="Vista previa de la imagen"> 
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary mx-2" data-bs-dismiss="modal">Cerrar</button>
                    <input id="btnStudent" type="submit" value="Registrar" class="btn btn-primary">
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('modals')




<!---------------- #MODAL EDITAR-------------------------  -->


<div class="modal fade" id="EditarEstudiante" tabindex="-1" aria-labelledby="EditarEstudiante" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-gradient-primary">
                <h5 class="modal-title text-white">Editar Estudiante</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form role="form" id='edit-students-form' class="text-start alertEdits" method="POST" action="" enctype="multipart/form-data">
                @method("PATCH")
                @csrf
                <div class="modal-body">
                    <div class="input-group input-group-outline mt-2 mb-4">
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
                        <div class="col-6">
                            <div class="input-group input-group-outline focused is-focused">
                                <label class="form-label">Apellidos</label>
                                <input id="lastname_edit" type="text" class="form-control lastname" name="lastname">
                            </div>
                            <span id="lastname_invalid_edit" class="invalid-feedback" role="alert">
                                <i class="fa-solid fa-triangle-exclamation fa-bounce"></i>
                                Solo se aceptan letras
                            </span>
                        </div>
                    </div>
                    <div class="input-group input-group-outline mt-2 mb-4">
                        <div class="col-6">
                            <div class="input-group input-group-outline me-2 focused is-focused">
                                <label class="form-label">Nacimiento</label>
                                <input id="birthday_edit" type="date" class="form-control birthdate" name="bithdate">
                            </div>
                            <span id="date_invalid_edit" class="invalid-feedback" role="alert">
                                <i class="fa-solid fa-triangle-exclamation fa-bounce"></i>
                                Escoja una fecha
                            </span>
                        </div>
                        <div class="col-6">
                            <div class="input-group input-group-outline focused is-focused">
                                <select id="gender_edit" class="form-control gender" name="gender" required>
                                    <option value="" selected disabled>Genero</option>
                                    <option value="Masculino">Masculino</option>
                                    <option value="Femenino">Femenino</option>
                                </select>
                            </div>
                            <span id="gender_null_edit" class="invalid-feedback" role="alert">
                                <i class="fa-solid fa-triangle-exclamation fa-bounce"></i>
                                Seleccione una opción
                            </span>
                        </div>
                    </div>
                    <div class="input-group input-group-outline mt-2 mb-4">
                        <div class="col-6">
                            <div class="input-group input-group-outline me-2  focused is-focused">
                                <label class="form-label">dni</label>
                                <input id="dni_edit" type="text" class="form-control dni" name="dni">
                            </div>
                            <span id="dni_invalid_edit" class="invalid-feedback" role="alert">
                                <i class="fa-solid fa-triangle-exclamation fa-bounce"></i>
                                Debe tener 8 numeros
                            </span>
                            <span id="dni_repit_edit" class="invalid-feedback" role="alert">
                                <i class="fa-solid fa-triangle-exclamation fa-bounce"></i>
                                Dni ya se encuentra registrado
                            </span>
                        </div>
                        <div class="col-6">
                            <div class="input-group input-group-outline focused is-focused">
                                <label class="form-label">Celular</label>
                                <input id="phone_edit" type="text" class="form-control phone_number" name="phone_number">
                            </div>
                            <span id="phone_invalid_edit" class="invalid-feedback"  role="alert">
                                <i class="fa-solid fa-triangle-exclamation fa-bounce"></i>
                                Debe tener 9 numeros
                            </span>
                        </div>
                    </div>
                    <span class="text-secondary text-xs ms-1" for="url_img">Foto del estudiante</span>
                    <div class="input-group input-group-outline mb-3d">
                        <input type="file" class="form-control url_img" id="url_img" name="url_img">
                    </div>
                    <img id="previewImage" class="avatar avatar-sm me-3 border-radius-lg"
                        alt="Vista previa de la imagen" src="">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary mx-2" data-bs-dismiss="modal">Cerrar</button>
                    <input id="btnEditStudent" type="submit" value="Actualizar" class="btn btn-primary">

                </div>
            </form>
        </div>
    </div>
</div>

@endsection