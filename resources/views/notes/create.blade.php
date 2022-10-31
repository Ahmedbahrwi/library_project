@extends('layout')

@section('title')
   Create Book
@endsection
@section('content')
@if ($errors->any())
<div class="alert alert-danger">
  @foreach ($errors->all() as $error )
  <p>{{$error}}</p>
    
  @endforeach

</div>
  
@endif
<form method="POST" action="{{route('notes.store')}}" enctype="multipart/form-data">
    @csrf
    <div class="form-group">
      <input type="text" class="form-control"  placeholder="content" name="content" value="{{old('content')}}">
    </div>

    <button type="submit" class="btn btn-primary">Submit</button>
  </form>
@endsection