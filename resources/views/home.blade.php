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

        <div class="mt-3 col-md-8">
            <div class="card">
                <div class="card-header">Add a Post</div>

                @include('includes.showSuccess')

                <div class="card-body">
                    <form method="post" action="{{route('createPost')}}">

                        @csrf

                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="Enter post name">
                        </div>
                        <div class="form-group">
                            <label for="description">Description</label>
                            <input type="text" class="form-control" id="description" name="description" placeholder="Post description">
                        </div>
                        <button type="submit" class="btn btn-primary">Create Post</button>
                        </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
