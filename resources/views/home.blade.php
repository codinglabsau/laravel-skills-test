@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
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
          <br>
          <form method="post" action="{{url('add_post')}}">
             @csrf
               @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
               <div class="row">
                <div class="col-md-12">  </div>
                <div class="form-group col-md-12">
                  <label for="Name">Name:</label>
                  <input type="text" class="form-control" name="name">
                </div>
              </div>
              <div class="row">
               <div class="col-md-12"></div>
               <div class="form-group col-md-12">
                 <label for="Description">Description:</label>
                 <textarea name="description" class="form-control"></textarea>
               </div>
             </div>
              <div class="row">
                <div class="col-md-12"></div>
                <div class="form-group col-md-12" style="margin-top:10px">
                  <button type="submit" class="btn btn-success">Submit</button>
                </div>
                <br>
                <?php if (session()->has('success')): ?>
                  {{session()->get('success')}}
                <?php endif; ?>
              </div>
          </form>
        </div>
    </div>
</div>
@endsection
