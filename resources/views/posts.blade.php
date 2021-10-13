@extends('layouts.layout')

@section('pagetitle', ' - Dashboard')

@section('content')

    <main>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="card main-card">
                        <div class="card-body">

                            <div class="row mb-5">
                                <div class="col-sm-10 col-12">
                                    <h5 class="card-title">Posts</h5>
                                </div>
                            </div>

                            <div class="row mb-1">
                                <div class="col-sm-10 col-12">
                                    <div class="mb-2 mt-2">
                                        {!! Form::open(['url' => url('posts/load'), 'id' => 'searchform', 'class' => 'input-group input-group-sm']) !!}
                                        <div class="d-block d-md-inline-block">
                                            <div class="search-sm d-inline-block float-md-left mr-1 mb-1 align-top">
                                                <input class="form-control" name="search" title="Search by name, description" id="searchtextbox" data-toggle="tooltip" placeholder="search">
                                            </div>
                                        </div>
                                        {!! Form::close() !!}
                                    </div>
                                </div>
                            </div>

                            <div class="row ">
                                <div class="col-12">
                                    <div class="table-responsive">
                                        <table class="table table-hover verticle-middle" id="useremail-table">
                                            <thead class="thead-light">
                                                <tr>
                                                    <th class="field_no" scope="col">#</th>
                                                    <th class="width100" scope="col">Image</th>
                                                    <th scope="col">Name</th>
                                                    <th scope="col">Description</th>
                                                    <th class="width130" scope="col">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody id="tabledata"></tbody>
                                        </table>
                                    </div>
                                    <div class="text-right mb-5">
                                        <a href="{{url('posts/add')}}" class="btn btn-dark btn-xs default mb-1">Create New</a>
                                    </div>
                                </div>
                                
                            </div>

                                       
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
@section('page-scripts')
<script src="{{ asset('/js/posts.js') }}"></script>
@endsection