<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
    @if(session()->has('message'))
        <div class="p-4 mb-4 text-sm text-blue-700 bg-blue-100 rounded-lg dark:bg-blue-200 dark:text-blue-800" role="alert">
            <span class="font-medium">Info alert!</span> {{ session()->get('message') }}
        </div>

    @endif
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form method="POST" action="/home" >
                        @csrf

                        <input name="UserID" type="hidden" value="{{Auth::user()->id}}" id="UserID">
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
                            <label for="Description" class="block mb-2 uppercase font-bold text-xs text-gray-700">
                                Description
                            </label>
                            <input class="border border-gray-400 p-2 w-full rounded"
                            type="text"
                            name="Description"
                            id="Description"
                            required
                            >
                        </div>
                        <div class="mb-6">
                                        <button type="submit" class="bg-blue-500  rounded py-2 px-4 hover:bg-amber-900">
                                            Submit
                                        </button>
                                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div>
        @foreach($posts as $post)
            {{$post->name}}
            {{$post->Description}}
        @endforeach
    </div>
</x-app-layout>
