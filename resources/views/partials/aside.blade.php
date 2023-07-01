<aside class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-3   bg-gradient-dark" id="sidenav-main">
    <div class="sidenav-header">
      <i class="fas fa-times p-3 cursor-pointer text-white opacity-5 position-absolute end-0 top-0 d-none d-xl-none" aria-hidden="true" id="iconSidenav"></i>
      <a class="navbar-brand m-0" href="{{ route('home') }}">
        <img src="assets/img/login-bg/logo-magister.png" class="navbar-brand-img h-100" alt="main_logo">
        <span class="ms-1 font-weight-bold text-white">I.E.P. "MAGISTER</span>
      </a>
    </div>
    <hr class="horizontal light mt-0 mb-2">
    <div class="collapse navbar-collapse  w-auto  max-height-vh-100" id="sidenav-collapse-main">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link text-white" href="{{ route('home') }}">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="material-icons opacity-10">dashboard</i>
            </div>
            <span class="nav-link-text ms-1">Panel de Control</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white " href="">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="material-icons opacity-10">table_view</i>
            </div>
            <span class="nav-link-text ms-1">Datos Generales</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white " href="{{ route('schoolYear.index') }}">
            <div class="text-white text-center ms-1 me-2 d-flex align-items-center justify-content-center">
              <i class="fa-regular fa-calendar-days"></i>
            </div>
            <span class="nav-link-text ms-1">Año Escolar</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white " href="{{ route('sections.index') }}">
            <div class="text-white text-center ms-1 me-2 d-flex align-items-center justify-content-center">
              <i class="fa-solid fa-cubes"></i>
            </div>
            <span class="nav-link-text ms-1">Secciones</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white " href="{{ route('subject.index') }}">
            <div class="text-white text-center ms-1 me-2 d-flex align-items-center justify-content-center">
              <i class="fa-solid fa-book"></i>
            </div>
            <span class="nav-link-text ms-1">Materias</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white " href="{{ route('schedule.index') }}">
            <div class="text-white text-center ms-1 me-2 d-flex align-items-center justify-content-center">
              <i class="fa-solid fa-clock"></i>
            </div>
            <span class="nav-link-text ms-1">Horarios</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white" href="{{ route('teacher.index') }}">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="fa-solid fa-chalkboard-user"></i>
            </div>
            <span class="nav-link-text ms-1">Profesores</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white" href="{{ route('students.index') }}">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="fa-solid fa-people-group"></i>
            </div>
            <span class="nav-link-text ms-1">Alumnos</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white " href="{{ route('assessment.index') }}">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="fa-solid fa-file-pen"></i>
            </div>
            <span class="nav-link-text ms-1">Evaluaciones</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white " href="{{ route('quota.index') }}">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="fa-solid fa-file-invoice-dollar"></i>
            </div>
            <span class="nav-link-text ms-1">Pagos</span>
          </a>
        </li>
        <li class="nav-item mt-3">
          <h6 class="ps-4 ms-2 text-uppercase text-xs text-white font-weight-bolder opacity-8">Configuración de usuario</h6>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white " href="">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="material-icons opacity-10">person</i>
            </div>
            <span class="nav-link-text ms-1">Perfil</span>
          </a>
        </li>

      </ul>
      
    </div>
    
  </aside>