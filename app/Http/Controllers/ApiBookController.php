<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class ApiBookController extends Controller
{
     //function to show all books 
    public function index()
    {
        $book=Book::get();
        return response()->json($book);
    }
    //fuction to show only book by id
    public function show($id){
        $book=Book::with('categories')->FindOrFail($id);
        return response()->json($book);
    }
     //function used to store data that get from form
    public function store(request $request){
       /* $request->validate([
            

        ]);*/
        $validator = Validator::make($request->all(), [
            'title'=>'required|string|max:100',
            'desc'=>'required|string',
            'img'=>'required|image|mimes:png,jpg',
            'category_ids'=>'required',
            'category_ids.*'=>'exists:categories,id',
        ]);
        if ($validator->fails()) {
           $errore=$validator->errors();
           return response()->json($errore);
        }
 
 
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
        $success="The Book Create Success";

        
        return response()->json($success);
    }
     //function to make update on data that store in DB
    public function update(request $request,$id ){
        $validator = Validator::make($request->all(), [
            'title'=>'required|string|max:100',
            'desc'=>'required|string',
            'img'=>'required|image|mimes:png,jpg',
            'category_ids'=>'required',
            'category_ids.*'=>'exists:categories,id',
        ]);
        if ($validator->fails()) {
           $errore=$validator->errors();
           return response()->json($errore);
        }
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
        $book->categories()->sync($request->category_ids);
        $success="The Book update Success";

        
        return response()->json($success);
    }
    //function used to delete book by id
    public function delete($id){
        $book=Book::FindOrFail($id);
        if($book->img !== null){
         unlink(public_path('uploads/books/').$book->img);
        }
        $book->categories()->sync([]);
        $book->delete();
        $success="The Book Deleted Success";

        
        return response()->json($success);
     }
    //
}
