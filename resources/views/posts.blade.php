@if(\Illuminate\Support\Facades\Auth::user())
    <x-app-layout>
        <x-slot name="header">
            <!-- <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Dashboard') }}
            </h2> -->
        </x-slot>
        <button class="bg-green-500 p-3 ml-5 mt-4 rounded-md">
            <a href="/createPost">
                Create Post
            </a>
        </button>
        <div class="flex flex-wrap justify-start">
            @foreach($posts as $post)
                <x-post :post="$post"></x-post>
            @endforeach
        </div>

    </x-app-layout>
@else
    <p> You need to sign in </p>
@endif
