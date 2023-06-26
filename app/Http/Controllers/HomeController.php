<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->only('index');                                      // seuls les invités non-connectés peuvent voir l'index ( inscription + connection )

        $this->middleware('auth')->only('home');                                        // seuls les visiteurs connectés peuvent voir la liste des messages 
    }

    public function index()                                                             // renvoyer la page d'accueil du site ( inscription + connexion )
    {
        return view('index');
    }

    public function home()                                                              // renvoyer la page home.balde.php avec tous les messages 
    {
        /* RECUPERATION DES MESSAGES
        =========================================================== */
        $posts = Post::with('user', 'comments')->latest()->paginate(10);             // je veux charger en + de mes posts : - les commentaires associés à chaque post ; - l'utilisateur qui a posté chaque post
        // dd($posts);                                                                  // je teste cette liste de messages

        // $posts = Post::all();                                                        // syntaxe de base : on récupère tous les messages            
        // dd($posts);                                                                  // je teste cette liste de messages

        // $posts = Post::latest()->get();                                              // syntaxe avec le + recent en 1er 
        // dd($posts);                                                                  // je teste cette liste de messages

        // $posts = Post::latest()->paginate(10);                                       // syntaxe avec le + rexent en 1er + la pagination
        // dd($posts);                                                                  // je teste cette liste de messages


        // $posts = Post::latest()->paginate(10);                                       // syntaxe avec le + rexent en 1er + la pagination
        // $posts->load('comments', 'user');                                            // je charge les relations souhaitées ( comme ci-dessus )
        // dd($posts);                                                                  // je teste cette liste de messages

        // $posts = Post::with('comments.user', 'user')->latest()->paginate(10);           // je veux charger en + l'utilisateur qui a posté chaque commentaire.
        // dd($posts);                                                                  // je teste cette liste de messages


        return view('home', compact('posts'));

    }
}
