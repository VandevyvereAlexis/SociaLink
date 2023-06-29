<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


/* page de connexion / inscription 
-------------------------------------------------------------------------------------- */
Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('index');                              // route:: méthode http ( url, [ emplacement du contrôleur concerné, méthode du crtl concerné ]) -> nom de la route




/* ACCUEIL ( home.blade.php ) / liste des messages 
-------------------------------------------------------------------------------------- */
Route::get('/home', [App\Http\Controllers\HomeController::class, 'home'])->name('home');




/* routes AUTHENTIFICATION ( Laravel UI )
-------------------------------------------------------------------------------------- */
Auth::routes();                                                                                                     // Avec ça Laravel UI va générer toutes ses routes necessaire




/* routes resource USERS 
-------------------------------------------------------------------------------------- */
Route::resource('/users', App\Http\Controllers\UserController::class)->except('index', 'create', 'store');          // pour déclarer les route une par une individuellement





/* routes resource POST 
-------------------------------------------------------------------------------------- */
Route::resource('/post', App\Http\Controllers\PostController::class)->except('index', 'create', 'show'); 




/* routes resource COMMENT 
-------------------------------------------------------------------------------------- */
Route::resource('/comment', App\Http\Controllers\CommentController::class)->except('index', 'create', 'show'); 




/* routes resource POST 
-------------------------------------------------------------------------------------- */
Route::get('/search', [App\Http\Controllers\PostController::class, 'search'])->name('search'); 