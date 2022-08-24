<div class="m-4 bg-gray-100 rounded-lg border-2 border-black p-10 w-1/4 h-72">
    <h1 class="text-3xl w-18">
        {{$post->name}}
    </h1>
    <div class="text-xl w-12">
        {{substr($post->description,0,50)}}...
    </div>
    <img src="{{asset('images/'.$post->image)}}" class="w-1/2 h-1/2">
</div>
