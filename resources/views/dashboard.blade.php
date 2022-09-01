<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white rounded shadow-md ring-1 ring-gray-900/10">
                <div class="p-6 bg-white border-b border-gray-200">
                    You're logged in!
                </div>
            </div>
        </div>

        <br>
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="container mx-auto">
                <div class="grid grid-cols-1 gap-6 md:grid-cols-2 lg:grid-cols-2">
                  <div class="flex justify-center border-2 border-gray-300 rounded-l bg-white-100">
                    <div class="w-full px-6 py-4 bg-white rounded shadow-md ring-1 ring-gray-900/10">

                        <!-- Edit -->
                        @if(isset($post))
                            @include('posts.edit_post')
                        <!-- Create -->
                        @else
                            @include('posts.new_post')
                        @endif
                      
                    </div>
                  </div>
                  <div class="flex justify-center border-2 border-gray-300 rounded-l bg-white-100">
                    <div class="w-full px-6 py-4 bg-white rounded shadow-md ring-1 ring-gray-900/10">

                        <!-- Flash message -->
                        @if(session('success_table'))  
                            <div class="p-4 mb-4 text-sm text-green-700 bg-green-100 rounded-lg dark:bg-green-200 dark:text-green-800" role="alert">
                                <span class="font-medium"><b>{{session('success_table')}}</b></span>
                            </div>
                        @endif

                        <h2 class="text-2xl">Your Posts</h2>
                        <br>

                        <table class="border border-none" style="width:100%">
                            <tbody>
                                @forelse ($posts as $post)
                                    <tr>
                                        <td style="min-width:200px">{{ucfirst($post->name)}}</td>
                                        <td>

                                            <form action="{{ route('posts.destroy',['post' => $post->id]) }}" method="post">
                                                @csrf
                                                @method('delete')
                                                <a href="{{ route('posts.show',['post' => $post->id]) }}" class="px-4 py-2 mb-1 mr-1 text-xs font-bold text-white uppercase transition-all duration-150 ease-linear bg-blue-500 rounded shadow outline-none active:bg-blue-600 hover:shadow-md focus:outline-none" type="button">
                                                    <i class="fa-solid fa-eye"></i> View
                                                </a>
                                                <a href="{{ route('posts.edit',['post' => $post->id]) }}" class="px-4 py-2 mb-1 mr-1 text-xs font-bold text-white uppercase transition-all duration-150 ease-linear rounded shadow outline-none bg-cyan-500 active:bg-cyan-600 hover:shadow-md focus:outline-none" type="button">
                                                    <i class="fas fa-edit"></i> Edit
                                                </a>
                                                <button type="submit" class="px-4 py-2 mb-1 mr-1 text-xs font-bold text-white uppercase transition-all duration-150 ease-linear bg-red-500 rounded shadow outline-none active:bg-red-600 hover:shadow-md focus:outline-none" type="button">
                                                    <i class="fas fa-trash"></i> Delete
                                                </button>
                                            </form>

                                        </td>
                                    </tr> 
                                @empty
                                    <tr>
                                        <td colspan="2">Currently no posts</td>
                                    </tr> 
                                @endforelse
                            </tbody>
                        </table>

                    </div>
                  </div>
                </div>
            </div>
        </div>

    </div>
</x-app-layout>
