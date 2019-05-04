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

                <form class="form-horizontal" method="post" action="/post">
                  {{csrf_field()}}
                    <fieldset>
                        <legend><br>Make a Post</legend>
                            <div class="form-group" >  
                                <input type="hidden" class="form-control" name="id" value="{{ Auth::user()->id }}">           <!-- Includes logged in users id --> 
                                <label class="col-lg-2 control-label">Name:</label>
                                    <div class="col-lg-10">
                                        <input type="text" class="form-control" name="name" placeholder="Name">
                                    </div>
                                <label class="col-lg-2 control-label">Description:</label>
                                <div class="col-lg-10">
                                    <textarea class="form-control" rows="3" name="description" placeholder="Description"></textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-lg-10 col-lg-offset-2">
                                    <button type="reset" class="btn btn-default">Clear</button>
                                    <button type="submit" class="btn btn-default">Submit</button>
                                </div>
                            </div>
                    </fieldset>
                </form>
                @if (\Session::has('success'))                <!-- If a success note is recieved Show a post successfull note -->  
                    <div class="alert alert-success">
                        <ul>
                            <li>{!! \Session::get('success') !!}</li>
                        </ul>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
