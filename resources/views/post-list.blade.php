@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Post</div>

                <div class="card-body">
                    @include('flash::message')

                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th> #</th>
                                <th> Name</th>
                                <th> description  </th>
                                <th> Image </th>
                                <th> Action </th>
                            </tr>
                        </thead>
                        <tbody>
                             @foreach($posts as $key => $post)
                              <tr>
                                  <td> {{$key + 1}} </td>
                                  <td> {{$post->name}} </td>
                                  <td> {{$post->description}} </td>
                                  <td> 
                                    @isset($post->image) 
                                        <img src="/storage/images/{{$post->image}}" height="100" width="100"> 
                                    @else
                                        No Image
                                    @endisset
                                    </td>
                                  <td class="text-center">
                                      <a href="{{ route('post.edit', $post->id) }}"
                                         class="btn btn-sm blue btn-outline" style="background: blue; color: #fff;">
                                        <i class="fa fa-edit"></i>
                                      </a>

                                        <form method="POST" action="{{ route('post.destroy', $post->id) }}" style="display: inline;">
                                            @csrf
                                            <input type="hidden" name="_method" value="DELETE">
                                            <button
                                              class="btn btn-sm red btn-outline" style="background: red; color: #fff;"
                                              title="Delete"
                                            >
                                            <i class="fa fa-trash-o"></i>
                                          </button>
                                        </form>
                                  </td>
                              </tr>
                             @endforeach
                       </tbody>
                    </table>
                    <hr>
                    <a href="{{ route('post') }}">Create Post</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
