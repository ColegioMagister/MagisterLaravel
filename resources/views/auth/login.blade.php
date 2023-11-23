<!DOCTYPE html>
<html lang="es">

<head>

	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="apple-touch-icon" sizes="76x76" href="./assets/img/apple-icon.png">
	<link rel="icon" type="image/png" href="assets/img/favicon.png">
	<title>
		I.E.P "MAGISTER"
	</title>
	<!--     Fonts and icons     -->
	<link rel="stylesheet" type="text/css"
		href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900|Roboto+Slab:400,700" />
	<!-- Nucleo Icons -->
	<link href="assets/css/nucleo-svg.css" rel="stylesheet" />
	<link href="assets/css/nucleo-icons.css" rel="stylesheet" />
	<!-- Font Awesome Icons -->
	<!--<script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script> -->

	<script src="https://kit.fontawesome.com/469f55554f.js" crossorigin="anonymous"></script>
	<!-- Material Icons -->
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet">
	<!-- CSS Files -->
	<link id="pagestyle" href="assets/css/material-dashboard.css?v=3.0.0" rel="stylesheet"/>

</head>

<body class="bg-gray-200">

	<main class="main-content  mt-0">


		<div class="global-container page-header align-items-start min-vh-100">


			<div class="box1 min-vh-100">
				<img src="assets/img/login-bg/logo-magister.png" class="z-index-2" alt="">
			</div>

			<span class="mask bg-gradient-dark opacity-4 z-index-0"></span>

			<div class="box2 container my-auto z-index-2">
				<div class="logo-magister my-5">
					<h4 class="text-center text-white font-weight-light">SISTEMA DE ADMINISTRACIÓN ESCOLAR</h4>
					<img src="assets/img/login-bg/logo-magister.png" alt="">

				</div>

				<div class="row">
					<div class="col-lg-6 col-md-8 col-12 mx-auto">
						<div class="card z-index-0 fadeIn3 fadeInBottom">
							<div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">

								<div class="box-wlc border-radius-lg py-3 pe-1">
									<img src="assets/img/login-bg/bg-right1.jpg" alt="">
									<h3 class="text-white font-weight-bolder text-center mt-3 mb-4">¡BIENVENIDO!</h3>
									<h4 class="text-white font-weight-light text-center mt-2 mb-3">Ingrese a su cuenta
									</h4>

								</div>
							</div>

							<div class="card-body">

								<form role="form" class="text-start" method="POST" action="{{ route('login') }}">
									@csrf
									<div class="input-group input-group-outline mt-4 mb-5 ">
										<label class="form-label">USUARIO</label>
										<input id="username" type="username"
											class="form-control @error('username') is-invalid @enderror" name="username"
											value="{{ old('username') }}" required autocomplete="username" autofocus>
										@error('username')
										<span class="invalid-feedback" role="alert">
											<strong>{{ $message }}</strong>
										</span>
										@enderror
										<span class="form-bar"></span>
									</div>
									<div class="input-group input-group-outline  mb-3">
										<label class="form-label">CONTRASEÑA</label>
										<input id="password" type="password"
											class="form-control @error('password') is-invalid @enderror" name="password"
											required autocomplete="current-password">
										@error('password')
										<span class="invalid-feedback" role="alert">
											<strong>{{ $message }}</strong>
										</span>
										@enderror
										<span class="form-bar"></span>
									</div>
									<p class="has-text-centered mb-4 mt-3">
										<button type="submit" class="btn bg-gradient-primary w-100 my-4 mb-3">
											{{ __('INICIAR SESION') }}
										</button>
									</p>

								</form>
							</div>

						</div>
					</div>
				</div>
			</div>

		</div>
	</main>

	<!--   Core JS Files   -->

	<script src="assets/js/core/popper.min.js"></script>
	<script src="assets/js/core/bootstrap.min.js"></script>
	<script src="assets/js/plugins/perfect-scrollbar.min.js"></script>
	<script src="assets/js/plugins/smooth-scrollbar.min.js"></script>
	<script>
		var win = navigator.platform.indexOf('Win') > -1;
    if (win && document.querySelector('#sidenav-scrollbar')) {
      var options = {
        damping: '0.5'
      }
      Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
    }
	</script>

	<script async defer src="https://buttons.github.io/buttons.js"></script>

	<script src="assets/js/material-dashboard.min.js?v=3.0.0"></script>
</body>

</html>