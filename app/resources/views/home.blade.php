@extends('layouts.app')

@section('content')

<h1> Form </h1>

<hr>

<form action="submit" method="POST">
@csrf
    
<b>Name</b>
<input type="text" name="name"><br><br>

<b>Description</b>
<input type="text" name="description"><br><br>

<button type="submit"> Submit </button>

</form>

<hr>
@endsection
