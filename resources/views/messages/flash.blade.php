@if ($message = Session::get('success'))
<div class="p-4 mx-auto mb-4 text-sm text-blue-700 bg-blue-100 rounded-lg max-w-7xl dark:bg-blue-200 dark:text-blue-800" role="alert">
    {{ $message }}
</div>
@endif

@if ($message = Session::get('exception'))
<div class="p-4 mx-auto mb-4 text-sm text-red-700 bg-red-100 rounded-lg max-w-7xl dark:bg-red-200 dark:text-red-800" role="alert">
    {{ $message }}
</div>
@endif