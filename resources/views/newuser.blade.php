@extends('layouts/app')
@section('content')
    <div class="container">
        <h2 style="text-align: center;">Users Information</h2>
        <a href="{{route('displayform')}}" class="btn btn-primary btn-sm">Add new user</a>
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Age</th>
                    <th>City</th>
                    <th>Image</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $users=>$user)
                <tr>
                    <td>{{$user->id}}</td>
                    <td>{{$user->name}}</td>
                    <td>{{$user->email}}</td>
                    <td>{{$user->age}}</td>
                    <td>{{$user->city}}</td>
                    <td><img src="{{ asset('images/'.$user->image_path)}}" alt="" style="width:80px;height:80px;"></td>
                    <td><a href="{{route('user',$user->id)}}" class="btn btn-primary btn-sm">View</a></td> 
                    <td><a href="{{route('fetchdata.user', $user->id)}}" class="btn btn-success btn-sm">Update</a></td>
                    <td> 
                      <button onclick="document.getElementById('id01').style.display='block'" class="btn btn-danger btn-sm">Delete</button>

                      <div id="id01" class="modal">
                          <span onclick="document.getElementById('id01').style.display='none'" class="close" title="Close Modal">&times;</span>
                          <form class="modal-content">
                              <div class="container">
                                  <h1>Delete Account</h1> 
                                  <p>Are you sure you want to delete your account?</p>

                                  <div class="clearfix">
                                      <button type="button" onclick="document.getElementById('id01').style.display='none'" class="btn btn-secondary btn-sm">Cancel</button>
                                      <a href="{{ route('delete.user', $user->id) }}" class="btn btn-danger btn-sm">Delete</a>
                                  </div>
                              </div>
                          </form>
                      </div>
                  </td>
                    
                </tr>
                @endforeach
            </tbody>
        </table>
        {{-- <div>
            {{$data->links('pagination::bootstrap-4')}}
        </div> --}}
    </div>
@endsection