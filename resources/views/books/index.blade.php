@extends('layout')



@section('content')
<input type="text" id="keyword">
@auth
    <h1>Notes</h1>
    @foreach (Auth::user()->notes as $note )
        <p>{{$note->content}}
    @endforeach
    <a href="{{route('notes.create')}}" class="btn btn-info">Add New Note</a>
@endauth
<h1>All Books</h1>
@foreach ($books as $book )
<hr>
<h3>{{ $book->title }}</h3>
<p>{{ $book->desc }}</p>

    
@endforeach

@endsection
@section('scripts')
<script>
    $('#keyword').keyup(function(){
        let keyword=$(this).val()
        let url="{{ route('get.search') }}"+"?keyword=" + keyword
        //console.log('keyword');
        $.ajax({
            type:"GET",
            url:url,
            contentType:false,
            processData:false,
            success:function(data)
            {
                for(book of data)
                {
                    $('#allBooks').empty()
                    $('#allBooks').append(`<h3>${book.title}</h3>
                    <p>${book.desc}</p>
                    `)
                }
            }
        })
    })
</script>
@endsection