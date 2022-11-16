<x-app-layout>

    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Posts') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="max-w-md mx-auto mt-4">

                        <h2 class="text-xl font-bold">Create New Post</h2>

                        <form method="POST" action="{{ route('post.store') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="mt-1">
                                <x-label for=" name" :value="__('Title')" />
                                <x-input id="name" class="block w-full" type="text" name="name" required autofocus />
                            </div>

                            <div class="mt-4">
                                <x-label for=" description" :value="__('Description')" />
                                <x-textarea id="description" class="block w-full" name="description" rows="5" required />
                            </div>

                            <div class="mt-4">
                                <x-label for="image" :value="__('Upload Image')" />
                                <x-input-file id="image" class="block w-full" name="image" />
                            </div>

                            <div class="flex items-center justify-end mt-4">
                                <x-button class="ml-3">
                                    {{ __('Create') }}
                                </x-button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>