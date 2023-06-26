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

    public function store(Request $request)                                                 // $request = les données qui viennent du formulaire
    {                                                                                       // $request['content'] = "salut les gars"
        $request->validate([                                                                // 1. VALIDATION DES DONNEES On valide les champs en precisant les critères attendus
            'content' => 'required|min:25|max:1000',                                        // 'name de l'input' => [critères]
            'tags' => 'required|min:3|max:50',                                             
            'image' => 'nullable'
        ]);                                                                                 // autre syntaxe possible : 'content' => ['required', min:25', 'max:1000']

        Post::create([                                                                      // 2. sauvegarde du message => va lancer un insert into en SQL => 3 syntaxes possibles pour accéder au contenu de $request
            'content' => $request->content,                                                 // syntaxe objet                                           
            'tags' => $request['tags'],                                                     // syntaxe tableau associatif
            'image' => isset($request['image']) ? $request['image'] : null,                 // autre syntaxe
            'user_id' => Auth::user()->id                                                   // j'accède à l'id du user connecté
        ]);

        return redirect()->route('home')->with('message', 'Message créé avec succès !');    // 3. on redirige vers l'accueil avec un message de succès
    }   

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
