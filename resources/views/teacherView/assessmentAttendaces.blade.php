@extends('layouts.masterpage')
@section('content')


<div class="container-fluid py-4">
<div class="row">
<div class="col-12">
<div class="card my-4">
    <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2 mb-5">
        <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
            <h6 class="text-white text-capitalize ps-3">Periodo {{$section->school_period->period_name}}:
                {{$subject->subject_name}}</h4>
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
        <a href="{{ route('teacherView.subject', $section)}}" type="button" class="btn btn-primary">
            <i class="fa-solid fa-chevron-left"></i> &nbsp; Volver
        </a>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-xl-3 col-md-6  mb-5 col-sm-4">
                <div class="card card-blog card-plain">
                    <div class="card-body p-3 d-flex flex-column">
                        <div class="text-center">
                            <h4 class="text-uppercase">Evaluaciones</h4>
                        </div>
                        <div class="text-center">
                            <a href="{{ route('teacherView.assessment', ['section' => $section->id, 'subject' => $subject->id]) }}" class="btn bg-gradient-danger btn-lg btn-rounded w-100 mt-4 mb-0">
                                <i class="fa-solid fa-plus"></i> Entrar
                            </a> 
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6  mb-5 col-sm-4">
                <div class="card card-blog card-plain">
                    <div class="card-body p-3 d-flex flex-column">
                        <div class="text-center">
                            <h4 class="text-uppercase">Asistencia</h4>
                        </div>
                        <div class="text-center">
                            <button type="button"  class="btn bg-gradient-danger btn-lg btn-rounded w-100 mt-4 mb-0" data-bs-toggle="modal" data-bs-target="#modalSelectSchedule">
                                Seleccionar Horario
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
</div>
</div>

@endsection

@section('modals')



<div class="modal fade" id="modalSelectSchedule" tabindex="-1" aria-labelledby="modalSelectScheduleLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalSelectScheduleLabel">Seleccionar Horario</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <ul class="list-group">
                
                    @forelse ($schedules as $schedule)

                    <li class="list-group-item">
                        <a href="{{ route('teacherView.attedance', ['section' => $section->id, 'subject' => $subject->id, 'schedule' => $schedule->id]) }}">
                            Horario: {{ $schedule->start_datetime }} - {{ $schedule->end_datetime }} | Día: {{ $schedule->weekday->day_name }}
                        </a>
                    </li>
                    @empty
                    <p>No hay horario para esta Curso</p>
                @endforelse
                </ul>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>
@endsection
