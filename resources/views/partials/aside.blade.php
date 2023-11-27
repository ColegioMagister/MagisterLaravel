@php
  $role=Auth::user()->employee->roles->role_name;   
@endphp
<aside class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-3   bg-gradient-dark" id="sidenav-main">
  @if ($role=='Admin')
    <div class="sidenav-header">
      <i class="fas fa-times p-3 cursor-pointer text-white opacity-5 position-absolute end-0 top-0 d-none d-xl-none" aria-hidden="true" id="iconSidenav"></i>
      <a class="navbar-brand m-0" href="{{ route('data.index') }}">
        <img src="{{asset('assets/img/login-bg/logo-magister.png')}}" class="navbar-brand-img h-100" alt="main_logo">
        <span class="ms-1 font-weight-bold text-white">I.E.P. "MAGISTER</span>
      </a>
    </div>
    <hr class="horizontal light mt-0 mb-2">
    <div class="collapse navbar-collapse  w-auto  max-height-vh-100" id="sidenav-collapse-main">
      <ul class="navbar-nav">
        

        <li class="nav-item">
          <a class="nav-link text-white {{setActive('data.*')}}" href="{{ route('data.index') }}">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="material-icons opacity-10">table_view</i>
            </div>
            <span class="nav-link-text ms-1">Datos Generales</span>
          </a>
        </li>
        
        <li class="nav-item">
          <a class="nav-link text-white {{setActive('user.index')}}" href="{{ route('user.index') }}">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="fa-solid fa-people-group"></i>
            </div>
            <span class="nav-link-text ms-1">Usuarios</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white {{setActive('schoolYear.*')}}" 
          href="#
          {{-- {{ route('schoolYear.index') }} --}}
          "
          >
            <div class="text-white text-center ms-1 me-2 d-flex align-items-center justify-content-center">
              <i class="fa-regular fa-calendar-days"></i>
            </div>
            <span class="nav-link-text ms-1">Año Escolar</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white {{setActive('sections.*')}}" href="#
          {{-- {{ route('sections.principalIndex') }} --}}
          "
          >
            <div class="text-white text-center ms-1 me-2 d-flex align-items-center justify-content-center">
              <i class="fa-solid fa-cubes"></i>
            </div>
            <span class="nav-link-text ms-1">Secciones</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white {{setActive('assessment.*')}}" href="#
          {{-- {{ route('assessment.index') }} --}}
          ">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="fa-solid fa-file-pen"></i>
            </div>
            <span class="nav-link-text ms-1">Evaluaciones</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white {{setActive('subject.*')}}" href="{{ route('subject.index') }}
          ">
            <div class="text-white text-center ms-1 me-2 d-flex align-items-center justify-content-center">
              <i class="fa-solid fa-book"></i>
            </div>
            <span class="nav-link-text ms-1">Materias</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white {{setActive('teacher.*')}}" href="{{ route('teacher.index') }}">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="fa-solid fa-chalkboard-user"></i>
            </div>
            <span class="nav-link-text ms-1">Profesores</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white {{setActive('students.*')}}" href="{{ route('students.index') }}
          ">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="fa-solid fa-people-group"></i>
            </div>
            <span class="nav-link-text ms-1">Alumnos</span>
          </a>
        </li>
      
        <li class="nav-item mt-3">
          <h6 class="ps-4 ms-2 text-uppercase text-xs text-white font-weight-bolder opacity-8">Configuración de usuario</h6>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white {{setActive('user.profile')}}" href="#
          {{-- {{ route('user.profile') }} --}}
          ">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="material-icons opacity-10">person</i>
            </div>
            <span class="nav-link-text ms-1">Perfil</span>
          </a>
        </li>
        @elseif($role=='Profesor')
        <div class="sidenav-header">
          <i class="fas fa-times p-3 cursor-pointer text-white opacity-5 position-absolute end-0 top-0 d-none d-xl-none" aria-hidden="true" id="iconSidenav"></i>
          <a class="navbar-brand m-0" href="{{ route('homeTeacher') }}">
            <img src="{{asset('assets/img/login-bg/logo-magister.png')}}" class="navbar-brand-img h-100" alt="main_logo">
            <span class="ms-1 font-weight-bold text-white">I.E.P. "MAGISTER</span>
          </a>
        </div>
        <hr class="horizontal light mt-0 mb-2">
        <div class="collapse navbar-collapse  w-auto  max-height-vh-100" id="sidenav-collapse-main">
          <ul class="navbar-nav">
            <li class="nav-item">
              <a class="nav-link text-white" href="{{ route('homeTeacher') }}">
                <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                  <i class="material-icons opacity-10">dashboard</i>
                </div>
                <span class="nav-link-text ms-1">Panel de Control</span>
              </a>
            </li>
          <li class="nav-item">
            <a class="nav-link text-white " href="{{ route('teacherView.index') }}">
              <div class="text-white text-center ms-1 me-2 d-flex align-items-center justify-content-center">
                <i class="fa-solid fa-cubes"></i>
              </div>
              <span class="nav-link-text ms-1">Secciones</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link text-white {{setActive('user.profile')}}" href="{{ route('user.profile') }}">
              <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                <i class="material-icons opacity-10">person</i>
              </div>
              <span class="nav-link-text ms-1">Perfil</span>
            </a>
          </li>
        @endif

      </ul>
      
    </div>
    
  </aside>