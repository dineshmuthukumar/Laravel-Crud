@extends('users.layout')
 

 @if(session()->has('message'))
    <div class="alert alert-success">
        {{ session()->get('message') }}
    </div>
@endif

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>User Details</h2>
            </div>
            <div class="pull-right">
               <!--  -->
               <a class="btn btn-success" href="{{url()->previous()}}"> Back</a>
            </div>
        </div>
    </div>
   
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif
   
    <table class="table table-bordered">
        <tr>
            <tr><td>Name</td><td>{{$data->name}}</td></tr>
            <tr><td>Profile Picture</td><td> <img src='{{URL::asset("uploads/$data->profile_picture")}}' ></td></tr>
            <tr><td>email</td><td>{{$data->email}}</td></tr>
            <tr><td>Phone</td><td>{{$data->phone}}</td></tr>
        </tr>
        
    </table>

      
@endsection