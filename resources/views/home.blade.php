@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header d-flex align-items-center justify-content-between">
                    <h3>{{ $user->name }} Posts</h3>

                    <a href="#" class="btn btn-primary btn-sm"> New Post </a>
                </div>

                    <div class="card-body">
                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">
                                    <a href="{{ route('home', ['sort' => 'name', 'direction' => $direction == 'asc' ? 'desc': 'asc']) }}">
                                        Name
                                    </a>
                                    @if($sort == 'name')
                                        @if($direction == 'asc')
                                            <i class="fas fa-sort-up"></i>
                                        @else
                                            <i class="fas fa-sort-down"></i>
                                        @endif
                                    @endif
                                </th>
                                <th scope="col">
                                    <a href="{{ route('home', ['sort' => 'description', 'direction' => $direction == 'asc' ? 'desc': 'asc']) }}">
                                        Description
                                    </a>
                                    @if($sort == 'description')
                                        @if($direction == 'asc')
                                            <i class="fas fa-sort-up"></i>
                                        @else
                                            <i class="fas fa-sort-down"></i>
                                        @endif
                                    @endif
                                </th>
                                <th scope="col">
                                    <a href="{{ route('home', ['sort' => 'created_at', 'direction' => $direction == 'asc' ? 'desc': 'asc']) }}">
                                        Created
                                    </a>
                                    @if($sort == 'created_at')
                                        @if($direction == 'asc')
                                            <i class="fas fa-sort-up"></i>
                                        @else
                                            <i class="fas fa-sort-down"></i>
                                        @endif
                                    @endif
                                </th>
                                <th scope="col"></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($posts as $post)
                                <tr>
                                    <th scope="row">{{ $loop->index + 1 }}</th>
                                    <td>{{ $post->name  }}</td>
                                    <td>{{ $post->shorten }}</td>
                                    <td>{{ $post->created }}</td>
                                    <td></td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer">
                        {{ $posts->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
