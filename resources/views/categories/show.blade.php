@extends('layout')



@section('content')

<h1>Category ID:{{$category->id}}</h1>
<h3>{{$category->name}}</h3>
<h3>Books</h3>
<ul>
@foreach ($category->books as $book )
<li>{{$book->title}}</li>
@endforeach
</ul>

<hr>


<a href="{{route('category.index') }}">Back</a>

@endsection