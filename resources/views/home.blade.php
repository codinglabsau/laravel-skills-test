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
            <h3>Create a Post</h3>
            <form method="POST" action='{{url("create_post")}}'>
                {{csrf_field()}}
                <input type="hidden" name="userId" value="{{Auth::user()->id}}">
                <div>
                    <label for="name" >Name:</label>
                    <div>
                        <input type="text" name="name">
                    </div>
                </div>
                <div>
                    <label for="description" >Description:</label>
                    <div>
                        <input type="text" name="description">
                    </div>
                </div>
                <button type="submit">Create</button>
            </form>
        </div>
    </div>
</div>
@endsection
