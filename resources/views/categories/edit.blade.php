@extends('layout')

@section('title')
   Edit Category - {{$category->name}}
@endsection
@section('content')
@include('inc.errors')
<form method="POST" action="{{route('category.update',$category->id)}}" enctype="multipart/form-data">
    @csrf
    <div class="form-group">
      <input type="text" class="form-control"  placeholder="title" name="name" value="{{old('name') ?? $category->name}}">
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
  </form>
@endsection