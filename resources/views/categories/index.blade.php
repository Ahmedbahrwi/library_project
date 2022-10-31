@extends('layout')



@section('content')
<h1>All Categories</h1>
@foreach ($categories as $category )
<hr>
<h3>{{ $category->name }}</h3>


    
@endforeach

@endsection