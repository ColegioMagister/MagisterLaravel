@extends('layouts.masterpage')

@section('content')



<div class="container-fluid py-4">
<div class="row">
<div class="col-12">
<div class="card my-4">
    <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
        <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
            <h6 class="text-white text-capitalize ps-3">Estudiantes de la Seccion: {{$section->section_type->section_type}}: {{$section->section_name}}  </h6>
        </div>
        <a href="{{ url()->previous() }}" class="btn btn-danger">Atrás</a>

        <div class="container">
        <div class="row">
            <div class="col-md-3">
                
                <p class="text-dark">Total de Alumnos:{{ $studentCount }}</p>
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
                        <th class="text-uppercase text-secondary ps-2">NOMBRE y APELLIDOS</th>
                        <th class="text-uppercase text-secondary ps-2 ">FECHA DE NACIMIENTO</th>
                        <th class="text-uppercase text-secondary ps-2 ">TELÉFONO</th>
                        <th class="text-uppercase text-secondary ps-2 ">   DNI</th>
                    </tr>
                </thead>
                <tbody>


                    @foreach ($sectionsStudents as $student)
              
                    <tr>
                        <td class="align-middle text-center text-sm">{{$student->id}}</td>
                        <td class="align-middle text-uppercase text-sm"><p>{{$student->name}} {{$student->lastname}}</p></td>
                        <td class="align-middle text-uppercase text-sm"><p>{{$student->bithdate}}</p></td>
                        <td class="align-middle text-uppercase text-sm "><p>{{$student->phone_number}}</p></td>
                        <td class="align-middle text-uppercase text-sm">{{$student->dni}}</td>



                        
                    @endforeach 

                        
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