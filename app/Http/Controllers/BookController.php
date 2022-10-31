<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;
use Illuminate\Http\Request;


class BookController extends Controller
{
    //function to show all books 
    public function index(){
        $books=Book::get();
        return view('books.index',compact('books'));

    }
    //fuction to show only book by id
    public function show($id){
        $book=Book::FindOrFail($id);
        return view('books.show',compact('book'));
    }

    public function create(){
        $categories=Category::select('id','name')->get();
        return view('books.create',compact('categories'));
    }
    //function used to store data that get from form
    public function store(request $request){
        //make validate on data 
        $request->validate([
            'title'=>'required|string|max:100',
            'desc'=>'required|string',
            'img'=>'required|image|mimes:png,jpg',
            'category_ids'=>'required',
            'category_ids.*'=>'exists:categories,id',

        ]);
        $img=$request->file('img');
            //make new extension for image
        $exe=$img->getClientOriginalExtension();
        //give a new unique name for image
        $name="book-". uniqid() . ".$exe";
        $img->move(public_path('uploads/books') , $name);
        $book=Book::create([
            'title'=>$request->title,
            'desc'=>$request->desc,
            'img'=>$name,
        ]);
        $book->categories()->sync($request->category_ids);
        
        return redirect(route('get.index'));
    }
    //fuction used to make edit and show edit form 
    public function edit($id){
        $book=Book::FindOrFail($id);
        return view('books.edit',compact('book'));
    }
    //function to make update on data that store in DB
    public function update(request $request,$id ){
        $request->validate([
            'title'=>'required|string|max:100',
            'desc'=>'required|string',
            'img'=>'nullable|image|mimes:png,jpg',
           
        ]);
        $book=Book::FindOrFail($id);
        $old_name=$book->img;
        if($request->hasFile('img')){
            if($old_name!==null)
            {
                unlink(public_path('uploads/books/').$old_name);
            }
            $img=$request->file('img');
            //make new extension for image
        $exe=$img->getClientOriginalExtension();
        //give a new unique name for image
        $name="book-". uniqid() . ".$exe";
        $img->move(public_path('uploads/books/') , $name);

        }
        $book->update([
            'title'=>$request->title,
            'desc'=>$request->desc,
            'img'=>$name,
            
        ]);
        
        return redirect(route('get.index',$id));
    }
    //function used to delete book by id
    public function delete($id){
       $book=Book::FindOrFail($id);
       if($book->img !== null){
        unlink(public_path('uploads/books/').$book->img);
       }
       $book->delete();
        return redirect(route('get.index'));
    }
    //function used to make real time search
    public function search(Request $request)
    {
        $keyword =$request->keyword;
        $books=Book::where('title','like',"%$keyword%")->get();
        return response()->json($books);
    }
    //
}
