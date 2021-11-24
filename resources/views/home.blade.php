<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />

		<meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Dashboard - SB Admin</title>
        <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />
        <link href="css/styles.css" rel="stylesheet" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js" crossorigin="anonymous"></script>
    </head>
    <body class="sb-nav-fixed">
		<div id="app">
			@include('layouts.common.navbar')
			<div id="layoutSidenav">
				@include('layouts.common.sidebar')
				<div id="layoutSidenav_content">
					<main>

						<router-view></router-view>

						
					</main>
					<footer class="py-4 bg-light mt-auto">
						<div class="container-fluid px-4">
							<div class="d-flex align-items-center justify-content-between small">
								<div class="text-muted">Copyright &copy; Your Website 2021</div>
								<div>
									<a href="#">Privacy Policy</a>
									&middot;
									<a href="#">Terms &amp; Conditions</a>
								</div>
							</div>
						</div>
					</footer>
				</div>
			</div>
		</div>
		@auth
			<script>
				window.user = @json(auth()->user())
			</script>
        @endauth
		<script src="{{ mix('js/app.js') }}"></script>
        {{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script> --}}
        <script src="js/scripts.js"></script>
        {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script> --}}
        {{-- <script src="assets/demo/chart-area-demo.js"></script> --}}
        {{-- <script src="assets/demo/chart-bar-demo.js"></script> --}}
        {{-- <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script> --}}
        {{-- <script src="js/datatables-simple-demo.js"></script> --}}
    </body>
</html>



{{-- <!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
	
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel=stylesheet>
    
    <link rel=stylesheet href="{{ mix('css/app.css') }}" />

    <title>{{env('APP_NAME')}}</title><style>body{font-family:'Nunito',sans-serif}</style></head>
<body>
    <div id=app class=wrapper>
		<header id=appHeader class=app-header>
			<app-header></app-header>
		</header>
		<main id=appMain class=app-main>
			<router-view></router-view>
		</main>
		<footer id=appFooter class=app-footer>
			<app-footer></app-footer>
		</footer>
    </div>  </body>
</html> --}}