<h2 class="text-2xl">Edit Post</h2>
<br>
<!-- Flash message -->
@if(session('success'))  
    <div class="p-4 mb-4 text-sm text-green-700 bg-green-100 rounded-lg dark:bg-green-200 dark:text-green-800" role="alert">
        <span class="font-medium"><b>{{session('success')}}</b></span>
    </div>
@endif

<!-- Form -->
<form method="POST" action="{{ route('posts.update',['post' => $post->id]) }}" enctype="multipart/form-data">
    @csrf
    @method('put')

    <!-- Name -->
    <div>
        <label class="block text-sm font-medium text-gray-700" for="name">
            Name
        </label>

        <input
            class="block w-full mt-1 border-gray-300 rounded-md shadow-sm placeholder:text-gray-400 placeholder:text-right focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
            type="text" name="name" placeholder="Name of post" value="{{old('name',$post->name)}}" autofocus>
        @error('name')
        <span class="text-sm text-red-600">
            {{ $message }}
        </span>
        @enderror
    </div>

    <!-- Description -->
    <div class="mt-4">
        <label class="block text-sm font-medium text-gray-700" for="description">
            <b>Description</b>
        </label>
        <textarea name="description"
            class="block w-full mt-1 border-gray-300 rounded-md shadow-sm placeholder:text-gray-400 placeholder:text-right focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
            rows="4" placeholder="Description of post"> {{old('description',$post->description)}}</textarea>
        @error('description')
        <span class="text-sm text-red-600">
            {{ $message }}
        </span>
        @enderror
    </div>

    <!-- Image -->
    <div class="mt-4">
        <label class="block text-sm font-medium text-gray-700" for="image">
            <b>Image</b>
        </label>
        @isset($post->image)
            <img src="/images/{{$post->image}}" style="max-width:400px;width:100%">
        @endisset
        <input type="file" name="image" accept="image/*">
        <br>
        @error('image')
        <span class="text-sm text-red-600">
            {{ $message }}
        </span>
        @enderror
    </div>

    <div class="flex items-center justify-start mt-4">
        <button type="submit"
            class="inline-flex items-center px-6 py-2 text-sm font-semibold rounded-md text-sky-100 bg-sky-500 hover:bg-sky-700 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300">
            Update
        </button>
    </div>
</form>