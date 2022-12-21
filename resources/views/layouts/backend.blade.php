<!DOCTYPE html>
<html lang="en" >
    <head>
        <meta charset="UTF-8">
        <title>Màn hình dashboard</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
        <title>Iron Man Login Form - CodePen</title>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.1/css/all.min.css" integrity="sha256-2XFplPlrFClt0bIdPgpz8H7ojnk10H69xRqd9+uTShA=" crossorigin="anonymous" />
        <link rel="stylesheet"  href="{{ asset('/css/dashboard.css') }}">
		<link rel="stylesheet"  href="{{ asset('/css/style.css') }}">
		<script src="{{ asset('js/jquery361.min.js') }}"></script>
		

		<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />

		@yield('javascript')
    </head>

<body>
<div class="container">
    <div class="row">
	
		<div class="navbar">
			<a href="{{ asset('/') }}" style="margin-right: 15px">Trang chủ</a>
			@if (Auth::check())
				<h4>Hi: {{ Auth::user()->fullname}}</h4>
			@endif
			<a href="{{ asset('/logout') }}">Đăng xuất</a>
		</div>
		<div class="col-12">
            <div class="my-5">
				<h3><b>@yield('title')</b></h3>
			</div>
		
            @yield('content')

		</div>
	</div>
</div>

</body>

</html>