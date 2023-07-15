@extends('layouts.masterpage')

@section('content')

<div class="container-fluid py-4">
<div class="row">
<div class="col-12">
<div class="card my-4">
    <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
        <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
            <h6 class="text-white text-capitalize ps-3">USUARIOS</h6>
        </div>
        <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#ModRegUsuario">
            <i class="fa-solid fa-plus"></i> &nbsp; Ingresar
        </button>
    </div>
    <div class="card-body px-0 pb-2">
        <div class="table-responsive p-0">
            <table class="table align-items-center mb-0">
                <thead>
                    <tr>
                    <th class="text-center opacity-7">ID</th>
                    <th class="text-uppercase text-secondary ps-2">Rol</th>
                    <th class="text-uppercase text-secondary ps-2 ">Nombre</th>
                    <th class="text-uppercase text-secondary ps-2 ">Apellidos</th>
                    <th class="text-uppercase text-secondary ps-2">Usuario</th>
                    <th colspan=2 class="text-secondary opacity-7"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $user)
                        <tr>
                            <td class="align-middle text-center text-sm">{{ $loop->iteration }}</td>
                            <td class="align-middle text-uppercase text-sm ">{{ $user->employee->roles->role_name}}</td>
                            <td class="align-middle text-uppercase text-sm ">{{ $user->employee->name }}</td>
                            <td class="align-middle text-uppercase text-sm ">{{ $user->employee->lastname}}</td>
                            <td class="align-middle text-uppercase text-sm ">{{ $user->username }}</td>
                            <td class="align-middle text-uppercase text-sm">
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#EditarProfesor{{ $user->id }}" enctype="multipart/form-data">
                                <i class="fa-solid fa-plus"></i> Editar
                            </button>
                            </td>
                            <td class="align-middle text-uppercase text-sm">
                                <form method="POST" action="{{ url('/Employees' . '/' . $user->id) }}" accept-charset="UTF-8" style="display:inline">
                                    {{ method_field('DELETE') }}
                                    {{ csrf_field() }}
                                    <button type="submit" class="btn btn-danger btn-sm" title="Delete Teacher"onclick="return confirm("Confirm delete?")"><i class="fa fa-trash-o" aria-hidden="true"></i>Eliminar</button>
                                </form>
                            </td>
                        <tr>
                     @endforeach  
                </tbody>
               
            </table>
        </div>
        </div>
        <div class="modal fade" id="ModRegUsuario" tabindex="-1" aria-labelledby="ModRegUsuario" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header bg-gradient-primary">
                        <h5 class="modal-title text-white" id="ModRegTeacher">Registrar Usuario</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form id="userRegister" role="form" class="text-start" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="modal-body">
                            <div class="input-group input-group-outline mt-2 mb-4">
                                <div class="col-6">
                                    <div class="input-group input-group-outline me-2">
                                        <select class="form-control" name="id_employee" id="id_employee">
                                            <option selected disabled> Elige un empleado </option>
                                            @foreach($employees as $employee)
                                                <option value="{{$employee->id}}"> {{$employee->id}} - {{$employee->name}} {{$employee->lastname}} </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
        
                            <div class="input-group input-group-outline me- mb-4">
                                <label class="form-label">USUARIO</label>
                                <input id="username" type="text" class="form-control @error('usernmae') is-invalid @enderror" name="username" value="{{ old('username') }}" required autofocus>
                                @error('username')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div> 
        
                            <div class="input-group input-group-outline  mb-3">
                                <label class="form-label">{{ __('CONTRASEÑA') }}</label>
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
        
                            <div class="input-group input-group-outline  mb-3">
                                <label class="form-label">{{ __('CONFIRMAR CONTRASEÑA') }}</label>
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary mx-2" data-bs-dismiss="modal">Cerrar</button>
                            <button id="submitBtn" type="submit" class="btn btn-primary">{{ __('REGISTRARSE') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    </div>
    </div>
    </div>
@endsection