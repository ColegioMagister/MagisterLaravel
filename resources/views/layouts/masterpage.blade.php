@include('partials.head')

  <body class="g-sidenav-show  bg-gray-200">
    
    @include('partials.aside')

  <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
    <!-- Navbar -->
    @include('partials.navbar')

    <div class="pcoded-content">
      @yield('content')
    </div>

    <!-- End Navbar -->
  
  </main>

    @include('partials.fixed-plugin')
   
    <!--   Core JS Files   -->

@include('partials.scripts')

