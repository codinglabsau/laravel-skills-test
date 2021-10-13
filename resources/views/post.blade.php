@extends('layouts.layout')

@section('pagetitle', ' - Post '.((empty($post->post_id)) ? 'Add' : 'Edit'))

@section('content')


    <main>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="card main-card">
                        <div class="card-body">

                            <div class="row mb-5">
                                <div class="col-sm-10 col-12">
                                    <h5 class="card-title">Post {{ (empty($post->post_id)) ? 'Add' : 'Edit' }}</h5>
                                </div>
                            </div>


                            {!! Form::model($post, ['url' => url('posts/store'), 'id' => 'formpost', 'files' => true]) !!}
                                {!! Form::hidden('user_id', $user_id, ['id' => 'user_id']) !!}
                                {!! Form::hidden('post_id', null, ['id' => 'post_id']) !!}
                                {!! Form::hidden('deleteimage', 0, ['id' => 'deleteimage']) !!}

                                    <div class="">

                                        <h5 class="">{{ (empty($post->post_id)) ? 'Please fill in the below fields to add a new post' : 'Please modify the details below' }}</h5>

                                        <div class="row">
                                            <div class='form-group col-lg-6 col-xs-12'>
                                                <label for="name">Name <span class="text-danger">*</span></label>
                                                {!! Form::text('name', null, ['class' => 'form-control', 'id' => 'name']) !!}
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class='form-group col-lg-6 col-xs-12'>
                                                <label for="description">Description <span class="text-danger">*</span></label>
                                                {!! Form::textarea('description', null, ['class' => 'form-control post-description', 'id' => 'description', 'row' => '3']) !!}
                                            </div>
                                            <div class="form-group col-lg-6 col-xs-12">
                                                <label for="image">Image</label>
                                                <div class="input-group input-image-upload mb-3">
                                                    <div class="input-group-prepend imagethumb">
                                                        <img src="{{ $post->imagefilepath }}" alt="Post Image" class="user-img" />
                                                        @if($post->hasimage)
                                                            <a class="glyph-icon simple-icon-close remove-img" title="Remove" onclick="removePostPic();">X</a>
                                                        @endif
                                                    </div>
                                                    <div class="custom-file">
                                                        {!! Form::file('imagefile', ['id' => 'imagefile', 'class' => 'custom-file-input']) !!}
                                                        <label class="custom-file-label" for="imagefile">Choose file</label>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>

                                        <div class="text-right mt-5">
                                            <a class="btn btn-secondary ml10" href="{{url('/posts')}}">Cancel</a>
                                            {!! Form::button('Submit', ['id'=>'btnsubmit', 'type' => 'submit', 'class' => 'btn btn-primary ml10']) !!}
                                        </div>
                                    </div>

                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

@endsection
@section('page-scripts')
<script src="{{ asset('/js/post.js') }}"></script>
@endsection