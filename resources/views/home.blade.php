<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create a New Post') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form method="POST" action="{{ route('post.store') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="mt-4 max-w-md mx-auto">
                            <div class="grid grid-cols-1 gap-6 mt-">

                                <div>
                                    <x-label for="name" :value="__('Name')" />

                                    <x-input id="name" class="block mt-1 w-full" type="text" name="name" required autofocus />
                                </div>

                                <div>
                                    <x-label for="description" :value="__('Description')" />

                                    <x-textarea id="description" class="block mt-1 w-full" name="description" rows="5" required />
                                </div>

                                <div>
                                    <x-label for="image" :value="__('Upload Image')" />

                                    <x-input-file id="image" class="block mt-1 w-full" type="file" name="image" />

                                </div>

                                <div class="flex items-center justify-end">

                                    <x-button class="max-w-fit">

                                        {{ __('Create Post') }}

                                    </x-button>   

                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
