<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
    @if(session()->has('message'))
        <div class="p-4 mb-4 text-sm text-blue-700 bg-blue-100 rounded-lg dark:bg-blue-200 dark:text-blue-800"
             role="alert">
            <span class="font-medium">Info alert!</span> {{ session()->get('message') }}
        </div>

    @endif
    <div class="py-12 ">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                @auth
                    <div class="p-6 bg-white border-b border-gray-200">

                        <form method="POST" action="/home" enctype="multipart/form-data">
                            @csrf


                            <div class="mb-6">
                                <label for="name" class="block mb-2 uppercase font-bold text-xs text-gray-700">
                                    name
                                </label>
                                <input class="border border-gray-400 p-2 w-full rounded"
                                       type="text"
                                       name="name"
                                       id="name"
                                       required
                                >

                            </div>
                            <div class="mb-6">
                                <label for="description" class="block mb-2 uppercase font-bold text-xs text-gray-700">
                                    Description
                                </label>
                                <textarea class="border border-gray-400 p-2 w-full rounded resize-none"
                                          type="textarea"
                                          name="description"
                                          id="description"
                                          rows="4"
                                          required
                                ></textarea>
                            </div>
                            <div>
                                <label for="image_path" class="block mb-2 uppercase font-bold text-xs text-gray-700">Upload
                                    an image</label>
                                <input type="file"
                                       name="image_path"
                                       id="image_path">
                            </div>
                            <div class="my-6">
                                <button type="submit" class="bg-blue-500  rounded py-2 px-4 hover:bg-amber-900">
                                    Submit
                                </button>
                            </div>
                        </form>
                    </div>
            </div>
            @endauth
        </div>
    </div>
    <h1 class="text-5xl text-center mb-10">Posts</h1>
    <div class=" bg-zinc-500 rounded-3xl mx-auto p-3 max-w-7xl mb-10">

        @foreach($posts as $post)

            <div class="bg-zinc-600 rounded-3xl mx-10 p-5 mb-3 ">
                <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">{{$post->name}}</h5>
                <div class="flex justify-between items-center">
                    <p class="font-normal text-gray-700 dark:text-gray-400"> {{$post->description}}.</p>
                    <img src="{{$post->image_path}}" class="">
                </div>

            </div>

        @endforeach
    </div>
</x-app-layout>
