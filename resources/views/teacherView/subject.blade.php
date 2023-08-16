@extends('layouts.masterpage')
@section('content')


<div class="container-fluid py-4">
<div class="row">
<div class="col-12">
<div class="card my-4">
    <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2 mb-5">
        <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
            <h6 class="align-middle text-white text-capitalize ps-3">Periodo {{$section->school_period->period_name}}:MATERIAS
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
    <a href="{{ route('teacherView.section',$section->school_period->id) }}" type="button" class="btn btn-primary">
        <i class="fa-solid fa-chevron-left"></i> &nbsp; Volver
    </a>
    </div>
    <div class="container">
        <div class="row">
            @if ($subjects->isEmpty())
            <p>No hay Cursos disponibles para esta Seccion.</p>
             @else
            @foreach ($subjects  as $subject)  
            <div class="col-xl-3 col-md-6  mb-5 col-sm-4">
                <div class="card card-blog card-plain">
                    <div class="card-body p-3 d-flex flex-column">
                        <div class="text-center">
                            <h4 class="text-uppercase" >{{$subject->subject_name}}</h4>
                        </div>
                        <div class="text-center">
                            <a href="{{ route('teacherView.assessmentAttendaces', ['section' => $section->id, 'subject' => $subject->id]) }}" class="btn bg-gradient-danger btn-lg btn-rounded w-100 mt-4 mb-0">
                                <i class="fa-solid fa-plus"></i> Entrar
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
            @endif
        </div>
    </div>
</div>
</div>
</div>
</div>


@endsection