<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{

    /**
     * Store a newly created resource in storage.
     * 
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */

    public function store(Request $request)                                                     // $request = les données qui viennent du formulaire
    {                                                                                           // $request['content'] = "salut les gars"
        $request->validate([                                                                    // 1. VALIDATION DES DONNEES On valide les champs en precisant les critères attendus
            'content' => 'required|min:25|max:1000',                                            // 'name de l'input' => [critères]
            'tags' => 'required|min:3|max:50',
            //'image' => 'nullable',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);                                                                                     // autre syntaxe possible : 'content' => ['required', min:25', 'max:1000']

        Post::create([                                                                          // 2. sauvegarde du message => va lancer un insert into en SQL => 3 syntaxes possibles pour accéder au contenu de $request
            'content' => $request->content,                                                     // syntaxe objet                                           
            'tags' => $request['tags'],                                                         // syntaxe tableau associatif
            //'image' => isset($request['image']) ? $request['image'] : null,                   // autre syntaxe
            'user_id' => Auth::user()->id,                                                      // j'accède à l'id du user connecté
            'image' => isset($request['image']) ? uploadImage($request['image']) : "user.jpg",
        ]);

        return redirect()->route('home')->with('message', 'Message créé avec succès !');        // 3. on redirige vers l'accueil avec un message de succès
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        return view('post/edit', ['post' => $post]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {

        $this->authorize('update', $post);

        $request->validate([
            'content' => 'required|min:25|max:1000',
            'tags' => 'required|min:3|max:50',
            'image' => 'nullable'
        ]);

        $post->update([
            'content' => $request->content,
            'tags' => $request['tags'],
            'image' => isset($request['image']) ? $request['image'] : null,
        ]);

        return redirect()->route('home')->with('message', 'Post modifié avec succès !');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        
        $this->authorize('delete', $post);

        $post->delete();

        return redirect()->route('home')->with('message', 'Post supprimé avec succès !');
    }



    public function search(Request $request)
    {

        $request->validate([
            'search' => 'required|min:1|max:1000'
        ]);

        $search = trim($request->input('search'));

        $posts = Post::where('tags', 'like', "%{$search}%")
            ->orWhere('content', 'like', "%{$search}%")
            // ->get();
            ->paginate(10);                                                                     // Utiliser paginate() à la place de get()

        return view('home')->with('posts', $posts);
    }
}
