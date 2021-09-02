@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Create A Post</h3>
                </div>

                <!-- form -->
                <form role="form" method="POST" action="home"`>
                    @csrf
                    <div class="card-body">

                        <!-- login message -->
                        <div class="card-body">
                            @if (session('status'))
                                <div class="alert alert-success" role="alert">
                                    {{ session('status') }}
                                </div>
                            @endif
                            You are logged in!
                            <br><br>
                        </div>
                        <!-- end login message -->

                        <!-- flash-message -->
                        <div class="flash-message">
                            @foreach (['danger', 'warning', 'success', 'info'] as $msg)
                                @if(Session::has('alert-' . $msg))
                                    <p class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
                                @endif
                            @endforeach
                        </div>
                        <!-- end .flash-message -->

                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" name="name" id="name" placeholder="Please enter a name" required>
                        </div>
                        <div class="form-group">
                            <label for="description">Description</label>
                            <input type="text" class="form-control" name="description" id="description" placeholder="Please enter a description" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit <Post></Post></button>
                    </div>
                </form>

                <!-- end form -->
            </div>
        </div>
    </div>
</div>
@endsection
