@extends('layouts.masterpage')

@section('content')
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card my-4">
                    <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                        <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                            <h6 class="text-white text-capitalize ps-3">Materias</h6>
                        </div>
                        <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#ModRegisMate">
                            <i class="fa-solid fa-plus"></i> Registrar
                        </button>
                    </div>
                    <div class="card-body px-0 pb-2">
                        <div class="table-responsive p-0">
                            <table class="table align-items-center mb-0">
                                <thead>
                                    <tr>
                                        <th class="text-center opacity-7">ID</th>
                                        <th class="text-uppercase text-secondary ps-2">Materias</th>
                                        <th colspan=2 class="text-secondary opacity-7"></th>

                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($subjects as $subject)
                                        <tr>
                                            <td class="align-middle text-center text-sm">{{ $loop->iteration }}</td>
                                            <td>
                                                <div class="d-flex flex-column justify-content-center">
                                                    <h6 class="align-middle text-uppercase text-sm">
                                                        {{ $subject->subject_name }}</h6>
                                                </div>
                                            </td>
                                            <td class="align-middle text-uppercase text-sm">
                                                <button type="submit" class="btn btn-primary" data-bs-toggle="modal"
                                                    data-bs-target="#EditarMateria"
                                                    data-url='{{ route('subjects.edit', $subject) }}'
                                                    data-send="{{ route('subjects.ajax.edit', $subject) }}"
                                                    enctype="multipart/form-data">
                                                    <i class="fa-solid fa-pencil fa-xl"></i> &nbsp; Editar
                                                </button>
                                                <form class="alertDelete" method="POST"
                                                    action="{{ route('subject.destroy', $subject) }}" accept-charset="UTF-8"
                                                    style="display:inline">
                                                    @method('DELETE')
                                                    @csrf
                                                    <button type="submit" class="btn btn-danger" title="Delete Subject">
                                                        <i class="fa fa-trash-o" aria-hidden="true"></i>&nbsp;
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
    @endsection
    @section('modals')
        <!---------------- #MODAL REGISTRAR-------------------------  -->

        <div class="modal fade" id="ModRegisMate" tabindex="-1" aria-labelledby="ModRegisMate" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header bg-gradient-primary">
                        <h5 class="modal-title text-white">Registrar Materia</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form id="subjectRegister" role="form" class="text-start" method="POST"
                        action="{{ route('subject.store') }}" enctype="multipart/form-data">
                        {!! csrf_field() !!}
                        <div class="modal-body">
                            <div class="input-group input-group-outline mt-2 mb-4">
                                <div class="col-6">
                                    <div class="input-group input-group-outline me-2">
                                        <label class="form-label">Materia</label>
                                        <input id="subject_name" type="text" class="form-control" name="subject_name"
                                            required>
                                    </div>
                                    <span id="subject_repit" class="invalid-feedback" role="alert">
                                        <i class="fa-solid fa-triangle-exclamation fa-bounce"></i>
                                        La materia ya se encuentra registrado
                                    </span>
                                    <span id="subject_invalid" class="invalid-feedback" role="alert">
                                        <i class="fa-solid fa-triangle-exclamation fa-bounce"></i>
                                        Al menos 2 caracteres, solo se aceptan letras
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary mx-2" data-bs-dismiss="modal">Cerrar</button>
                            <input id="btnSubject" type="submit" value="Registrar" class="btn btn-primary">
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!---------------- #MODAL EDITAR-------------------------  -->


        <div class="modal fade" id="EditarMateria" tabindex="-1" aria-labelledby="EditarMateria" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header bg-gradient-primary">
                        <h5 class="modal-title text-white">Editar Materia</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form role="form" id='edit-subject-form' class="text-start alertEdits" method="POST"
                        action="" enctype="multipart/form-data">
                        @method('PATCH')
                        @csrf
                        <div class="modal-body">
                            <div class="input-group input-group-outline mt-2 mb-4">
                                <div class="input-group input-group-outline mt-2 mb-4">
                                    <div class="input-group input-group-outline me-2 focused is-focused">
                                        <label class="form-label">Materia</label>
                                        <input id="subject_name_edit" type="text" class="form-control subject_name"
                                            name="subject_name">
                                    </div>
                                    <span id="subject_repit_edit" class="invalid-feedback" role="alert">
                                        <i class="fa-solid fa-triangle-exclamation fa-bounce"></i>
                                        La materia ya se encuentra registrado
                                    </span>
                                    <span id="subject_invalid_edit" class="invalid-feedback" role="alert">
                                        <i class="fa-solid fa-triangle-exclamation fa-bounce"></i>
                                        Al menos 2 caracteres, solo se aceptan letras
                                    </span>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary mx-2"
                                    data-bs-dismiss="modal">Cerrar</button>
                                <button id="btnEditMateria" type="submit"
                                    class="btn btn-primary">{{ __('ACTUALIZAR') }}</button>
                            </div>
                    </form>
                </div>
            </div>
        </div>
    @endsection
