<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // seuls les invités non-connectés peuvent voir l'index ( inscription + connection )
        $this->middleware('guest')->only('index');

        // seuls les visiteurs connectés peuvent voir la liste des messages 
        $this->middleware('auth')->only('home');
    }

    public function index() // renvoyer la page d'accueil du site ( inscription + connexion )
    {
        return view('index');
    }

    public function home() // renvoyer la page home.balde.php avec tous les messages 
    {
        return view('home');
    }
}
