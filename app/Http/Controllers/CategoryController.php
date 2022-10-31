<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    //function to show all Caregories 
    public function index(){
        $categories=Category::get();
        return view('categories.index',compact('categories'));

    }
    //function used to show only category by id
    public function show($id){
        $category=Category::FindOrFail($id);
        return view('categories.show',compact('category'));
    }
    //function to showcreatation form
    public function create(){
        return view('categories.create');
    }
    //function used to store in DB
    public function store(request $request){
        $request->validate([
            'name'=>'required|string|max:100',
           
        ]);
      
        Category::create([
            'name'=>$request->name,
            
        ]);
        
        return redirect(route('category.index'));
    }
    //function to show edit form 
    public function edit($id){
        //find_or_fail() function check if id exist or not
        $category=Category::FindOrFail($id);
        return view('categories.edit',compact('category'));
    }
    //function make update on specific category
    public function update(request $request,$id ){
        $request->validate([
            'name'=>'required|string|max:100',
           
           
        ]);
        $category=Category::FindOrFail($id);
        
     
        $category->update([
            'name'=>$request->name,
            
            
        ]);
        
        return redirect(route('category.index',$id));
    }
    //function used to delete category
    public function delete($id){
       $category=Category::FindOrFail($id);
      
       $category->delete();
        return redirect(route('category.index'));
    }
    //
}

