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
               <a class="btn btn-success" href="{{ ('create') }}"> Create New User</a>
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
            <th>No</th>
            <th>Name</th>
            <th>Email</th>
            <th>Profile Picture</th>
            <th>Edit</th>
            <th>View</th>
            <th>Delete</th>
        </tr>
        @foreach ($User as $Users)
        <tr>
            <td>{{ ++$i }}</td>
            <td>{{ $Users->name }}</td>
            <td>{{ $Users->email }}</td>
          <?php  $image  = public_path() . '/uploads/'.$Users->profile_picture; ?>
            <td>  <img src='{{URL::asset("uploads/$Users->profile_picture")}}' alt="Italian Trulli"> </td>
            <td>

                <a class="btn btn-primary btn-sm"
                    href="{{ URL::to('user/' . $Users->id . '/edit') }}"
                    >Edit</a>
                </td>

                <td> <a class="btn btn-success btn-sm"
                    href="{{ URL::to('user/' . $Users->id . '/view') }}"
                    >View</a></td>

              

                  <td>  <form action="{{ URL::to('user/' . $Users->id . '/delete') }}" method="post">
                     {{ method_field('DELETE') }}
                     {{ csrf_field() }}
                    <input type="submit"  class="btn btn-danger btn-sm" value="delete " >
                    </form>
                
            </td>
        </tr>
        @endforeach
    </table>

      
@endsection