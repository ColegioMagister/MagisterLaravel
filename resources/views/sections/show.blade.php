@extends('layouts.masterpage')

@section('content')

<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="card my-4">

                <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                    <div class="bg-gradient-primary show-title-module shadow-primary border-radius-lg pt-4 pb-3">
                        <h6 class="text-white text-capitalize ps-3">
                            {{$section->section_type->section_type}}: {{$section->section_name}}
                        </h6>
                        <h6>
                            Año escolar: {{$section->school_period->period_name}}
                        </h6>
                        <h6>
                            Conteo de alumnos: {{$section_students->count()}}
                        </h6>
                    </div>

                    <div>
                        <a href="{{route('sections.index', ['school_period' => $section->school_period])}}" type="button" class="btn btn-primary">
                            <i class="fa-solid fa-chevron-left"></i> &nbsp; Volver a las secciones
                        </a>
                    </div>

                    <button type="button" class="btn btn-success" data-bs-toggle="modal"
                        data-bs-target="#ModRegSecStudent">
                        <i class="fa-solid fa-plus"></i> &nbsp; Registrar alumno
                    </button>

                    <button type="button" class="btn btn-success ms-4" data-bs-toggle="modal"
                        data-bs-target="#ModRegSecSubject">
                        <i class="fa-solid fa-plus"></i> &nbsp; Registrar Materia
                    </button>

                </div>

                <div class="table-title text-center">
                    <h4>
                        Alumnos
                    </h4> 
                </div>



                <div class="card-body px-0 pb-2">
                    <div class="table-responsive p-0">

                        <table class="table align-items-center mb-0">
                            <thead>
                                <tr>
                                    <th class="text-center opacity-7">#COD</th>
                                    <th class="text-uppercase text-secondary ps-2">Nombre y apellido</th>
                                    <th class="text-uppercase text-secondary ps-2">Fecha de nacimiento</th>
                                    <th class="text-uppercase text-secondary ps-2 ">Teléfono</th>
                                    <th class="text-uppercase text-secondary ps-2 ">DNI</th>
                                    <th class="text-uppercase text-secondary ps-2 ">Activo</th>
                                    <th class="text-secondary opacity-7"></th>
                                </tr>
                            </thead>

                            <tbody>

                                @forelse ($section_students as $student)
                                <tr>
                                    <td class="align-middle text-center text-sm">
                                        {{$student->id}}
                                    </td>
                                    <td class="align-middle text-uppercase text-sm">
                                        {{$student->name}} {{$student->lastname}}
                                    </td>
                                    <td class="align-middle text-uppercase text-sm">
                                        {{$student->bithdate}}
                                    </td>
                                    <td class="align-middle text-uppercase text-sm">
                                        {{$student->phone_number}}
                                    </td>
                                    <td class="align-middle text-uppercase text-sm">
                                        {{$student->dni}}
                                    </td>

                                    <td>
                                        @if ($student->pivot->status == 1)
                                            <span class="student-section-icon active"></span>
                                        @else
                                            <span class="student-section-icon inactive"></span>
                                        @endif
                                    </td>

                                    <td class="text-uppercase text-sm w-15 pe-4">

                                        <button type="submit" class="btn btn-primary ms-3 me-3" data-bs-toggle="modal"
                                            data-bs-target="#SectionUpdateStudentModal" data-url='{{route('sections.updateStudent', [$section, $student])}}'
                                            data-send="{{route('sections.getStudentUpdateAjax', [$section, $student])}}">
                                            <i class="fa-solid fa-pencil fa-xl"></i> &nbsp; Editar
                                        </button>

                                        <form class="alertDelete" method="POST" action="{{route('sections.studentDetached', [$section, $student])}}" accept-charset="UTF-8"
                                            style="display:inline">
                                            @method('DELETE')
                                            @csrf
                                            <button type="submit" class="btn btn-danger ms-3" title="Delete Student"><i
                                                    class="fa fa-trash-o fa-xl" aria-hidden="true"></i> &nbsp;
                                                Eliminar</button>
                                        </form>
                                    </td>

                                <tr>
                                @empty

                                <tr class="empty-table-message">
                                    <td colspan="6">No hay alumnos registrados en esta sección</td>
                                </tr>

                                @endforelse



                            </tbody>

                        </table>
                    </div>
                </div>


                <div class="table-title text-center">
                    <h4>
                        Materias
                    </h4> 
                </div>

                


                <div class="card-body px-0 pb-2">
                    
                    <div class="table-responsive subjects p-0">

                        @if ($section_subjects->isNotEmpty())
                        <center>
                            <a href="{{route('sections.schedules.index', $section)}}" class="btn btn-success">
                                <i class="fa-regular fa-clock fa-xl"></i> &nbsp; Ingresar a los horarios
                            </a>
                        </center>
                        @endif

                        <table class="table mb-0">
                            <thead>
                                <tr>
                                    <th class="text-center opacity-7">#COD</th>
                                    <th class="text-uppercase text-secondary ps-2">Descripción</th>
                                    <th class="text-uppercase text-secondary ps-2">Profesor</th>
                                    <th class="text-secondary opacity-7"></th>
                                </tr>
                            </thead>

                            <tbody>
                                @forelse ($section_subjects as $subject)
                                <tr>
                                    <td class="align-middle text-center text-sm">
                                        {{$subject->id}}
                                    </td>
                                    <td class="align-middle text-uppercase text-sm">
                                        {{$subject->subject_name}}
                                    </td>

                                    <td class="align-middle text-uppercase text-sm">
                                        @php
                                            $teacher = getTeacherFromSubject($subject);
                                        @endphp
                                        @if ($teacher != null)
                                            {{$teacher->name}} {{$teacher->lastname}}
                                        @else
                                            - -
                                        @endif

                                    </td>

                                    <td class="text-uppercase text-sm w-15 pe-4">

                                        <button type="submit" class="btn btn-primary ms-3 me-3" data-bs-toggle="modal"
                                            data-bs-target="#SectionUpdateSubjectModal" data-url='{{route('sections.updateSubject', [$section, $subject])}}'
                                            data-send="{{route('sections.getSubjectUpdateAjax', [$section, $subject])}}">
                                            <i class="fa-solid fa-chalkboard-user fa-xl"></i> &nbsp; Seleccionar profesor
                                        </button>

                                        <form class="alertDelete" method="POST" action="{{route('sections.deleteSubject', [$section, $subject])}}" accept-charset="UTF-8"
                                            style="display:inline">
                                            @method('DELETE')
                                            @csrf
                                            <button type="submit" class="btn btn-danger ms-3" title="Delete Student"><i
                                                    class="fa fa-trash-o fa-xl" aria-hidden="true"></i> &nbsp;
                                                Eliminar
                                            </button>
                                        </form>
                                    </td>

                                <tr>


                                @empty
                                <tr class="empty-table-message">
                                    <td colspan="3">No hay materias registradas en esta sección</td>
                                </tr>
                                @endforelse
                                

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


