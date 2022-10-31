@extends('layout')

@section('title')
   Edit Book - {{$book->title}}
@endsection
@section('content')
@include('inc.errors')
<form method="POST" action="{{route('post.update',$book->id)}}" enctype="multipart/form-data">
    @csrf
    <div class="form-group">
      <input type="text" class="form-control"  placeholder="title" name="title" value="{{old('title') ?? $book->title}}">
    </div>
   
   
    <div class="form-group">
      
      <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" placeholder="Description"  name="desc">{{$book->desc}}</textarea>
    </div>
    <div class="form-group">
      
      <input type="file" class="form-control-file"  name="img">
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
  </form>
@endsection