<!DOCTYPE html>
<html>
	<head>
		<!-- Meta Tags -->
		<meta charset="utf-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge" />
		<meta name="csrf-token" content="{{ csrf_token() }}" />
		<meta name="base-url" content="{{ url('') }}" />
		<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport" />

		<!-- Title -->
		<title>
			{{ config('constants.website') }} 
			@if(isset($pagetitle))
				{{ $pagetitle }}
			@else
				@yield('pagetitle')
			@endif
		</title>

		<link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
		<link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A==" crossorigin=""/>
		<!-- CSS -->
		<link rel="stylesheet" href="{{ asset('/css/bootstrap.min.css') }}" />
		<link rel="stylesheet" href="{{ asset('/css/PNotify.css') }}" />
		<link rel="stylesheet" href="{{ asset('/css/main.css') }}" />

		@yield('page-css')

	</head>
	<body>

		<nav class="navbar navbar-expand-lg navbar-light bg-light">
			<div class="container">
			    <a class="navbar-brand" href="{{url('/')}}">Home</a>
			    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#adminnavbar" aria-controls="adminnavbar" aria-expanded="false" aria-label="Toggle navigation">
			        <span class="navbar-toggler-icon"></span>
			    </button>

			    <div class="collapse navbar-collapse" id="adminnavbar">
			        <ul class="navbar-nav mr-auto">
			        	@if(!isset($globaldata['user']))
			            <li class="nav-item {{ (isset($menu_login) && $menu_login) ? 'active' : '' }}">
			                <a class="nav-link" href="{{url('/login')}}">Login</a>
			            </li>

			            @else
			            <!-- <li class="nav-item {{ (isset($menu_post) && $menu_post) ? 'active' : '' }}">
			                <a class="nav-link" href="{{url('/posts')}}">Posts</a>
			            </li> -->
			            <li class="nav-item">
			                <a class="nav-link" href="{{url('/logout')}}">Logout</a>
			            </li>
			            @endif
			        </ul>
			    </div>
		    </div>
		</nav>



		@yield('content')


		<!-- Loader and Modal -->
		<div class="loader" id="loader">
			<div class="loader-tbl">
				<div class="loader-tbl-cell">
					<div class="loader-box">
						<div class="loader-text">
							Loading...
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- JS -->
		<script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js" integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA==" crossorigin=""></script>
		<script src="{{ asset('/js/combine.min.js') }}"></script>
		<script src="{{ asset('/js/PNotify.js') }}"></script>
		<script src="{{ asset('/js/common.js') }}"></script>

		@yield('page-scripts')

	</body>
</html>