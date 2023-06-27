<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)                                                 
    {                                                                                       
        $request->validate([                                                               
            'content' => 'required|min:25|max:1000',                                        
            'tags' => 'required|min:3|max:50',                                             
            'image' => 'nullable'
        ]);                                                                                 

        Comment::create([                                                                      
            'content' => $request->content,                                                                                         
            'tags' => $request['tags'],                                                     
            'image' => isset($request['image']) ? $request['image'] : null,                 
            'user_id' => Auth::user()->id, 
            'post_id' => $request['post_id'],
        ]);

        return redirect()->route('home')->with('message', 'Message créé avec succès !');    
    }   

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Comment $comment)
    {
        return view('comment/edit', ['comment' => $comment]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Comment $comment)
    {
        $request->validate([
            'content' => 'required|min:25|max:1000',
            'tags' => 'required|min:3|max:50',
            'image' => 'nullable'
        ]);
    
        $comment->update([
            'content' => $request->content,
            'tags' => $request['tags'],  
            'image' => isset($request['image']) ? $request['image'] : null,   
        ]);
    
        return redirect()->route('home')->with('message', 'Post modifié avec succès !');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Comment $comment)
    {
        $comment->delete();

        return redirect()->route('home')->with('message', 'Post supprimé avec succès !');
    }
}