@extends('layouts.masterpage')
@section('content')
<div class="container-fluid py-4">
<div class="row">
<div class="col-12">
<div class="card my-4">
                <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                    <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                        <h6 class="text-white text-capitalize ps-3">Cursos a cargo - {{$teachers->name}}:{{$teachers->lastname}}</h6>
                    </div>
                </div>
                <div>
                    <a href="{{ route('teacher.index')}}" type="button" class="btn btn-primary">
                        <i class="fa-solid fa-chevron-left"></i> &nbsp; Volver
                    </a>
                </div>
    <div class="card-body px-0 pb-2">
    <div class="table-responsive p-0">
        <table class="table align-items-center mb-0">
            <thead>
                <tr>
                <th class="text-center opacity-7">ID</th>
                <th class="text-uppercase text-secondary ps-2">Curso</th>
                <th colspan=2 class="text-secondary opacity-7"></th>
                </tr>
            </thead>
            <tbody>
                @forelse ($subjects as $subject)
                <tr>
                    <td class="align-middle text-center text-sm">{{ $loop->iteration }}</td>
                        <td class="align-middle text-uppercase text-sm ">{{ $subject->subject_name }}</td>
                        <td>
                            <form class="alertDelete" method="POST" action="{{route('teacher.deleteSubject', [$teachers, $subject])}}" accept-charset="UTF-8"
                                style="display:inline">
                                @method('DELETE')
                                @csrf
                                <button type="submit" class="btn btn-danger ms-2" title="Delete Student"><i
                                    class="fa fa-trash-o fa-xl" aria-hidden="true"></i> &nbsp;
                                Eliminar
                                </button>
                            </form>
                        </td>
                                    
                    @empty
                <p>No hay materias asignadas a este profresor</p>
                </tr>    
                @endforelse
            </tbody>
        </table>
    </div>
    </div>
</div>
</div>
</div>
</div>

@endsection
