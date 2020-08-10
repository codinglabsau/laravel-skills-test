@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    You are logged in!
                </div>

                <form method="POST" action="{{ route('post') }}">
                    @csrf

                    <div class="form-group row">
                        <div class="col-md-6 mx-auto">
                            <label for="name" class="col-form-label text-md-right">{{ __('Name') }}</label>
                            <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" autofocus>

                            @if ($errors->has('name'))
                                <span class="text-danger" role="alert">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-md-6 mx-auto">
                            <label for="description" class="col-form-label">{{ __('Description') }}</label>
                            <textarea id="description" type="text" class="form-control {{ $errors->has('name') ? ' is-invalid' : '' }}" name="description"></textarea>
                            @if ($errors->has('description'))
                                <span class="text-danger" role="alert">
                                        <strong>{{ $errors->first('description') }}</strong>
                                    </span>
                            @endif

                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-6 mx-auto">
                            <button type="submit" class="btn btn-primary">
                                {{ __('Post') }}
                            </button>
                        </div>
                    </div>

                    @if(session()->has('message'))
                        <div class="alert alert-success">
                            {{ session()->get('message') }}
                        </div>
                    @endif
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
