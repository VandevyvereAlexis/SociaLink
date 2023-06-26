<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        return view('users/edit', ['user' => $user]);
    }


    // ===================== UPDATE : permet de valider les modifications effectuées ===================== //

    public function update(Request $request, User $user)
    {
        $request->validate([
            'pseudo' => 'required|max:40',
            'image' => 'nullable|string'
        ]);

        // on modifie les infos de l'utilisateur
        $user->pseudo = $request->input('pseudo');
        $user->image = $request->input('image');

        // on sauvegarde les changements en base de donées
        $user->save();

        // on redirige sur la page précédente
        return back()->with('message', 'Le compte à bien été modifié');
    }


    // ===================== DESTROY : pour supprimer l'utilisateur ===================== //

    public function destroy(User $user)
    {
        // on vérifie que c'est bien l'utilisateur connecté qui fait la demande de suppression
        // ( les id doivent être identiques )
        if (Auth::user()->id == $user->id) {
            $user->delete();
            return redirect()->route('index')->with('message', 'Le compte a bien été supprimé');
        } else {
            return redirect()->back()->withErrors(['erreur' => 'suppression du compte impossible']);
        }
    }
}
