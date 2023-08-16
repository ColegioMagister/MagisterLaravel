@extends('layouts.masterpage')

@section('content')

@include('layouts.msjs')
<div class="container-fluid p-5"> 
  <div class="row" style="display: flex; justify-content: center;">
    <div class="col-xl-9 text-center">
      <div class="card">
        <div class="card-header p-5 pt-2">
          <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3 mt-n4">
            <h5 class="text-white text-capitalize text-center">ACTUALIZAR DATOS</h5>
          </div>
          <br>
          <div class="period-box" style= "border-radius: 50%;">
            <img src="" class="im" style= "width: 20%;border-radius: 8%;">
          </div>

          
          
            

            <form action="{{route('changePassword')}}" method="POST" class="needs-validation" novalidate>
            @csrf

                <div class="row" style= padding:2%;>
                  
                    <div class="row text-center" >
                      <div class="col-5 pt-4">
                        <div class="input-group input-group-outline me-2 focused is-focused">
                          <label class="form-label">Usuario</label>
                          <input type="text" name="username" value="{{ Auth::user()->username }}" class="form-control @error('username') is-invalid @enderror" required>
                          @error('username')
                            <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                            </span>
                          @enderror
                        </div>
                      </div>
                      <div class="col-7 pt-4">
                        <div class="input-group input-group-outline me-2 focused is-focused">
                          <label class="form-label">Contraseña Actual</label>
                          <input type="password" name="password_actual" class="form-control @error('password_actual') is-invalid @enderror" required>
                            @error('password_actual')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                      </div>
                    </div>


                    <div class="row text-center" >
                      <div class="col pt-4">
                        <div class="input-group input-group-outline me-2 focused is-focused">
                          <label class="form-label">Nueva Contraseña</label>
                          <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" required>
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                      </div>
                    
                      <div class="col pt-4">
                        <div class="input-group input-group-outline me-2 focused is-focused">
                          <label class="form-label">Confirmar contraseña</label>
                          <input type="password" name="confirm_password" class="form-control @error('confirm_password') is-invalid @enderror"required>
                            @error('confirm_password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                      </div>
                    </div>


                    <div class="row text-center mb-4 mt-5">
                      <div class="col-md-12">
                          <button type="submit" class="btn btn-success" id="formSubmit"><i class="fa-solid fa-pencil fa-xl"></i> &nbsp; Guardar Cambios</button>
                          <a href="{{route('user.profile')}}" class="btn btn-primary"><i class="fa-solid fa-chevron-left"></i> &nbsp; Volver</a>
                      </div>
                    </div>
                  </form>
                    
                </div>
              
              


        </div>
      </div>
    </div>
  </div>
</div>













@endsection