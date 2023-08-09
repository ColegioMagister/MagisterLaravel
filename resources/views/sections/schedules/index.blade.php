@extends('layouts.masterpage')

@section('content')

<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="card my-4">
                <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                    <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                        <h6 class="text-white text-capitalize ps-3">Sección tal: horarios</h6>
                    </div>
                </div>

                <div class="schedules-container">
                    <div class="courses-schedule-container">

                        <div class="draggable-events-container">
                            <div class="dgev-container-title">
                                Cursos
                            </div>
                            @foreach ($subjects as $subject)
                            <div class="draggable-event" data-duration='00:30' 
                                data-event='{"title":"{{$subject->subject_name}}","className":"{{$subject->id}}"}'>
                                {{$subject->subject_name}}
                            </div>
                            @endforeach
                        </div>

                        <div id="btn-schedule-save" data-url="{{route('sections.storeSchedules', $section)}}">
                            <a class="btn btn-primary" href="">Guardar</a>
                        </div>
                    </div>
    
                    <div class="card-body px-0 pb-2">
                        <div class="calendar-title">
                            {{$section->school_period->period_name}} 
                            {{$section->level->description}} 
                            {{$section->section_type->section_type}} 
                            {{$section->section_name}}
                        </div>
                        <div id="full-calendar-container">
                        </div>
                    </div>
                </div>

           

            </div>
        </div>
    </div>
</div>


@endsection