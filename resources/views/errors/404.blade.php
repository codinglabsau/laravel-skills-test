@extends('layouts.layout')

@section('content')

<section class="content">
	<div class="error-page">
		<h2 class="headline text-yellow m0"> 404</h2>
		<div class="error-content pt5">
			<h3><i class="fa fa-warning text-yellow"></i> Oops! Page not found.</h3>
			<p>
				We could not find the page you were looking for.
				Meanwhile, you may return to <a href="{{ url('/') }}">Home</a>.
			</p>
		</div>
	</div>
</section>
@endsection