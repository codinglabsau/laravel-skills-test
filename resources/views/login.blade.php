@extends('layouts.layout')

@section('pagetitle', ' - Login')

@section('content')

        <main>
            <div class="container">
                <div class="row">
                    <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
                        <div class="card card-signin my-5">
                            <div class="card-body">
                                <h5 class="card-title text-center">Sign In</h5>
                                {!! Form::open(['url' => url('/login'), 'class' => 'tooltip-right-bottom', 'id' => 'formlogin']) !!}
                                    <div class="form-group">
                                        <label for="inputEmail">Email address</label>
                                        {!! Form::text('email', '', ['class' => 'form-control', 'placeholder' => 'Email']) !!}
                                    </div>

                                    <div class="form-group">
                                        <label for="inputPassword">Password</label>
                                        {!! Form::password('password', ['class' => 'form-control', 'placeholder' => 'Password']) !!}
                                    </div>

                                    <button class="btn btn-lg btn-primary btn-block text-uppercase" type="submit">Sign in</button>
                                {!! Form::close() !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>

@endsection
@section('page-scripts')
<script src="{{ asset('/js/login.js') }}"></script>
@endsection