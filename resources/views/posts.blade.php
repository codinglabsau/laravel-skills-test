<x-app-layout>
    <x-slot name="header">
        <!-- <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2> -->
    </x-slot>
    @foreach($posts as $post)
        <div class="bg-red-200 m-4">
            <h1> {{$post->name}} </h1>
            <p>
                {{$post->description}}
            </p>
        </div>
    @endforeach
</x-app-layout>
