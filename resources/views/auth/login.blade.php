@extends('layout')

@section('title')
  Register
@endsection
@section('content')
@if ($errors->any())
<div class="alert alert-danger">
  @foreach ($errors->all() as $error )
  <p>{{$error}}</p>
    
  @endforeach

</div>
  
@endif
<form method="POST" action="{{route('auth.handleLogin')}}" enctype="multipart/form-data">
    @csrf
    <div class="form-group">
        <input type="texts" class="form-control"  placeholder="Email" name="email" value="{{old('pass')}}">
    </div>

      <div class="form-group">
        <input type="password" class="form-control"  placeholder="password" name="pass" value="{{old('name')}}">
      </div>
    <button type="submit" class="btn btn-primary">Submit</button>
    <a href="{{route('auth.github.redirect')}}" class="btn btn-success">Sing Up With Github</button>
  </form>
@endsection