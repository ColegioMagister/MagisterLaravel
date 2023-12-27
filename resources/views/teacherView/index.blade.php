@extends('layouts.masterpage')

@section('content')
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card my-4">
                    <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2 mb-5">
                        <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                            <h6 class="text-white text-capitalize ps-3">Secciones</h6>
                        </div>
                    </div>
                    <div class="container">
                        <div class="card-body px-0 pb-2">
                            <div class="periods-container">
                                @forelse ($school_periods as $school_period)
                                    <div class="period-box">
                                        <div class="period-title-box">
                                            <div class="extra-title">
                                                Periodo Académico:
                                            </div>
                                            <div class="title">
                                                {{ $school_period->period_name }}
                                            </div>
                                        </div>
                                        <div class="period-dates">
                                            <div class="period-start-date">
                                                <div class="extra-date-txt">
                                                    Fecha de inicio:
                                                </div>
                                                <div class="date">
                                                    {{ $school_period->start_date }}
                                                </div>
                                            </div>
                                            <div class="period-end-date">
                                                <div class="extra-date-txt">
                                                    Fecha de finalización:
                                                </div>
                                                <div class="date">
                                                    {{ $school_period->end_date }}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="period-btn-enter-box">
                                            <a href="{{ route('teacherView.section', $school_period) }}"
                                                class=" btn bg-gradient-danger btn-lg btn-rounded w-100 mt-4 mb-0">
                                                <i class="fa-solid fa-plus"></i> Entrar
                                            </a>
                                        </div>

                                    </div>

                                @empty
                                    <div class="empty-table-message">
                                        <h4 class="text-black-50">
                                            Aquí aparecerán los periodos escolares registrados
                                        </h4>

                                    </div>
                                @endforelse
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
