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
            </div>
            <br>
            <div class="card">
                <div class="card-header">Posts</div>
                <div class="card-body">
                    <form method="POST" action="{{ route('new_post') }}" >
                        @csrf

                        <div class="form-group row">
                            <label for="name" class="col-sm-2 col-form-label text-md-right">Name</label>
                            <div class="col-md-6">
                                <input type="text" id="name" name="name" class="form-control{{ ($errors->has('name'))? ' is-invalid' : '' }}"required /> 
                                @if ($errors->has('name'))
                                    <div>
                                        <strong>missing name</strong>
                                    </div>  
                                @endif
                            </div>
                        </div>  

                        <div class="form-group row">
                            <label for="description" class="col-sm-2 col-form-label text-md-right">Description</label>
                            <div class="col-md-6">
                                <input type="text" id="description" 
                                name="description" class="form-control{{ ($errors->has('description'))? ' is-invalid' : '' }}" required>
                            </div>
                            
                        </div>
                        <div class="form-group ">
                            
                            <button type="submit" onclick class="btn btn-primary btn-outline-info">
                                Submit
                            </button>

                            @if ( session()->has('success'))
                            <span class="alert alert-success">
                                <strong>Success</strong>
                            </span>
                            @endif
                        </div> 
                    </form>
                </div>
            </div>
        </div>
        
    </div>
</div>
@endsection
