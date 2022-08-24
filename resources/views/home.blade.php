<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <title> Blog </title>

    </head>
    <body class="antialiased">
        <div style=" width: 900px;" class="max-w-full mx-auto pt-4">

            @if(Session::has('message'))
                <p class="{{Session::get('color')}} text-green-500">
                    {{ Session::get('message') }}
                </p>
            @endif

            @if(\Illuminate\Support\Facades\Auth::user())
                <form method="POST" action="/post/create/{{\Illuminate\Support\Facades\Auth::user()->id}}"
                        enctype="multipart/form-data">
                    @method('POST')
                    @csrf
                    <div class="mb-4">
                        <label class="font-bold text-gray-800" for="name"> Name: </label>
                        <input class="h-10 bg-white border-2 border-gray-300 rounded py-4 px-3 mr-4 w-full
                                    text-gray-600 text-sm focus:outline-none focus:border-gray-400 focus:ring-0" id="name"
                            name="name" value="">
                        @if ($errors->has('name'))
                            <span class="font-red-400">{{ $errors->first('name') }}</span>
                        @endif
                    </div>
                    <div class="mb-4">
                        <label class="font-bold text-gray-800" for="description"> Description: </label>
                        <textarea class="h-28 bg-white border-2 border-gray-300 rounded py-4 px-3 mr-4 w-full
                                    text-gray-600 text-sm focus:outline-none focus:border-gray-400 focus:ring-0" id="description"
                                name="description" >  </textarea>
                        @if ($errors->has('description'))
                            <span class="font-red-400">{{ $errors->first('description') }}</span>
                        @endif
                    </div>
                    <div class="image mb-3">
                        <label>
                            <h4>
                                Add image
                            </h4>
                        </label>
                        <input type="file" required name="image">
                    </div>

                    <button class="bg-blue-600 text-white p-2 rounded-lg">
                        Create
                    </button>
                </form>
                <button class="bg-green-600 text-white p-2 rounded-lg mt-2">
                    <a href="/posts"> View posts </a>
                </button>
            @else
                <p> You need to sign in </p>
            @endif

        </div>
    </body>
</html>
