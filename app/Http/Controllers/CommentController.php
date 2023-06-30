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
            //'image' => 'nullable',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);                                                                                 

        Comment::create([                                                                      
            'content' => $request->content,                                                                                         
            'tags' => $request['tags'],                                                     
            //'image' => isset($request['image']) ? $request['image'] : null,                 
            'user_id' => Auth::user()->id, 
            'post_id' => $request['post_id'],
            'image' => isset($request['image']) ? uploadImage($request['image']) : "user.jpg",
        ]);

        return redirect()->route('home')->with('message', 'commentaire créé avec succès !');    
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

        $this->authorize('update', $comment);

        $request->validate([
            'content' => 'required|min:25|max:1000',
            'tags' => 'required|min:3|max:50',
            //'image' => 'nullable',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
    
        $comment->update([
            'content' => $request->content,
            'tags' => $request['tags'],  
            //'image' => isset($request['image']) ? $request['image'] : null,  
            'image' => isset($request['image']) ? uploadImage($request['image']) : "user.jpg", 
        ]);
    
        return redirect()->route('home')->with('message', 'commentaire modifié avec succès !');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Comment $comment)
    {

        $this->authorize('delete', $comment);

        $comment->delete();

        return redirect()->route('home')->with('message', 'commentaire supprimé avec succès !');
    }
}
