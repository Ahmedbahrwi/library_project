<?php

namespace App\Http\Controllers;

use App\Models\Note;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NoteController extends Controller
{
    //function used to show form
    public function create()
    {
        return view('notes.create');
    }
    //function used to store note
    public function store(Request $request)
    {
        $request->validate([
            'content'=>'required|string|max:100',
            

        ]);
        Note::create([
            'content'=>$request->content,
            'user_id'=>Auth::user()->id,
        ]);
        return redirect(route('get.index'));
    }
    //
}
