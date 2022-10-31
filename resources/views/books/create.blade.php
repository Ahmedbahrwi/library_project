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
<form method="POST" action="{{route('post.create')}}" enctype="multipart/form-data">
    @csrf
    <div class="form-group">
      <input type="text" class="form-control"  placeholder="title" name="title" value="{{old('title')}}">
    </div>
   
   
    <div class="form-group">
      
      <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" placeholder="Description" name="desc">{{old('desc')}}"</textarea>
    </div>
    <div class="form-group">
      
      <input type="file" class="form-control-file"  name="img">
      
    </div>
    Select Categories:
    @foreach ($categories as $category )
    <div class="form-check">
      <input class="form-check-input" type="checkbox" value="{{$category->id}}" name="category_ids[]" id="defaultCheck1">
      <label class="form-check-label" for="defaultCheck1">
        {{$category->name}}
      </label>
    </div>
      
    @endforeach
    <br>
   
    <button type="submit" class="btn btn-primary">Submit</button>
  </form>
@endsection