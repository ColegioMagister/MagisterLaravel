@extends('layouts.masterpage')

@section('content')

<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="card my-4">
                <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                    <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                        <h6 class="text-white text-capitalize ps-3">Evaluaciones</h6>
                    </div>
                    <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#AssessmentRegisterModal">
                        <i class="fa-solid fa-plus"></i> &nbsp; Ingresar
                    </button>
                </div>

                <div class="card-body px-0 pb-2">
                    <div class="table-responsive p-0">
                        <table class="table align-items-center mb-0">
                            <thead>
                                <tr>
                                    <th class="text-center opacity-7">#ID</th>
                                    <th class="text-uppercase text-secondary ps-2 ">TIPO DE EVALUACIÓN</th>
                                    <th class="text-uppercase text-secondary ps-2">VALOR</th>
                                    <th class="text-uppercase text-secondary ps-2">CREADO EL</th>
                                    <th class="text-uppercase text-secondary ps-2">ACUALIZADO EL</th>
                                    <th class="text-secondary text-center opacity-7"> ACCIÓN </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($assessments as $assessment)
                                <tr>
                                    <td class="align-middle text-center text-sm">{{$assessment->id}}</td>
                                    <td class="align-middle text-uppercase text-sm">
                                        {{$assessment->assessment_name}}
                                    </td>
                                    <td class="align-middle text-uppercase text-sm">
                                        {{floor($assessment->value)}} % 
                                    </td>
                                    <td class="align-middle text-uppercase text-sm">
                                        {{$assessment->created_at}}
                                    </td>
                                    <td class="align-middle text-uppercase text-sm">
                                        {{$assessment->updated_at}}
                                    </td>

                                    <td class="text-uppercase text-sm w-15 pe-4">
                                        <button type="submit" class="btn btn-primary ms-3 me-3 assessmentBtnEdit" data-bs-toggle="modal"
                                            data-bs-target="#AssessmentEditModal" 
                                            data-url="{{route('assessment.update', $assessment)}}"
                                            data-send="{{route('assessment.getEditAjaxData', $assessment)}}">
                                            <i class="fa-solid fa-pencil fa-xl"></i> &nbsp; Editar
                                        </button>

                                        <form class="alertDelete" method="POST"
                                            action="{{route('assessment.destroy', $assessment)}}" accept-charset="UTF-8"
                                            style="display:inline">
                                            @method('DELETE')
                                            @csrf
                                            <button type="submit" class="btn btn-danger ms-3" title="Delete assessment"><i
                                                    class="fa fa-trash-o fa-xl" aria-hidden="true"></i> &nbsp;
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

<div class="modal fade" id="AssessmentRegisterModal" tabindex="-1" aria-labelledby="AssessmentUpdateModal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-gradient-primary">
                <h5 class="modal-title text-white">Registrar Tipo de Evaluación</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <!-- #para que cargue  -->
            <form role="form" class="text-start" method="POST" action="{{route('assessment.store')}}">
                @csrf

                <div class="modal-body">

                    <div class="input-group input-group-outline mb-3 focused is-focused">
                        <label class="form-label">Tipo de evaluación</label>
                        <input type="text" class="form-control" name="assessment_name" required>
                    </div>

                    <div class="input-number">
                        <label>Valor (%) (1-100): </label>
                        <input class="d-block" type="number" min="1" max="100" step="0.1" name="assessment_value" required>
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



<div class="modal fade" id="AssessmentEditModal" tabindex="-1" aria-labelledby="AssessmentEditModal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-gradient-primary">
                <h5 class="modal-title text-white">Editar tipo de evaluación</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <!-- #para que cargue  -->
            <form id="editAssessmentForm" role="form" class="text-start alertEdits" method="POST" action="">
                @method('PATCH')
                @csrf
                <div class="modal-body">
                    <div class="input-group input-group-outline mb-3 focused is-focused">
                        <label class="form-label">Tipo de evaluación</label>
                        <input type="text" class="form-control name" name="assessment_name" required>
                    </div>

                    <div class="input-number">
                        <label>Valor (%) (1-100): </label>
                        <input class="d-block value" type="number" min="1" max="100" step="1" name="assessment_value" required>
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