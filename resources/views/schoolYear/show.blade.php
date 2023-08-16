@extends('layouts.masterpage')

@section('content')



<div class="container-fluid py-4">
<div class="row">
<div class="col-12">
<div class="card my-4">
    <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
        <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
            <h6 class="text-white text-capitalize ps-3">Ver Año Escolar / {{$school_period->period_name}}</h6>
        </div>
        
        <a href="{{route('schoolYear.index')}}" class="btn btn-danger"><i class="fa-solid fa-plus"></i>Atras</a>

        <div class="container">
        <div class="row">
            <div class="col-md-3">
                <p class="text-dark">Total de Secciones Registradas:{{ $sectionCount }}</p>
            </div>

            <div class="col-md-3">
                <p class="text-end text-dark">Estado:
                     <span class="badge {{ $school_period->status ? 'bg-success' : 'bg-danger' }}">
                                        {{ $school_period->status ? 'Activo' : 'Inactivo' }}
                            </span></p>
            </div>

            <div class="col-md-3">
                <p class="text-end text-dark">Fecha de Inicio: {{$school_period->start_date}}</p>
            </div>
            <div class="col-md-3 ">
                <p class="text-end text-dark">Finaliza el: {{$school_period->end_date}}</p>
            </div>
        </div>
        <div class="border border-3d-vertical border-info"></div>
    </div>
        
    </div>

    <div class="card-body px-0 pb-2">
        <div class="table-responsive p-0">
            <table class="table align-items-center mb-0">
                <thead>
                    <tr>
                        <th class="text-center opacity-7">ID</th>
                        <th class="text-uppercase text-secondary ps-2">NIVEL</th>
                        <th class="text-uppercase text-secondary ps-2">TIPO DE SECCIÓN</th>
                        <th class="text-uppercase text-secondary ps-2 ">DENOMINACIÓN</th>
                        <th colspan=2 class="text-uppercase ps-2"></th>
                    </tr>
                </thead>
                <tbody>

                  @foreach ($sections as $section)
              
                    <tr>
                        <td class="align-middle text-center text-sm">{{$loop->iteration}}</td>
                        <td class="align-middle text-uppercase text-sm">
                            <p>{{$section->level->description}}</p>

                        </td>
                        <td class="align-middle text-uppercase text-sm">
                            <p>{{$section->section_type->section_type}}</p>
                        </td>
                        <td class="align-middle text-uppercase text-sm "><p>{{$section->section_name}}</p></td>
                        
                        <td>
                                        
                            </span>
                        </td>
                        
                        <td class="align-middle text-uppercase text-sm">

                            <a href="{{route('schoolYear.studentShow',$section->id)}}" class="btn btn-success"><i class="fa-solid fa-eye fa-xl"></i>Alumnos</a>


                            
                            @endforeach 


                            
                            
                        </td>

                        

                    <tr>
                    
                </tbody>

            </table>
        </div>
    </div>




</div>
</div>
</div>
</div>
@endsection