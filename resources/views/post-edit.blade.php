@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Post</div>

                <div class="card-body">
                    @include('flash::message')

                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('post.update', $post->id) }}" enctype="multipart/form-data">
                        @csrf
                        {{ method_field('PUT') }}

                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">Name</label>

                            <div class="col-md-6">
                                <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $post->name }}" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="description" class="col-md-4 col-form-label text-md-end">Description</label>

                            <div class="col-md-6">

                                <textarea name="description" class="form-control @error('description') is-invalid @enderror" rows="5">{{ $post->description }}</textarea>

                                @error('description')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="image" class="col-md-4 col-form-label text-md-end">Image</label>

                            <div class="col-md-6">

                                @if(isset($post->image))
                                    <div class="show-image">
                                         <img class="custom-thumbnail selected-img" src="@if(isset($post->image)) /storage/images/{{$post->image}} @endif" class="custom-thumbnail">
                                    </div>
                                @else
                                    <div class="image-margin"> 
                                        <img class="selected-img" src="">

                                        <button type="button" class="btn btn-xs btn-delete-image" onclick="removeImage()">
                                            <i class="fa fa-times fa-2x"></i>
                                        </button>
                                    </div>
                                @endif

                                <input id="image" type="file" class="form-control input_image @error('image') is-invalid @enderror" name="image" value="{{ $post->image }}" autofocus>

                                @error('image')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    Update
                                </button>
                            </div>
                        </div>
                        <hr>
                        <a href="{{ route('post.index') }}">List of Posts</a><br>
                        <a href="{{ route('post') }}">Create Post</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
