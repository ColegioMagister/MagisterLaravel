@extends('layouts.masterpage')
@section('content')


<div class="container-fluid py-4">
<div class="row">
<div class="col-12">
<div class="card my-4">
    <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2 mb-5">
        <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
            <h6 class="text-white text-capitalize ps-3">Periodo {{$section->school_period->period_name}}:
                {{$subject->subject_name}}: Evaluaciones</h4>
            </h6>
        </div>
    </div>
    <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2 mb-5">
        <span class="mb-2 text-xl">Grado:
            <span class="text-dark font-weight-bold ms-sm-2">{{$section->section_type->section_type}}</span>
        </span>
        <span class="mb-2 text-xl">Seccion:
            <span class="text-dark font-weight-bold ms-sm-2">{{$section->section_name}}</span>
        </span>
        <span class="mb-2 text-xl">Nivel:
            <span class="text-dark font-weight-bold ms-sm-2">{{$section->level->description}}</span>
        </span>
    </div>
    
    <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
        <a href="{{ route('teacherView.assessmentAttendaces', ['section' => $section->id, 'subject' => $subject->id]) }}}" type="button" class="btn btn-primary">
            <i class="fa-solid fa-chevron-left"></i> &nbsp; Volver
        </a>
            <button type="button" class="btn btn-success" data-bs-toggle="modal"
            data-bs-target="#ModRegistroNota">
            <i class="fa-solid fa-plus text-uppercase"></i>&nbsp;Ingresar Nota
            </button>
    </div>

    <div class="card-body px-0 pb-2">  
        <div class="table-responsive p-0">
            @if ($assessments->isEmpty())
            <p>No hay Evaluaciones disponibles para esta Curso.</p>
            @else 
            @foreach ($assessments  as $assessment)
            <div class="table-title text-center">
                <h2 class="text-uppercase">{{$assessment->assessmentType->assessment_name}}</h2>
                <h5>{{$assessment->date}}- valor (%{{$assessment->assessmentType->value}})</h5>
            </div>
            <table class="table align-items-center mb-0">
                <thead>
                    <tr>
                        <th class="text-center opacity-7">ID</th>
                        <th class="text-uppercase text-center ">Nombre</th>
                        <th class="text-uppercase text-center ">Apellido</th>
                        <th class="text-uppercase text-center  ">DNI</th>
                        <th class="text-uppercase text-center  ">Nota</th>
                        <th class="text-uppercase text-secondary ps-2">Estado</th>
                        <th class="text-secondary opacity-7"></th>
                    </tr>
                </thead>
                <tbody>
                    @if ($students_Assessments->isEmpty())
                    <p>No hay Notas Registras</p>
                    @else
                    @foreach ($students_Assessments as $student)
                        @if ($student->assessment->assessmentType->id === $assessment->assessmentType->id)
                            <tr>
                                    <td class="align-middle text-center text-sm">{{$student->student->id}}</td>
                                    <td class="align-middle text-uppercase text-center text-sm">{{ $student->student->name }}</td>
                                    <td class="align-middle text-center text-uppercase text-sm">{{ $student->student->lastname }}</td>
                                    <td class="align-middle text-center text-uppercase text-sm">{{ $student->student->dni }}</td>
                                    <td class="align-middle text-center  text-sm">{{$student->grade}}</td>
                                    <td>
                                    @if ($student->status == 1)
                                        <span class="student-section-icon active"></span>
                                    @else
                                        <span class="student-section-icon inactive"></span>
                                    @endif
                                    </td>
                                    <td class="align-middle text-center text-sm">
                                        <button type="submit" class="btn btn-primary ms-3 me-3" data-bs-toggle="modal"
                                            data-bs-target="#AssesstUpdateStudentModal"
                                            data-url="{{ route('teacherView.updateStudentNota', ['student' => $student->student->id, 'assessment' => $assessment->id]) }}"
                                            data-send="{{ route('teacherView.AjaxUpdateStudentNota', ['student' => $student->student->id, 'assessment' => $assessment->id]) }}">
                                            <i class="fa-solid fa-pencil fa-xl"></i> &nbsp; Editar
                                        </button>
                                    </td>
                                </tr>
                        @endif
                    @endforeach
                    @endif  
                </tbody>
            </table>
            @endforeach
            @endif
    </div>
</div>
</div>
</div>
</div>

@endsection


@section('modals')




<div class="modal fade" id="ModRegistroNota" tabindex="-1" aria-labelledby="ModRegistroNota" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-gradient-primary">
                <h5 class="modal-title text-white">Ingresar Nota</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" action="{{ route('teacherView.registerNota') }}">
                @csrf
                <div class="modal-body">
                    <div class="input-group input-group-outline mt-2 mb-4">
                        <div class="col-12">
                            <div class="input-group input-group-outline me-2">
                                <select class="form-select" name="id_assessment" required>
                                    <option value="" selected disabled> Evaluacion </option>
                                    @foreach ($assessments as $assessment)
                                        <option class="text-uppercase" value="{{ $assessment->id }}">{{$assessment->assessmentType->assessment_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="input-group input-group-outline mt-2 mb-4">
                        <div class="col-12">
                            <div class="input-group input-group-outline me-2">
                                <select class="form-select" name="id_student" required>
                                    <option value="" selected disabled> Selecciona un Alumno </option>
                                    @foreach ($studentInSections as $student)
                                        <option class="text-uppercase" value="{{ $student->id }}">{{ $student->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="input-group input-group-outline mt-2 mb-4">
                        <div class="col-12">
                            <div class="input-group input-group-outline me-2">
                                <label class="form-label">Nota</label>
                                <input type="number" class="form-control" @error('grade') is-invalid @enderror name="grade" required>
                                @error('grade')
									<span class="invalid-feedback" role="alert">
										<strong>{{ $message }}</strong>
									</span>
								@enderror
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




<div class="modal fade" id="AssesstUpdateStudentModal" tabindex="-1" aria-labelledby="AssesstUpdateStudentModal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-gradient-primary">
                <h5 class="modal-title text-white">Editar Nota</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form role="form" id='AssesstUpdateStudentModal-form' class="text-start alertEdits" method="POST" action="">
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