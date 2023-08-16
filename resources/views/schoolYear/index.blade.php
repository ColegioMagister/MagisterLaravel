@extends('layouts.masterpage')

@section('content')

<div class="container-fluid py-4">
<div class="row">
<div class="col-12">
<div class="card my-4">
    <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
        <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
            <h6 class="text-white text-capitalize ps-3">Años Escolares</h6>
        </div>
        <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#ModRegAño">
            <i class="fa-solid fa-plus"></i> &nbsp; Registrar
        </button>
    </div>

    <div class="card-body px-0 pb-2">
        <div class="table-responsive p-0">
            <table class="table align-items-center mb-0">
                <thead>
                    <tr>
                        <th class="text-center opacity-7">ID</th>
                        <th class="text-uppercase text-secondary ps-2">Codigo de Periodo</th>
                        <th class="text-uppercase text-secondary ps-2">Fecha de Inicio</th>
                        <th class="text-uppercase text-secondary ps-2 ">Fecha De Finalizacion</th>
                        <th class="text-uppercase text-secondary ps-2 ">Estado</th>
                        <th colspan=2 class="text-secondary opacity-7">Acciones
                    </tr>
                </thead>
                <tbody>

                    @foreach($school_periods as $school_period)
                    <tr>
                        <td class="align-middle text-center text-sm">{{ $loop->iteration }}</td>
                        <td class="align-middle text-uppercase text-sm">
                            {{$school_period->period_name}}
                        </td>
                        <td class="align-middle text-uppercase text-sm">
                            {{$school_period->start_date}}
                        </td>
                        <td class="align-middle text-uppercase text-sm ">{{ $school_period->end_date }}</td>
                        
                        <td>
                            <span class="badge {{ $school_period->status ? 'bg-success' : 'bg-danger' }}">
                                        {{ $school_period->status ? '' : '' }}
                            </span>
                        </td>
                        
                        <td class="align-middle text-uppercase text-sm">
                            <a href="{{route('schoolYear.show',$school_period->id)}}" class="btn btn-success"><i class="fa-solid fa-eye fa-xl"></i>Ver</a>


                            <button type="submit" class="btn btn-primary" data-bs-toggle="modal"
                                data-bs-target="#EditarAñoEs" data-url='{{url('SchoolYear/'.$school_period->id)}}'
                                    data-send="{{route('school_periods.ajax.edit', $school_period)}}" enctype="multipart/form-data">
                                <i class="fa-solid fa-plus"></i> Editar
                            </button>



                            
                            <form class="alertDelete" method="POST"
                                action="{{ url('/SchoolYear' . '/' . $school_period->id) }}" accept-charset="UTF-8"
                                style="display:inline">
                                @method('DELETE')
                                @csrf
                                <button type="submit" class="btn btn-danger""
                                    title="Delete SchoolYear"><i class="fa fa-trash-o"
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

<div class="modal fade" id="ModRegAño" tabindex="-1" aria-labelledby="ModRegAño" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-gradient-primary">
                <h5 class="modal-title text-white">Registrar Año Escolar</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <!-- #para que cargue  -->
            <form role="form" class="text-start" method="POST" action="{{ url('SchoolYear') }}"
                enctype="multipart/form-data">
                {!! csrf_field() !!}
                <div class="modal-body">
                    <div class="input-group input-group-outline mt-2 mb-4">
                        <div class="col-6">
                            <div class="input-group input-group-outline me-2 focused is-focused">
                                <select class="form-control" name="period_name" required>
                                    <option selected disabled>Codigo de Periodo</option>
                                    <option value="2023-I">2023-I</option>
                                    <option value="2023-II">2023-II</option>
                                    <option value="2023-III">2023-III</option>
                                    <option value="2023-IV">2023-IV</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-6">
                        <div class="input-group input-group-outline me-2">
                                <label class="form-label ">Fecha de Inicio</label>
                                <input type="date" class="form-control" name="start_date" required>
                            </div>
                        </div>
                    </div>
                    <div class="input-group input-group-outline mt-2 mb-4">
                        <div class="col-6">
                            <div class="input-group input-group-outline me-2">
                                <label class="form-label ">Fecha de Finalizacion </label>
                                <input type="date" class="form-control" name="end_date" required>
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="input-group input-group-outline me-2 focused is-focused">
                                <select class="form-control" name="status" required>
                                    <option selected disabled>Estado</option>
                                    <option value="1">Activo</option>
                                    <option value="0">Inactivo</option>
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




<!---------------- #MODAL EDITAR-------------------------  -->


<div class="modal fade" id="EditarAñoEs" tabindex="-1" aria-labelledby="EditarAñoEs" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-gradient-primary">
                <h5 class="modal-title text-white">Editar Año Escolar</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form role="form" id='edit-school_period-form' class="text-start alertEdits" method="POST" action="" enctype="multipart/form-data">
                @method("PATCH")
                @csrf
                <div class="modal-body">
                    <div class="input-group input-group-outline mt-2 mb-4">
                        <div class="col-6">
                            <div class="input-group input-group-outline me-2 focused is-focused">
                                <select class="form-control"  name="id" >
                                    <option class="period_select" selected disabled value="" >Codigo de Periodo</option>
                                    @foreach ($school_periods as $school_period)
                                    <option value="{{$school_period->id}}">{{$school_period->period_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-6">
                        <div class="input-group input-group-outline me-2">
                                <label class="form-label ">Fecha de Inicio</label>
                                <input type="date" class="form-control start_date" name="start_date" >
                            </div>
                        </div>
                    </div>
                    <div class="input-group input-group-outline mt-2 mb-4">
                        <div class="col-6">
                            <div class="input-group input-group-outline me-2">
                                <label class="form-label ">Fecha de Finalizacion </label>
                                <input type="date" class="form-control end_date" name="end_date" >
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="input-group input-group-outline me-2 focused is-focused">
                                <select class="form-control status" name="status" >
                                    <option selected disabled>Estado</option>
                                    <option value="1">Activo</option>
                                    <option value="0">Inactivo</option>
                                </select>
                            </div>
                        </div>
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