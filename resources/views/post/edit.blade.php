@extends('layout.app')

@section('title')
    Mon compte
@endsection

@section('content')
    <main>

        <div class="container-fluid d-flex justify-content-center align-items-center flex-column" id="blade_modif" style="background-image: linear-gradient(to right, #0000001c, #00000000), url('/images/image_fond.jpg')">
            <div class="row border p-4 rounded mb-5">

                <!-- titre de la page -->
                <h1 class="text-center text-light pb-3">Modification du post</h1>

                <!-- FORMULAIRE MODIFICATION POST
                =================================================================================================================== -->
                <form class="col-8 mx-auto text-light" action="{{ route('post.update', $post) }}" method="POST" enctype="multipart/form-data">
                @csrf

                    <!-- méthode "PUT" -->
                    @method('PUT')

                    <!-- label + input texte -->
                    <div class="form-group mb-3">
                        <label for="content"><small>Nouveau texte</small></label>
                        <input required type="text" class="form-control" placeholder="modifier" name="content" value="{{ $post->content }}" id="content">
                    </div>

                    <!-- label + input image -->
                    <div class="form-group mb-3">
                        <label for="image"><small>Nouvelle image</small></label>
                        <input required type="file" class="form-control" placeholder="modifier" name="image" value="{{ $post->image }}" id="image">
                    </div>

                    <!-- label + input tags -->
                    <div class="form-group mb-4">
                        <label for="tags"><small>Nouveaux tags</small></label>
                        <input required type="text" class="form-control" placeholder="modifier" name="tags" value="{{ $post->tags }}" id="tags">
                    </div>

                    <div class="d-flex justify-content-center gap-3">

                        <!-- boutton validation du post -->
                        <button type="submit" class="btn btn-primary">Valider</button>

                        <!-- FORMULAIRE BOUTTON SUPPRESSION POST
                        =================================================================================================================== -->
                        <form action="{{ route('post.destroy', $post) }}" method="post">
                        @csrf
        
                            <!-- méthode "DELETE" -->
                            @method('delete')
        
                            <!-- boutton suppression post -->
                            <button type="submit" class="btn btn-danger">Supprimer le post</button>
        
                        </form>

                    </div>

                </form>

            </div>

        </div>
        
    </main>
@endsection