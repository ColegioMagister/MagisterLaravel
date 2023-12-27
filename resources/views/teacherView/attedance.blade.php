@extends('layouts.masterpage')
@section('content')
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card my-4">
                    <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2 mb-5">
                        <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                            <h6 class="text-white text-capitalize ps-3">Periodo {{ $section->school_period->period_name }}:
                                {{ $subject->subject_name }}: Asistencia-{{ $schedules->weekday->day_name }}</h4>
                            </h6>
                        </div>
                    </div>
                    <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2 mb-5">
                        <span class="mb-2 text-xl">Grado:
                            <span
                                class="text-dark font-weight-bold ms-sm-2">{{ $section->section_type->section_type }}</span>
                        </span>
                        <span class="mb-2 text-xl">-Seccion:
                            <span class="text-dark font-weight-bold ms-sm-2">{{ $section->section_name }}</span>
                        </span>
                        <span class="mb-2 text-xl">-Nivel:
                            <span class="text-dark font-weight-bold ms-sm-2">{{ $section->level->description }}</span>
                        </span>
                        <span class="mb-2 text-xl font-weight-bold">-Horario:
                            <span class="mb-2 text-xl">-Inicio:
                                <span class="text-dark font-weight-bold ms-sm-2">{{ $schedules->start_datetime }}</span>
                            </span>
                            <span class="mb-2 text-xl">-Fin:
                                <span class="text-dark font-weight-bold ms-sm-2">{{ $schedules->end_datetime }}</span>
                            </span>
                        </span>

                    </div>

                    <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                        <a href="{{ route('teacherView.assessmentAttendaces', ['section' => $section->id, 'subject' => $subject->id]) }}}"
                            type="button" class="btn btn-primary">
                            <i class="fa-solid fa-chevron-left"></i> &nbsp; Volver
                        </a>
                        <button type="button" class="btn btn-success" data-bs-toggle="modal"
                            data-bs-target="#ModRegistroAsistencia">
                            <i class="fa-solid fa-plus text-uppercase"></i>&nbsp;Ingresar Asistencia
                        </button>
                    </div>
                    <div class="card-body px-0 pb-2">
                        <div class="table-responsive p-0">
                            <table class="table align-items-center mb-0">
                                <thead>
                                    <tr>
                                        <th class="text-center opacity-7">ID</th>
                                        <th class="text-uppercase text-center">Nombre</th>
                                        <th class="text-uppercase text-center">Apellido</th>
                                        <th class="text-uppercase text-center">Dni</th>
                                        <th class="text-uppercase text-center">Género</th>
                                        <th class="text-uppercase text-secondary ps-2">Asistencia</th>
                                    </tr>
                                </thead>

                                <body>
                                    @forelse ($attendanceData as $data)
                                        <tr>
                                            <td class="align-middle text-center text-sm">{{ $loop->iteration }}</td>
                                            <td class="align-middle text-uppercase text-center text-sm">
                                                {{ $data->studentSections->student->name }}</td>
                                            <td class="align-middle text-center text-uppercase text-sm">
                                                {{ $data->studentSections->student->lastname }}</td>
                                            <td class="align-middle text-center text-uppercase text-sm">
                                                {{ $data->studentSections->student->dni }}</td>
                                            <td class="align-middle text-center text-uppercase text-sm">
                                                {{ $data->studentSections->student->gender }}</td>
                                            <td>
                                                @if ($data->status == 1)
                                                    <span class="student-section-icon active"></span>
                                                @else
                                                    <span class="student-section-icon inactive"></span>
                                                @endif
                                            </td>
                                        @empty
                                            <p>No hay registro de asistencia</p>
                                    @endforelse
                                    </tr>
                                </body>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection





@section('modals')
    <div class="modal fade" id="ModRegistroAsistencia" tabindex="-1" aria-labelledby="ModRegistroAsistencia"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="ModRegistroAsistencia">Lista de Estudiantes</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                </div>
                <form method="POST" action="{{ route('teacherView.registerAttendance') }}">
                    @csrf
                    <input type="hidden" name="id_schedule" value="{{ $schedules->id }}">
                    <div class="modal-body">
                        <ul class="list-group">
                            @forelse ($studentsInSections as $student)
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    {{ $student->student->name }} {{ $student->student->lastname }}
                                    <div class="form-check form-switch">
                                        <input name="attendance[{{ $student->id }}]" type="checkbox"
                                            class="form-check-input" value="0">
                                    </div>
                                </li>
                            @empty
                                <p>Asistencia Completa</p>
                            @endforelse
                        </ul>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn btn-primary">Guardar Asistencia</button>
                    </div>
                </form>
            </div>
        </div>
    </div>








    <div class="modal fade" id="AssesstUpdateStudentModal" tabindex="-1" aria-labelledby="AssesstUpdateStudentModal"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-gradient-primary">
                    <h5 class="modal-title text-white">Editar Nota</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form role="form" id='AssesstUpdateStudentModal-form' class="text-start alertEdits" method="POST"
                    action="">
                    @method('PATCH')
                    @csrf
                    <div class="modal-body">
                        <div class="input-group input-group-outline mt-2 mb-4">
                            <div class="col-12">
                                <div class="input-group input-group-outline me-2">
                                    <div class="input-group input-group-outline mb-3 focused is-focused w-100">
                                        <input type="text" disabled class="form-control student_name"
                                            name="student_name" value="">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="input-group input-group-outline me-2 focused is-focused">
                                <label class="form-label">Nota</label>
                                <input type="number" class="form-control grade" name="grade" required>
                            </div>
                        </div>

                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary mx-2" data-bs-dismiss="modal">Cerrar</button>
                        <button type="submit" value="Actualizar" class="btn btn-primary " data-bs-toggle="modal">
                            Actualizar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
