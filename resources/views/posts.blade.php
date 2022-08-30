<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <title>Posts</title>

</head>
<body>

@foreach($posts as $post)
    <div class="flex row m-10">
        <div class="flex flex-col w-1/2">
            <h2 class="font-bold">{{$post->name}}</h2>
            <p>{{$post->description}}</p>
        </div>
        <div class="justify-end w-1/2">
            <img src="{{asset('images/' . $post->image_path)}}" class="w-[400px] h-[300px]">
        </div>
    </div>
@endforeach


</body>
</html>
