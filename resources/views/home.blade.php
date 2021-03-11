@extends('layouts.app')

@section('content')
<div class="container">
    @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <h1>Create a new post</h1>
    <form method="post" action="/home" enctype="multipart/form-data">
        {{ csrf_field() }}
        <p><label>Name: </label>
        <input type="text" name="name" value="{{old('name')}}"></p>
        <p><label>Description: </label>
        <textarea row="1" cols="40" type="text" name="description">{{old('description')}}</textarea></p>
        <P><input type="file" name="image"></P>
        <input type="submit" value="create">
    </form>
</div>
@endsection
