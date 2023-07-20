@extends('layouts.masterpage')

@section('content')

<div class="container-fluid py-4">
<div class="row">
<div class="col-12">
<div class="card my-4">
    <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
        <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
            <h6 class="text-white text-capitalize ps-3">Secciones</h6>
        </div>
        <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#ModRegSection">
            <i class="fa-solid fa-plus"></i> &nbsp; Registrar
        </button>
    </div>

    <div class="card-body px-0 pb-2">
        <div class="table-responsive p-0">
            <table class="table align-items-center mb-0">
                <thead>
                    <tr>
                        <th class="text-center opacity-7">ID</th>
                        <th class="text-uppercase text-secondary ps-2">TIPO DE SECCIÓN</th>
                        <th class="text-uppercase text-secondary ps-2">PERIODO</th>
                        <th class="text-uppercase text-secondary ps-2 ">NIVEL</th>
                        <th class="text-uppercase text-secondary ps-2 ">DENOMINACIÓN</th>
                        <th class="text-uppercase text-secondary ps-2">MONTO TOTAL</th>
                        <th colspan=2 class="text-secondary opacity-7"></th>

                    </tr>
                </thead>
                <tbody>

                    @foreach($sections as $section)
                    <tr>
                        <td class="align-middle text-center text-sm">{{ $section->id }}</td>
                        <td class="align-middle text-uppercase text-sm">
                            {{$section->section_type->section_type}}
                        </td>
                        <td class="align-middle text-uppercase text-sm">
                            {{$section->school_period->period_name}}
                        </td>
                        <td class="align-middle text-uppercase text-sm ">{{ $section->level->description }}</td>
                        <td>{{ $section->section_name }}</td>
                        <td>{{ $section->total_amount }}</td>

                        <td class="align-middle text-uppercase text-sm">
                            <button type="submit" class="btn btn-primary" data-bs-toggle="modal"
                                data-bs-target="#SectionUpdateModal" data-url='{{route('sections.update', $section)}}'
                                 data-send="{{route('sections.getUpdateAjax', $section)}}">
                                <i class="fa-solid fa-plus"></i> Editar
                            </button>
                              
                            <form class="alertDelete" method="POST"
                                action="{{route('sections.destroy', $section)}}" accept-charset="UTF-8"
                                style="display:inline">
                                @method('DELETE')
                                @csrf
                                <button type="submit" class="btn btn-primary"
                                    title="Delete Student"><i class="fa fa-trash-o"
                                        aria-hidden="true"></i>Eliminar</button>
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



<!------------- #MODAL REGISTRAR-------------------------  -->



<div class="modal fade" id="ModRegSection" tabindex="-1" aria-labelledby="ModRegSection" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-gradient-primary">
                <h5 class="modal-title text-white">Registrar Sección</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <!-- #para que cargue  -->
            <form role="form" class="text-start" method="POST" action="{{route('sections.store')}}">
                @csrf

                <div class="modal-body">
                    <div class="input-group input-group-outline mt-2 mb-4">
                        <div class="col-6">
                            <div class="input-group input-group-outline me-2">

                                <select class="form-select" name="id_period" id="">
                                    <option value="" selected disabled> Selecciona un Período escolar </option>
                                    @foreach ($school_periods as $school_period)
                                        <option value="{{$school_period->id}}"> {{$school_period->period_name}} </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="input-group input-group-outline me-2">

                                <select class="form-select" name="id_level" id="">
                                    <option value="" selected disabled> Selecciona un Nivel escolar </option>
                                    @foreach ($levels as $level)
                                        <option value="{{$level->id}}"> {{$level->description}} </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="input-group input-group-outline mt-2 mb-4">
                        <div class="col-12">
                            <div class="input-group input-group-outline me-2">

                                <select class="form-select" name="id_sectiontype" id="">
                                    <option value="" selected disabled> Selecciona el Grado </option>
                                    @foreach ($section_type as $type)
                                        <option value="{{$type->id}}"> {{$type->section_type}} </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="input-group input-group-outline mb-3">
                        <label class="form-label">Nombre de la sección</label>
                        <input type="text" class="form-control" name="section_name" required>
                    </div>

                    <div class="input-group input-group-outline mb-3">
                        <label class="form-label">Monto total</label>
                        <input type="number" step="0.1" class="form-control" name="total_amount" required>
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



<!---------------- #MODAL EDITAR-------------------------  -->


<div class="modal fade" id="SectionUpdateModal" tabindex="-1" aria-labelledby="SectionUpdateModal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-gradient-primary">
                <h5 class="modal-title text-white">Editar Sección</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form role="form" id='SectionUpdate-form' class="text-start alertEdits" method="POST" action="">
                @method("PATCH")
                @csrf

                <div class="modal-body">
                    <div class="input-group input-group-outline mt-2 mb-4">
                        <div class="col-6">
                            <div class="input-group input-group-outline me-2">

                                <select class="form-select" name="id_period" id="">
                                    <option class="period_select" value="" selected>  </option>
                                    @foreach ($school_periods as $school_period)
                                        <option value="{{$school_period->id}}"> {{$school_period->period_name}} </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="input-group input-group-outline me-2">

                                <select class="form-select" name="id_level" id="">
                                    <option class="level-select" value="" selected>  </option>
                                    @foreach ($levels as $level)
                                        <option value="{{$level->id}}"> {{$level->description}} </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="input-group input-group-outline mt-2 mb-4">
                        <div class="col-12">
                            <div class="input-group input-group-outline me-2">

                                <select class="form-select" name="id_sectiontype" id="">
                                    <option class="type_select" value="" selected>  </option>
                                    @foreach ($section_type as $type)
                                        <option value="{{$type->id}}"> {{$type->section_type}} </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="input-group input-group-outline mb-3 focused is-focused">
                        <label class="form-label">Nombre de la sección</label>
                        <input type="text" class="form-control section_name" name="section_name" value="" required>
                    </div>

                    <div class="input-group input-group-outline mb-3 focused is-focused">
                        <label class="form-label">Monto total</label>
                        <input type="number" step="0.1" class="form-control total_amount" name="total_amount" value="" required>
                    </div>

                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary mx-2" data-bs-dismiss="modal">Cerrar</button>
                    <button type="submit" value="Actualizar" class="btn btn-primary " data-bs-toggle="modal">
                        <i class="fa-solid fa-plus"></i>Actualizar</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection