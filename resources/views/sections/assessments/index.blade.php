@extends('layouts.masterpage')

@section('content')
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card my-4">
                    <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                        <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                            <h6 class="text-white text-capitalize ps-3">
                                Sección {{ $section->school_period->period_name }}
                                {{ $section->level->description }}
                                {{ $section->section_type->section_type }}
                                {{ $section->section_name }}:
                                Curso: {{ strtoupper($subject->subject_name) }}
                            </h6>

                        </div>

                        <a class="btn btn-primary" href="{{ route('sections.show', $section) }}">
                            <i class="fa-solid fa-chevron-left"></i> &nbsp;
                            Volver a la sección
                        </a>
                        <br>
                        <button type="button" class="btn btn-success" data-bs-toggle="modal"
                            data-bs-target="#AssessmentSectionRegisterModal">
                            <i class="fa-solid fa-plus"></i> &nbsp; Ingresar
                        </button>
                    </div>

                    <div class="card-body px-0 pb-2">
                        <div class="table-responsive p-0">
                            <table class="table align-items-center mb-0">
                                <thead>
                                    <tr>
                                        <th class="text-center opacity-7">#ID</th>
                                        <th class="text-uppercase text-secondary ps-2">TIPO DE EVALUACIÓN</th>
                                        <th class="text-uppercase text-secondary ps-2">VALOR</th>
                                        <th class="text-uppercase text-secondary ps-2">FECHA</th>
                                        <th class="text-secondary text-center opacity-7"> ACCIÓN </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($assessments as $assessment)
                                        <tr>
                                            <td class="align-middle text-center text-sm">
                                                {{ $assessment->id }}
                                            </td>
                                            <td class="align-middle text-uppercase text-sm">
                                                {{ $assessment->assessmentType->assessment_name }}
                                            </td>
                                            <td class="align-middle text-uppercase text-sm">
                                                {{ $assessment->assessmentType->value }}
                                            </td>
                                            <td class="align-middle text-uppercase text-sm">
                                                {{ $assessment->date }}
                                            </td>

                                            <td class="text-uppercase text-sm w-15 pe-4">

                                                <form class="alertDelete" method="POST"
                                                    action="{{ route('sections.assessment.destroy', $assessment) }}"
                                                    accept-charset="UTF-8" style="display:inline">
                                                    @method('DELETE')
                                                    @csrf
                                                    <button type="submit" class="btn btn-danger ms-3"
                                                        title="Delete assessment"><i class="fa fa-trash-o fa-xl"
                                                            aria-hidden="true"></i> &nbsp;
                                                        Eliminar
                                                    </button>
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
    <div class="modal fade" id="AssessmentSectionRegisterModal" tabindex="-1"
        aria-labelledby="AssessmentSectionRegisterModal" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-gradient-primary">
                    <h5 class="modal-title text-white"> Registrar Evaluación </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <form role="form" class="text-start" method="POST"
                    action="{{ route('assessmentSection.store', [$section, $subject]) }}">
                    @csrf
                    <div class="modal-body">

                        <label for="assessYearSelect">
                            Tipo de evaluación *
                        </label>

                        <div class="input-group input-group-outline mb-3 focused is-focused">
                            <select class="form-select" id="assessTypeSelect" name='assessType' required>
                                <option value="" disabled selected> Selecciona un tipo de evaluación </option>
                                @foreach ($assessmentsTypes as $type)
                                    <option value="{{ $type->id }}"> {{ $type->assessment_name }} </option>
                                @endforeach
                            </select>
                        </div>

                        <label for="assessYearSelect">
                            Fecha de la evaluación *
                        </label>
                        <div class="input-group input-group-outline mb-3 focused is-focused">
                            <select class="form-select me-1" name="assessYear" id="assessYearSelect"
                                data-send="{{ route('assessmentSection.LoadDate', [$section, $subject]) }}" required>
                                <option value="" disabled selected> Selecciona un año </option>
                                @foreach ($validYears as $year)
                                    <option value="{{ $year }}"> {{ $year }} </option>
                                @endforeach
                            </select>

                            <select class="form-select ms-1 me-1" name="assessMonth" id="assessMonthSelect"
                                data-send="{{ route('assessmentSection.LoadDate', [$section, $subject]) }}" required>
                                <option value="" disabled selected> Selecciona un mes </option>
                            </select>


                            <select class="form-select ms-1" name="assessDay" id="assessDaySelect" required>
                                <option value="" disabled selected> Selecciona un día </option>
                            </select>
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



    <div class="modal fade" id="AssessmentSectionEditModal" tabindex="-1" aria-labelledby="AssessmentSectionEditModal"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-gradient-primary">
                    <h5 class="modal-title text-white">Editar Evaluación</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <!-- #para que cargue  -->
                <form id="editAssessmentForm" role="form" class="text-start alertEdits" method="POST"
                    action="">
                    @method('PATCH')
                    @csrf
                    <div class="modal-body">
                        <div class="input-group input-group-outline mb-3 focused is-focused">
                            <label class="form-label">Tipo de evaluación</label>
                            <input type="text" class="form-control name" name="assessment_name" required>
                        </div>

                        <div class="input-number">
                            <label>Valor (%) (1-100): </label>
                            <input class="d-block value" type="number" min="1" max="100" step="1"
                                name="assessment_value" required>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary mx-2" data-bs-dismiss="modal">Cerrar</button>
                        <input type="submit" value="Guardar" class="btn btn-primary">
                    </div>

                </form>
            </div>
        </div>
    </div>
@endsection
