@extends('layout.app')

<!-- section content -->
@section('content')



    <!-- SI RECHERCHE
    =================================================================================================================== -->
    @if (Route::currentRouteName() == 'search')

        @if (count($posts) == 0)

            <!-- container-fluid "affichage aucun resultat pour la recherche" -->
            <div class="container-fluid d-flex align-items-center justify-content-center" id="home_top" style="background-image: linear-gradient(to right, #0000001c, #00000000), url('../images/image_fond_2.jpg')">
                <div class="row no-gutters justify-content-center text-center">
        
        @else

            <div class="d-none"></div>
        
        @endif

    <!-- sinon -->
    @else

        <!-- container-fluid -->
        <div class="container-fluid" id="home_top" style="background-image: linear-gradient(to right, #0000001c, #00000000), url('../images/image_fond.jpg')">
            <div class="row no-gutters justify-content-center text-center">
    
    @endif



                <!-- MESSAGES "SUCCESS" / "ERROR"
                =================================================================================================================== -->
                @if (Route::currentRouteName() == 'search')
                    <div class="d-none"></div>
                @else
                    <div class="container w-50 text-center p-3 mt-5">

                        <!-- "succes" -->
                        @if (session()->has('message'))
                            <p class="alert alert-success">{{ session()->get('message') }}</p>
                        @endif

                        <!-- "error" -->
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                    </div>
                @endif



                <!-- SI RECHERCHE 
                =================================================================================================================== -->
                @if (Route::currentRouteName() == 'search')

                    <!-- si, pas de résultat suite recherche -->
                    @if (count($posts) == 0)

                        <!-- affichage titre "aucun resultat..." -->
                        <div class="border rounded pt-1" style="background-color: rgba(0, 0, 0, 0.287); backdrop-filter: blur(7px)">
                            <h1 class="text-light" style="text-shadow: 1px 1px 1px black">Aucun résultat ne correspond à cette recherche...</h1>
                        </div>

                    <!-- sinon -->
                    @else

                        <div class="d-none"></div>

                    @endif

                <!-- sinon -->
                @else

                    <h1 class="mb-4 text-light" style="text-shadow: 1px 1px 1px rgba(0, 0, 0, 0.462)">Bienvenue sur SociaLink</h1>



                    <!-- FORMULAIRE DE POST
                    =================================================================================================================== -->
                    <form action="{{ route('post.store') }}" method="POST" class="w-50 border rounded p-5" enctype="multipart/form-data" id="form_ajout_mess">
                    @csrf

                    <h3 class="text-light" style="text-shadow: 1px 1px 1px rgba(0, 0, 0, 0.462)">Publie quelque chose...</h3>

                        <div class="col d-flex gap-3 flex-sm-nowrap flex-wrap justify-content-center">

                            <!-- label + input tags -->
                            <div class="col-md-6">

                                <label for="tags" class="col-md-4 col-form-label text-center text-light"><small>tags</small></label>
                                <input for="tags" type="text" class="form-control @error('tags') is-invalid @enderror" name="tags" placeholder="Bonjour" required autofocus>

                                @error('tags')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror

                            </div>

                            <!-- label + input image -->
                            <div class="col-md-6">

                                <label for="image" class="col-md-4 col-form-label text-center text-light"><small>{{ __('image')}}</small></label>
                                <input id="image" type="file" class="form-control @error('image') is-invalid @enderror" name="image" placeholder="image.jpg" autocomplete="image" autofocus>

                                @error('image')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                        </div>

                        <!-- label + input texte -->
                        <div class="row mb-3 mt-2">

                            <label class="text-light mt-2 mb-2" for="content"><small>Contenu du message:</small></label>
                            <textarea required class="container-fluid rounded" type="text" name="content" id="content" placeholder="Min : 25 caractères"></textarea>

                            @error('content')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <!-- bouton valider le post -->
                        <div class="col">
                            <button type="submit" class="btn btn-primary mt-4 px-4 text-center">Poster</button>
                        </div>

                    </form>

                @endif



                <!-- BOUTTON SCROLL VERS POSTS 
                =================================================================================================================== -->

                <!-- si aucun resultat suite recheche  -->
                @if (Route::currentRouteName() == 'search')

                    <!-- pas de boutton -->
                    <div class="d-none"></div>

                <!-- sinon -->
                @else

                    <div class="mt-5 pt-5">
                        <a href="#card_post">
                            <button class="btn btn-primary px-5 border-light p-3">Consulter les posts</button>
                        </a>
                    </div>

                @endif

            </div>
        </div>



    <!-- SI PAS DE RESULTAT SUITE RECHERCHE 
    =================================================================================================================== -->
    @if (count($posts) == 0)

        <!-- pas de section -->
        <div class="d-none"></div>

    <!-- sinon -->
    @else



        <!-- BOUCLE AFFICHAGE POST 
        =================================================================================================================== -->
        @foreach ($posts as $post)

            <!-- container fluid -->
            <div class="container-fluid bg-dark p-3 d-flex align-items-center" id="home_body" style="background-image: linear-gradient(to right, #00000051, #00000018), url('../images/image_fond_2.jpg')">

                <!-- container -->
                <div class="container mb-3 justify-content-center">
                    <div class="row d-flex align-items-center justify-content-center">
    
                        <!-- coté gauche, post user -->
                        <div class="col-md-6 p-0 d-flex align-items-center">



                            <!-- CARD POST  
                            =================================================================================================================== -->
                            <div class="card w-75 mx-auto m-3 mt-4" id="card_post">



                                <!-- CARD HEADER 
                                =================================================================================================================== -->
                                <div class="card-header pb-0">

                                    <!-- image user + date du post / pseudo + poubelle delete -->
                                    <div class="d-flex justify-content-between">

                                        <a href="{{route('users.show', $post->user)}}" style="text-decoration: none">

                                            <!-- image user -->
                                            <img src="images/{{ $post->user->image }}" class="rounded-circle" alt="" style="width: 30px; height: 30px;">
                                        
                                        </a>

                                        <!-- lien vers profil public du user  -->
                                        <a href="{{route('users.show', $post->user)}}" style="text-decoration: none">

                                            <!-- pseudo user -->
                                            <p class="m-0 text-primary"><small class="text-dark">posté par</small> {{ $post->user->pseudo }} </p>

                                        </a>

                                        @can('delete', $post)
                                            <!-- poubelle delete -->
                                            <form action="{{ route('post.destroy', $post) }}" method="post">
                                            @csrf
                                            @method('delete')
                                                <button type="submit" class="border-0 p-0"><i class="fa-solid fa-trash text-danger"></i></button>
                                            </form>
                                        @endcan

                                    </div>

                                    <!-- date de création / modification du post + 3 points "modification -> page modification post" -->
                                    <div class="d-flex justify-content-between mt-1">

                                        <!-- date de création / modification du post-->
                                        <small>{{ $post->created_at->diffForHumans() }} 
                                            @if ($post->created_at != $post->updated_at) 
                                                <small class="ps-2">
                                                    "modifié {{ $post->updated_at->diffForHumans() }}"
                                                </small>
                                            @endif
                                            </small>

                                        @can('update', $post)
                                            <!-- 3 points "modification -> page modification post" -->
                                            <a href="{{ route('post.edit', $post) }}">
                                                <i class="fa-solid fa-ellipsis fs-3"></i>
                                            </a>
                                        @endcan

                                    </div>

                                </div>



                                <!-- CARD BODY 
                                =================================================================================================================== -->
                                <div class="card-body p-0">

                                    <!-- image post -->
                                    <img class="w-100" src="{{ asset('images/' . $post->image)}}" alt="imagePost">

                                </div>



                                <!-- CARD FOOTER 
                                =================================================================================================================== -->
                                <div class="card footer p-2">

                                    <!-- scroll -->
                                    <div class="overflow-auto" style="max-height: 150px;">

                                        <!-- tags -->
                                        <p class="m-0 pb-2 text-primary"><small>#{{ implode(' #', explode(' ', $post->tags)) }}</small></p>

                                        <!-- texte post -->
                                        <p>{{ $post->content }}</p>

                                    </div>

                                    <!-- boutton "commenter" affichant bloc commentaire -->
                                    <button class="btn btn-primary" onclick="document.getElementById('formulairecommentaire{{ $post->id}}').style.display = 'block'">Commenter</button>

                                </div>

                            </div>

                        </div>



                        <!-- AFFICHAGE SI POST DEJA COMMENTE
                        =================================================================================================================== -->

                        <!-- "si" commentaires -->
                        @if (count($post->comments) > 0)

                            <!-- droite, commentaires associés au post -->
                            <div class="col-md-6 p-0 d-flex align-items-center flex-column border border-secondary" id="col_com" style="overflow-y: scroll; height: 550px">

                                <!-- titre + pseudo -->
                                <p class="text-light mt-2" id="com_publi"><small>Commentaires du post de {{ $post->user->pseudo }}</small></p>



                                <!-- AFFICHAGE DES POSTS COMMENTAIRE
                                =================================================================================================================== -->

                                <!-- boucle qui affiche les posts "commentaire" associés au post-->
                                @foreach ($post->comments as $comment)



                                    <!-- BLOC COMMENTAIRE ( pour poster commentaire qui apparaît après clic sur boutton modifier "bloc pour post avec déja des commentaires" )
                                    =================================================================================================================== -->
                                    <div style="display: none" class="col p-3 mb-2" id="formulairecommentaire{{ $post->id }}">

                                        <!-- formulaire -->
                                        <form class="w-100 m-auto border border-primary rounded p-2" action="{{ route('comment.store') }}" method="POST" enctype="multipart/form-data" id="formulaire_boucle_commentaire">
                                        @csrf

                                            <!-- "X" permettant de refermer bloc commentaires -->
                                            <div class="form-group d-flex justify-content-end pe-2">
                                                <input type="hidden" name="post_id" id="post_id" value="{{ $post->id }}">
                                                <button type="submit" class="border-0 p-0 bg-transparent flex-end" onclick="document.getElementById('formulairecommentaire{{ $post->id }}').style.display = 'none'"><i class="fa-solid fa-x text-light"></i></button>
                                            </div>

                                            <!-- label + input tags -->
                                            <div class="form-group mb-2">
                                                <label for="tags"><small class="text-light">Ajoute des tags</small></label>
                                                <input required class="container rounded" type="text" name="tags" id="tags" placeholder="Ajoute des tags">
                                            </div>

                                            <!-- label + input image -->
                                            <div class="form-group mb-2">
                                                <label for="nom"><small class="text-light">Image</small></label>
                                                <input type="file" class="form-control" name="image" id="image" placeholder="Image">
                                            </div>

                                            <!-- texte commentaire -->
                                            <div class="form-group mb-2">
                                                <label for="content"><small class="text-light">Tape ton commentaire</small></label>
                                                <textarea required class="container rounded" name="content" type="text" id="content" placeholder="Tape ton commentaire"></textarea>
                                            </div>

                                            <!-- boutton pour poster le commentaire -->
                                            <div class="form-group">
                                                <button type="submit" class="btn btn-primary text-center">Valider</button>
                                            </div>

                                        </form>

                                    </div>



                                    <!-- CARD COMMENTAIRE
                                    =================================================================================================================== -->
                                    <div class="card w-50 my-3 border border-primary" id="card_com">



                                        <!-- CARD HEADER 
                                        =================================================================================================================== -->
                                        <div class="card-header pb-0">

                                            <!-- image user + date du commentaire / pseudo + poubelle delete -->
                                            <div class="d-flex justify-content-between">

                                                <!-- lien vers profil public du user  -->
                                                <a href="{{route('users.show', $comment->user)}}" style="text-decoration: none">

                                                    <!-- image user -->
                                                    <img src="images/{{ $comment->user->image }}" class="rounded-circle m-1" alt="" style="width: 30px; height: 30px;">
                                                
                                                </a>

                                                <!-- lien vers profil public du user  -->
                                                <a href="{{route('users.show', $comment->user)}}" style="text-decoration: none">

                                                    <!-- pseudo user -->
                                                    <p class="m-0 text-primary"><small class="text-dark">posté par</small> {{ $comment->user->pseudo }}</p>

                                                </a>

                                                @can('delete', $comment)
                                                    <!-- poubelle delete -->
                                                    <form action="{{ route('comment.destroy', $comment) }}" method="post">
                                                    @csrf
                                                    @method('delete')
                                                        <button type="submit" class="border-0 p-0"><i class="fa-solid fa-trash text-danger"></i></button>
                                                    </form>
                                                @endcan

                                            </div>

                                            <!-- date de création / modification du commentaire + 3 points "modification -> page modification commentaire" -->
                                            <div class="d-flex justify-content-between mt-1">

                                                <!-- date de création / modification du post-->
                                                <small>{{ $comment->created_at->diffForHumans() }} @if ($comment->created_at != $comment->updated_at) <small class="ps-2">"modifié {{ $comment->updated_at->diffForHumans() }}"</small>@endif</small>

                                                @can('update', $comment)
                                                    <!-- 3 points "modification -> page modification commentaire" -->
                                                    <a href="{{ route('comment.edit', $comment) }}">
                                                        <i class="fa-solid fa-ellipsis fs-4"></i>
                                                    </a>
                                                @endcan

                                            </div>

                                        </div>



                                        <!-- CARD BODY 
                                        =================================================================================================================== -->
                                        <div class="card-body p-0">

                                            <!-- image commentaire -->
                                            <img class="w-100" src="{{ asset('images/' . $comment->image)}}" alt="imagePost">

                                        </div>



                                        <!-- CARD FOOTER 
                                        =================================================================================================================== -->
                                        <div class="card footer p-2 overflow-auto">

                                            <!-- scroll -->
                                            <div class="overflow-auto" style="max-height: 150px;">

                                                <!-- tags -->
                                                <p class="m-0 pb-2 text-primary"><small>#{{ implode(' #', explode(' ', $comment->tags)) }}</small></p>

                                                <!-- texte commentaire -->
                                                <p class="text-dark">{{ $comment->content }}</p>

                                            </div>

                                        </div>

                                    </div>

                                @endforeach

                            </div>



                        <!-- SINON AFFICHAGE SI POST NON COMMENTE
                        =================================================================================================================== -->
                        @else



                            <!-- BLOC COMMENTAIRE ( pour poster commentaire qui apparaît après clic sur boutton modifier "bloc pour post avec déja des commentaires" )
                            =================================================================================================================== -->
                            <div style="display: none" class="col p-3 mb-2" id="formulairecommentaire{{ $post->id }}">

                                <!-- formulaire -->
                                <form class="w-100 m-auto border border-primary rounded p-2" action="{{ route('comment.store') }}" method="POST" enctype="multipart/form-data" id="formulaire_boucle_commentaire">
                                @csrf

                                    <!-- "X" permettant de refermer bloc commentaires -->
                                    <div class="form-group d-flex justify-content-end pe-2">
                                        <input type="hidden" name="post_id" id="post_id" value="{{ $post->id }}">
                                        <button type="submit" class="border-0 p-0 bg-transparent flex-end" onclick="document.getElementById('formulairecommentaire{{ $post->id }}').style.display = 'none'"><i class="fa-solid fa-x text-light"></i></button>
                                    </div>

                                    <!-- label + input tags -->
                                    <div class="form-group mb-2">
                                        <label for="tags"><small class="text-light">Ajoute des tags</small></label>
                                        <input required class="container rounded" type="text" name="tags" id="tags" placeholder="Ajoute des tags">
                                    </div>

                                    <!-- label + input image -->
                                    <div class="form-group mb-2">
                                        <label for="nom"><small class="text-light">Image</small></label>
                                        <input type="file" class="form-control" name="image" id="image" placeholder="Image" value="{{ $post->image }}">
                                    </div>

                                    <!-- texte commentaire -->
                                    <div class="form-group mb-2">
                                        <label for="content"><small class="text-light">Tape ton commentaire</small></label>
                                        <textarea required class="container rounded" name="content" type="text" id="content" placeholder="Tape ton commentaire"></textarea>
                                    </div>

                                    <!-- boutton pour poster le commentaire -->
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary text-center">Valider</button>
                                    </div>

                                </form>

                            </div>

                        @endif

                    </div>
                </div>

            </div>

        @endforeach

        <div class="bg-dark text-center p-1 justify-content-center d-flex align-items-center">{{$posts->links()}}</div>

    @endif

@endsection

