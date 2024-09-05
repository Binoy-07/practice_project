@extends('layouts/app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-4 offset-4">
                <h1>Add new user</h1>
                <form action="{{route('add.user')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" name="name" id="name" class="form-control" autocomplete="off">
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" name="email" id="email" class="form-control" autocomplete="off">
                    </div>
                    <div class="form-group">
                        <label for="age">Age</label>
                        <input type="number" name="age" id="age" class="form-control" autocomplete="off">
                    </div>
                    <div class="form-group">
                        <label for="city">City</label>
                        <input type="text" name="city" id="city" class="form-control" autocomplete="off">
                    </div>
                    <div class="form-group">
                         <label class="form-label" for="inputImage">Image:</label>
                         <input 
                             type="file" 
                             name="image" 
                             id="inputImage"
                             class="form-control @error('image') is-invalid @enderror">
                             @error('image')
                                <span class="text-danger">{{ $message }}</span>
                             @enderror
                    </div>
                    <br>
                    <button type="submit" class="btn btn-primary">Save</button>

                </form>
                
            </div>
        </div>
    </div>
    
@endsection