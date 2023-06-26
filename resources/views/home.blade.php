@extends('layout.app')

<!-- section content -->
@section('content')





    <!-- HAUT DE PAGE ( POSTER )  
    =================================================================================================================== -->

    <div class="container-fluid" id="home_top" style="background-image: linear-gradient(to right, #0000001c, #00000000), url('../images/image_fond.jpg')">
        <div class="row no-gutters justify-content-center text-center">

            @if (Route::currentRouteName() == 'search')
                <h1 class="m-5">Résultat de la recherche</h1>
            @else
                <h1 class="m-5">Accueil / liste de messages</h1>
                <h2 class="m-5">Poster un message</h2>

                <!-- Formulaire d'ajout de message -->
                <form action="{{ route('post.store') }}" method="POST" class="w-50" enctype="multipart/from-data">
                @csrf
                
                    <div class="row mb-3">
                        <!-- input content -->
                        <label for="content">Contenu du message:</label>
                        <textarea required class="container-fluis mt-2" type="text" name="content" id="content" placeholder="Min : 25 caractères"></textarea>

                        @error('content')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <!-- input tags -->
                    <div class="row mb-3">
                        <label for="tags" class="col-md-4 col-form-label text-md-end">tags</label>

                        <div class="col-md-6">
                            <input for="tags" type="text" class="form-control @error('tags') is-invalid @enderror" name="tags" placeholder="Bonjour" required autofocus>

                            @error('tags')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror

                        </div>
                    </div>

                    <!-- input image -->
                    <div class="row mb-3">
                        <label for="image" class="col-md-4 col-form-label text-md-end">{{ __('image')}}</label>

                        <div class="col-md-6">
                            <input id="image" type="text" class="form-control @error('image') is-invalid @enderror" name="image" placeholder="image.jpg" autocomplete="image" autofocus>

                            @error('image')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                    </div>

                    <button type="submit" class="btn btn-primary">Valider</button>

                </form>
            @endif
        </div>
    </div>





    <!-- AFFICHAGE DES POSTS 
    =================================================================================================================== -->

    <!-- titre de la section -->
    <h2 class="bg-dark m-0 text-light text-center fs-2" >POSTS</h2>

    <!-- boucle qui affiche les messages -->
    @foreach ($posts as $post)

        <div class="container-fluid bg-dark p-3" id="home_body" style="background-image: linear-gradient(to right, #00000051, #00000018), url('../images/image_fond_2.jpg')">

            <!-- card -->
            <div class="container mb-3 justify-content-center">
                <div class="row d-flex align-items-center justify-content-center">
    
                    <!-- gauche, post utilisateur -->
                    <div class="col-md-6 p-0 d-flex align-items-center">
                        <div class="card w-75 mx-auto m-3 mt-4" id="card_post">

                            <!-- pseudo -->
                            <div class="card-header">
                                <p class="m-0"><small>posté par</small> {{ $post->user->pseudo }} </p>
                                <small>{{ $post->created_at->diffForHumans() }}</small>
                            </div>
    
                            <!-- image -->
                            <div class="card-body p-0">
                                <img class="w-100" src="{{ asset('images/' . $post->image)}}" alt="imagePost">
                            </div>

                            <div class="card-img-overlay d-flex flex-row-reverse p-0">
                                <i class="fa-regular fa-comment position relative pt-3 pe-3 fs-3"></i>
                            </div>
    
                            <!-- tags + post -->
                            <div class="card footer p-2">
                                <div class="overflow-auto" style="max-height: 150px;">
                                    <p class="m-0 pb-2 text-primary-emphasis"><small>{{ $post->tags }}</small></p>
                                    <p>{{ $post->content }}</p>
                                </div>
                            </div>
    
                        </div>
                    </div>


                    <!-- si commentaires -->
                    @if (count($post->comments) > 0)

                        <!-- droite, commentaires associé au post -->
                        <div class="col-md-6 p-0 d-flex align-items-center flex-column border border-secondary" id="col_com" style="overflow-y: scroll; height: 550px">

                            <p class="text-light mt-2" id="com_publi"><small>Commentaires de la publication de {{ $post->user->pseudo }}</small></p>

                            <!-- boucle qui affiche les commentaires -->
                            @foreach ($post->comments as $comment)

                                <div class="card w-50 my-3" id="card_com">

                                    <!-- pseudo -->
                                    <div class="card-header">
                                        <small>posté par {{ $comment->user->pseudo }} {{ $comment->created_at->diffForHumans() }}</small>
                                    </div>

                                    <!-- image -->
                                    <div class="card-body p-0">
                                        <img class="w-100" src="{{ asset('images/' . $comment->image)}}" alt="imagePost">
                                    </div>

                                    <!-- tags + com -->
                                    <div class="card footer p-2 overflow-auto">
                                        <div class="overflow-auto" style="max-height: 150px;">
                                            <p class="m-0 pb-2 text-primary-emphasis"><small>{{ $comment->tags }}</small></p>
                                            <p class="text-dark">{{ $comment->content }}</p>
                                        </div>
                                    </div>

                                </div>
                                        
                            @endforeach

                        </div>

                    <!-- si pas de commentaire -->
                    @else
                        <!-- espace vide post principal centre -->
                        <div class="d-none"></div>
                    @endif

                </div>
            </div>

        </div>

    @endforeach
    
    <!-- numéros des pages -->
    <div class="d-flex justify-content-center pt-3 bg-dark">{{ $posts->links() }}</div>


@endsection
