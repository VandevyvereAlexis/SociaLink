@extends ('layout.app')

@section('title')
    Profil de {{ $user->pseudo }}
@endsection

@section('content')
    <div class="container-fluid mb-3"
        style="background-image: linear-gradient(to right, #00000051, #00000018), url('../images/image_fond_2.jpg')"
        id="profil_blade">
        <div class="row justify-content-center">
            <div class="col">


                <div class="container mt-5 pt-5 p-3">
                    <div class="d-flex border rounded mx-auto col px-1 flex-column p-4" style="background-color: rgba(0, 0, 0, 0.412); backdrop-filter: blur(5px)">
                        <div class="col text-center">

                            @if ($user->image)
                                <img src="{{ asset("images/$user->image") }} " class="rounded-circle text-center"
                                    style="width: 10vw; height:10vw" alt="imageUtilisateur">
                            @else
                                <img src="{{ asset('images/default_user.jpg') }} " class="m-1 rounded-circle"
                                    style="width: 10vw; height:10vw" alt="imageUtilisateur">
                            @endif

                            <div class="col pt-3 text-light">bienvenue sur le profil de <h1
                                    class="font-weight-bold text-warning">

                                    {{ $user->pseudo }}</h1>
                                <div class="row p-2">
                                    <div class="col">
                                        <i class="fas fa-arrow-alt-circle-right fa-2x fs-5 text-light"></i>
                                        <small>inscrit(e) le
                                            {{ date('d-m-Y à H:i:s', strtotime($user->created_at)) }}</small>
                                    </div>
                                </div>

                                <div class="row p-2 justify-content-between">
                                    <div class="col">
                                        <i class="fas fa-comments fa-2x fs-5 text-light"></i>
                                        <small>{{ count($user->posts) }} post(s) posté(s)</small>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <!-- ***********************************AFFICHER LES post*****************************-->

                        @foreach ($user->posts as $post)

                                <!-- container -->
                                <div class="container mb-3 justify-content-center">
                                    <div class="row d-flex align-items-center justify-content-center flex-column">

                                        <!-- coté gauche, post user -->
                                        <div class="col-md-6 p-0 d-flex align-items-center">



                                            <!-- CARD POST
                                            =================================================================================================================== -->
                                            <div class="card w-100 mx-auto m-3 mt-4" id="card_post">



                                                <!-- CARD HEADER
                                                =================================================================================================================== -->
                                                <div class="card-header pb-0">

                                                    <!-- image user + date du post / pseudo + poubelle delete -->
                                                    <div class="d-flex justify-content-between">

                                                        <a href="{{ route('users.show', $post->user) }}"
                                                            style="text-decoration: none">

                                                            <!-- image user -->
                                                            <img src="{{ asset("images/" . $post->user->image)}}"
                                                                class="rounded-circle" alt=""
                                                                style="width: 30px; height: 30px;">

                                                        </a>

                                                        <!-- lien vers profil public du user  -->
                                                        <a href="{{ route('users.show', $post->user) }}"
                                                            style="text-decoration: none">

                                                            <!-- pseudo user -->
                                                            <p class="m-0 text-primary"><small class="text-dark">posté
                                                                    par</small> {{ $post->user->pseudo }} </p>

                                                        </a>

                                                        @can('delete', $post)
                                                            <!-- poubelle delete -->
                                                            <form action="{{ route('post.destroy', $post) }}" method="post">
                                                                @csrf
                                                                @method('delete')
                                                                <button type="submit" class="border-0 p-0"><i
                                                                        class="fa-solid fa-trash text-danger"></i></button>
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
                                                    <img class="w-100" src="{{ asset('images/' . $post->image) }}"
                                                        alt="imagePost">

                                                </div>



                                                <!-- CARD FOOTER
                                                =================================================================================================================== -->
                                                <div class="card footer p-2">

                                                    <!-- scroll -->
                                                    <div class="overflow-auto" style="max-height: 150px;">

                                                        <!-- tags -->
                                                        <p class="m-0 pb-2 text-primary">
                                                            <small>#{{ implode(' #', explode(' ', $post->tags)) }}</small>
                                                        </p>

                                                        <!-- texte post -->
                                                        <p>{{ $post->content }}</p>

                                                    </div>

                                                    <!-- boutton "commenter" affichant bloc commentaire -->
                                                    <button class="btn btn-primary"
                                                        onclick="document.getElementById('formulairecommentaire{{ $post->id }}').style.display = 'block'">Commenter</button>

                                                </div>

                                            </div>

                                        </div>



                                        <!-- AFFICHAGE SI POST DEJA COMMENTE
                                        =================================================================================================================== -->

                                        <!-- "si" commentaires -->
                                        @if (count($post->comments) > 0)
                                            <!-- droite, commentaires associés au post -->
                                            <div class="col-md-6 p-0 d-flex align-items-center flex-column border border-secondary"
                                                id="col_com" style="overflow-y: scroll; height: 550px">



                                                <!-- AFFICHAGE DES POSTS COMMENTAIRE
                                                =================================================================================================================== -->

                                                <!-- boucle qui affiche les posts "commentaire" associés au post-->
                                                @foreach ($post->comments as $comment)

                                                    <!-- BLOC COMMENTAIRE ( pour poster commentaire qui apparaît après clic sur boutton modifier "bloc pour post avec déja des commentaires" )
                                                    =================================================================================================================== -->
                                                    <div style="display: none" class="col p-3 mb-2"
                                                        id="formulairecommentaire{{ $post->id }}">

                                                        <!-- formulaire -->
                                                        <form class="w-100 m-auto border border-primary rounded p-2"
                                                            action="{{ route('comment.store') }}" method="POST"
                                                            enctype="multipart/form-data"
                                                            id="formulaire_boucle_commentaire">
                                                            @csrf

                                                            <!-- "X" permettant de refermer bloc commentaires -->
                                                            <div class="form-group d-flex justify-content-end pe-2">
                                                                <input type="hidden" name="post_id" id="post_id"
                                                                    value="{{ $post->id }}">
                                                                <button type="submit"
                                                                    class="border-0 p-0 bg-transparent flex-end"
                                                                    onclick="document.getElementById('formulairecommentaire{{ $post->id }}').style.display = 'none'"><i
                                                                        class="fa-solid fa-x text-light"></i></button>
                                                            </div>

                                                            <!-- label + input tags -->
                                                            <div class="form-group mb-2">
                                                                <label for="tags"><small class="text-light">Ajoute des
                                                                        tags</small></label>
                                                                <input required class="container rounded" type="text"
                                                                    name="tags" id="tags"
                                                                    placeholder="Ajoute des tags">
                                                            </div>

                                                            <!-- label + input image -->
                                                            <div class="form-group mb-2">
                                                                <label for="nom"><small
                                                                        class="text-light">Image</small></label>
                                                                <input type="file" class="form-control" name="image"
                                                                    id="image" placeholder="Image">
                                                            </div>

                                                            <!-- texte commentaire -->
                                                            <div class="form-group mb-2">
                                                                <label for="content"><small class="text-light">Tape ton
                                                                        commentaire</small></label>
                                                                <textarea required class="container rounded" name="content" type="text" id="content"
                                                                    placeholder="Tape ton commentaire"></textarea>
                                                            </div>

                                                            <!-- boutton pour poster le commentaire -->
                                                            <div class="form-group">
                                                                <button type="submit"
                                                                    class="btn btn-primary text-center">Valider</button>
                                                            </div>

                                                        </form>

                                                    </div>



                                                    <!-- CARD COMMENTAIRE
                                                    =================================================================================================================== -->
                                                    <div class="card w-75 my-3 border border-primary" id="card_com">



                                                        <!-- CARD HEADER
                                                        =================================================================================================================== -->
                                                        <div class="card-header pb-0">

                                                            <!-- image user + date du commentaire / pseudo + poubelle delete -->
                                                            <div class="d-flex justify-content-between">

                                                                <!-- lien vers profil public du user  -->
                                                                <a href="{{ route('users.show', $comment->user) }}"
                                                                    style="text-decoration: none">

                                                                    <!-- image user -->
                                                                    <img src="{{ asset("images/" . $comment->user->image)}}"
                                                                        class="rounded-circle m-1" alt=""
                                                                        style="width: 30px; height: 30px;">

                                                                </a>

                                                                <!-- lien vers profil public du user  -->
                                                                <a href="{{ route('users.show', $comment->user) }}"
                                                                    style="text-decoration: none">

                                                                    <!-- pseudo user -->
                                                                    <p class="m-0 text-primary"><small
                                                                            class="text-dark">posté par</small>
                                                                        {{ $comment->user->pseudo }}</p>

                                                                </a>

                                                                @can('delete', $comment)
                                                                    <!-- poubelle delete -->
                                                                    <form action="{{ route('comment.destroy', $comment) }}"
                                                                        method="post">
                                                                        @csrf
                                                                        @method('delete')
                                                                        <button type="submit" class="border-0 p-0"><i
                                                                                class="fa-solid fa-trash text-danger"></i></button>
                                                                    </form>
                                                                @endcan

                                                            </div>

                                                            <!-- date de création / modification du commentaire + 3 points "modification -> page modification commentaire" -->
                                                            <div class="d-flex justify-content-between mt-1">

                                                                <!-- date de création / modification du post-->
                                                                <small>{{ $comment->created_at->diffForHumans() }}
                                                                    @if ($comment->created_at != $comment->updated_at)
                                                                        <small class="ps-2">"modifié
                                                                            {{ $comment->updated_at->diffForHumans() }}"</small>
                                                                    @endif
                                                                </small>

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
                                                            <img class="w-100"
                                                                src="{{ asset('images/' . $comment->image) }}"
                                                                alt="imagePost">

                                                        </div>



                                                        <!-- CARD FOOTER
                                                        =================================================================================================================== -->
                                                        <div class="card footer p-2 overflow-auto">

                                                            <!-- scroll -->
                                                            <div class="overflow-auto" style="max-height: 150px;">

                                                                <!-- tags -->
                                                                <p class="m-0 pb-2 text-primary">
                                                                    <small>#{{ implode(' #', explode(' ', $comment->tags)) }}</small>
                                                                </p>

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
                                            <div style="display: none" class="col p-3 mb-2"
                                                id="formulairecommentaire{{ $post->id }}">

                                                <!-- formulaire -->
                                                <form class="w-100 m-auto border border-primary rounded p-2"
                                                    action="{{ route('comment.store') }}" method="POST"
                                                    enctype="multipart/form-data" id="formulaire_boucle_commentaire">
                                                    @csrf

                                                    <!-- "X" permettant de refermer bloc commentaires -->
                                                    <div class="form-group d-flex justify-content-end pe-2">
                                                        <input type="hidden" name="post_id" id="post_id"
                                                            value="{{ $post->id }}">
                                                        <button type="submit"
                                                            class="border-0 p-0 bg-transparent flex-end"
                                                            onclick="document.getElementById('formulairecommentaire{{ $post->id }}').style.display = 'none'"><i
                                                                class="fa-solid fa-x text-light"></i></button>
                                                    </div>

                                                    <!-- label + input tags -->
                                                    <div class="form-group mb-2">
                                                        <label for="tags"><small class="text-light">Ajoute des
                                                                tags</small></label>
                                                        <input required class="container rounded" type="text"
                                                            name="tags" id="tags" placeholder="Ajoute des tags">
                                                    </div>

                                                    <!-- label + input image -->
                                                    <div class="form-group mb-2">
                                                        <label for="nom"><small
                                                                class="text-light">Image</small></label>
                                                        <input type="file" class="form-control" name="image"
                                                            id="image" placeholder="Image"
                                                            value="{{ $post->image }}">
                                                    </div>

                                                    <!-- texte commentaire -->
                                                    <div class="form-group mb-2">
                                                        <label for="content"><small class="text-light">Tape ton
                                                                commentaire</small></label>
                                                        <textarea required class="container rounded" name="content" type="text" id="content"
                                                            placeholder="Tape ton commentaire"></textarea>
                                                    </div>

                                                    <!-- boutton pour poster le commentaire -->
                                                    <div class="form-group">
                                                        <button type="submit"
                                                            class="btn btn-primary text-center">Valider</button>
                                                    </div>

                                                </form>

                                            </div>
                                        @endif

                                    </div>
                                </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    @endsection