<div class="modal fade" id="ModRegSecStudent" tabindex="-1" aria-labelledby="ModRegSecStudent" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-gradient-primary">
                <h5 class="modal-title text-white">Registrar Alumno</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <form role="form" class="text-start" method="POST" action="{{route('sections.registerStudent', $section)}}">
                @csrf

                <div class="modal-body">
                    <div class="input-group input-group-outline mt-2 mb-4">
                        <div class="col-12">
                            <div class="input-group input-group-outline me-2">

                                <select class="form-select" name="id_student_section" id="" required>
                                    <option value="" selected disabled> Selecciona un Alumno </option>
                                    @foreach ($students as $student)
                                        <option value="{{$student->id}}"> {{$student->dni}} | {{$student->name}} {{$student->lastname}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="form-check form-switch d-flex align-items-center mb-3">
                        <input name="student_active" class="form-check-input" type="checkbox" id="activeSectionStudent">
                        <label class="form-check-label mt-1 mb-0 ms-3" for="activeSectionStudent"> Estudiante activo </label>
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


<div class="modal fade" id="SectionUpdateStudentModal" tabindex="-1" aria-labelledby="SectionUpdateStudentModal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-gradient-primary">
                <h5 class="modal-title text-white">Editar estudiante</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form role="form" id='SectionStudentUpdate-form' class="text-start alertEdits" method="POST" action="">
                @method("PATCH")
                @csrf
                <div class="modal-body">
                    <div class="input-group input-group-outline mt-2 mb-4">
                        <div class="col-12">
                            <div class="input-group input-group-outline me-2">
                                <div class="input-group input-group-outline mb-3 focused is-focused w-100">
                                    <input type="text" disabled class="form-control student_name" name="student_name" value="">
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="form-check form-switch d-flex align-items-center mb-3">
                        <input name="student_active" class="form-check-input activeSectionStudent" type="checkbox" id="activeSectionStudent">
                        <label class="form-check-label mt-1 mb-0 ms-3" for="activeSectionStudent"> Estudiante activo </label>
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



<div class="modal fade" id="ModRegSecSubject" tabindex="-1" aria-labelledby="ModRegSecSubject" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-gradient-primary">
                <h5 class="modal-title text-white">Registrar Materia</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <form role="form" class="text-start" method="POST" action="{{route('sections.registerSubject', $section)}}">
                @csrf

                <div class="modal-body">
                    <div class="input-group input-group-outline mt-2 mb-4">
                        <div class="col-12">
                            <div class="input-group input-group-outline me-2">

                                <select class="form-select" name="id_subject_section" id="" required>
                                    <option value="" selected disabled> Selecciona una materia </option>
                                        @foreach ($subjects as $subject)
                                        <option value="{{$subject->id}}"> {{$subject->subject_name}} </option>
                                        @endforeach
                                </select>
                            </div>
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


<div class="modal fade" id="SectionUpdateSubjectModal" tabindex="-1" aria-labelledby="SectionUpdateSubjectModal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-gradient-primary">
                <h5 class="modal-title text-white">Seleccionar Profesor</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form role="form" id='SectionSubjectUpdate-form' class="text-start alertEdits" method="POST" action="">
                @method("PATCH")
                @csrf
                <div class="modal-body">
                    <div class="input-group input-group-outline mt-2 mb-4">
                        <div class="col-12">
                            <div class="input-group input-group-outline me-2">
                                <div class="input-group input-group-outline mb-3 focused is-focused w-100">
                                    <select class="form-select select-teachers-subject" name="id_teacher_section" 
                                            id="select-teachers-subject" required>
                                        <option value="" selected disabled> Selecciona un profesor </option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary mx-2" data-bs-dismiss="modal">Cerrar</button>
                    <button type="submit" value="Confirmar" id="btn-submit-updateSubjectSection" class="btn btn-primary">
                    Confirmar
                </button>
                </div>
            </form>
        </div>
    </div>
</div>


@endsection