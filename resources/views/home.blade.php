@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    You are logged in!
                </div>
            </div>
        </div>



        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Add New Post (with server side validation)</div>

                <div class="card-body">

                  @if(Session::has('success'))
                      <div class="alert alert-success" role="alert">
                           <strong>Success: </strong>{{ Session::get('success')}}
                      </div>
                  @endif

                  @if(count($errors)>0)
                      <div class="alert alert-danger" role="alert">
                           <strong>Errors: </strong>
                           <ul>
                             @foreach ($errors->all() as $error)
                               <li>{{ $error}}</li>
                             @endforeach
                           </ul>
                      </div>
                  @endif

                  <!-- note: the form below will only do server side validation -->

                  {!! Form::open(array('route' => 'home.store')) !!}
                        {{  Form::label('name', 'Name') }}
                        {{  Form::text('name', null, array('class' => 'form-control')) }}

                        {{  Form::label('description','Description') }}
                        {{  Form::textarea('description', null, array('class' => 'form-control')) }}

                        {{  Form::submit('Add Post', array('class' => 'btn btn-success btn-lg btn-block', 'style' => 'margin-top:20px;')) }}
                  {!! Form::close() !!}



                </div>
            </div>
        </div>



        <div class="col-md-8 offset-4" style="margin-top:50px;">
            <div class="card">
                <div class="card-header">Add New Post (w/ client and server side validation)</div>

                <div class="card-body">

                  @if(Session::has('success'))
                      <div class="alert alert-success" role="alert">
                           <strong>Success: </strong>{{ Session::get('success')}}
                      </div>
                  @endif

                  @if(count($errors)>0)
                      <div class="alert alert-danger" role="alert">
                           <strong>Errors: </strong>
                           <ul>
                             @foreach ($errors->all() as $error)
                               <li>{{ $error}}</li>
                             @endforeach
                           </ul>
                      </div>
                  @endif

                  <!-- note: the form below will also do client side validation together with server side validation -->

                  {!!  Form::open(array('route' => 'home.store','data-parsley-validate' => '')) !!}
                        {{  Form::label('name', 'Name') }}
                        {{  Form::text('name', null, array('class' => 'form-control', 'required' => '', 'maxlength' => '200')) }}

                        {{  Form::label('description','Description') }}
                        {{  Form::textarea('description', null, array('class' => 'form-control', 'required' => '')) }}

                        {{  Form::submit('Add Post', array('class' => 'btn btn-success btn-lg btn-block', 'style' => 'margin-top:20px;')) }}
                  {!! Form::close() !!}



                </div>
            </div>
        </div>


    </div>
</div>
@endsection



@section('stylesheets')
  {!! Html::style('css/parsley.css') !!}
@endsection

@section('scripts')
  {!! Html::script('js/parsley.min.js') !!}
@endsection
