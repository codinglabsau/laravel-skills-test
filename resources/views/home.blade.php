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
        </div>
    </div>
</div>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    @if (count($errors)>0)
                        <div class="alert">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{$error}}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                        
                    @if(Session::has('message'))
                        <div class="alert alert-success" role="alert">
                            {{ Session::get('message') }}
                        </div>
                    @endif
                    
                    <form method="POST" action='{{url("post")}}'> <!--goes to the store function in the controller -->
                        {{csrf_field()}}
                                          
                        <p>
                            <label>Name </label>
                            <input type="text" name="name" value="{{old('name')}}">
                        </p>

                        <p>
                            <label>Description </label>
                            <input type="text" name="description" value="{{old('description')}}">
                        </p>

                        <p>
                            <input type="hidden" name="user_id" value="{{Auth::user()->id}}">     
                        </p>   

                        <input type="submit" value="Create a post"> 
                    </form>
                </div>    
            </div>
        </div>
    </div>
</div>
@endsection
