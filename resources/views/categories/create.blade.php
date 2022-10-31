@extends('layout')

@section('title')
   Create Category
@endsection
@section('content')
@if ($errors->any())
<div class="alert alert-danger">
  @foreach ($errors->all() as $error )
  <p>{{$error}}</p>
    
  @endforeach

</div>
  
@endif
<form method="POST" action="{{route('categor.create')}}" enctype="multipart/form-data">
    @csrf
    <div class="form-group">
      <input type="text" class="form-control"  placeholder="name" name="name" value="{{old('name')}}">
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
  </form>
@endsection