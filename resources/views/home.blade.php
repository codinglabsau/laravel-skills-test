@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
            
                <?php echo "Form: " ?>
                <!-- <form class="" action="index.html" method='post'> -->
                <form class="" action="store" method="post">
                <!-- <form action="store" method="post"> -->
                    
                        {{ csrf_field() }}
                        <label for="name">Name: </label>
                        <input type="text" name="name" value="" placeholder="Name"> <br>

                        <label for="description">Description: </label>
                        <input type="text" name="description" value="" placeholder="Description"> <br>

                        <button type="submit" name="submit">Submit</button> <br>
                    </form>
                    

                <?php echo "<br>" ?>


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
    </div>
</div>
@endsection
