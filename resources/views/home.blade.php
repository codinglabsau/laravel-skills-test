@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
                @if (session('status'))
                    <div class="alert alert-primary">
                        {{ session('status') }}
                    </div>
                @endif
                <div class="card mb-4">
                <div class="card-header">Dashboard</div>
                <div class="card-body">
                    You are logged in!
                </div>
            </div>
            <div class="card mb-4">
                <div class="card-header">Create Post</div>
                <div class="card-body">
                    <form action="{{ action('HomeController@store') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}">
                            @error('name')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <textarea class="form-control @error('description') is-invalid @enderror" name="description" rows="4">{{ old('description') }}</textarea>
                            @error('description')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="image" class="form-label">Image</label>
                            <div class="input-group">
                                <input id="imageUploadField" class="form-control @error('image') is-invalid @enderror" type="file" name="image">
                                <button id="deleteFileButton" class="btn btn-outline-danger" type="button" disabled>
                                    {{-- Bootstrap trash icon --}}
                                    <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-trash-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd"
                                          d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5a.5.5 0 0 0-1 0v7a.5.5 0 0 0 1 0v-7z">
                                        </path>
                                    </svg>
                                </button>
                            </div>
                            @error('image')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                            <div class="form-text">File must be 512KB or under in size and of type .png, .jpeg, .jpg, .tiff or .tif. Image will be resized to be 400x300px and will not maintain its aspect ratio.</div>
                        </div>
                        <button type="submit" class="btn btn-primary w-100 text-white">Post</button>
                    </form>
                </div>
            </div>
            <hr>
            <h2 class="my-4">Your Posts</h2>
            @if(count($posts) == 0)
            <p>You have not made any posts.</p>
            @else
            <div class="row row-cols-1 row-cols-md-2 g-4">
                @foreach ($posts as $post)
                <div class="col">
                    <div class="card">
                        @isset($post->image_path)
                            <div class="card-img-top">
                                <div class="ratio ratio-4x3">
                                    <img src="{{ asset('storage/post-images').'/'.$post->image_path }}">
                                </div>
                            </div>
                            @endisset
                            <div class="card-body">
                                <h3>{{ $post->name }}</h3>
                                <p>{{ $post->description }}</p>
                                <input type='submit' form="delete-{{$post->id}}" class="btn btn-danger" value='Delete'>
                                <form id="delete-{{$post->id}}" method="POST" action="{{ action('HomeController@destroy', ['post' => $post->id]) }}">
                                    @csrf
                                    @method('DELETE')
                                </form>
                            </div>
                    </div>
                </div>
                @endforeach
            </div>
            @endempty
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script type="text/javascript">
    document.addEventListener("DOMContentLoaded", function() {
        var inputField = document.getElementById('imageUploadField');
        var deleteButton = document.getElementById('deleteFileButton');

        inputField.addEventListener('change', function() {
            deleteButton.disabled = false;
        }, false);

        deleteButton.addEventListener('click', function() {
            inputField.value = '';
            deleteButton.disabled = true;
        });
    });
</script>
@endsection
