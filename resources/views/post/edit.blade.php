@extends('layout.app')

@section('title')
    Mon compte
@endsection

@section('content')
    <main>

        <div class="container-fluid pt-5 d-flex justify-content-center align-items-center flex-column" id="blade_post" style="background-image: linear-gradient(to right, #0000001c, #00000000), url('/images/image_fond.jpg')">

            <!-- titre de la page -->
            <h1>Modification du post</h1>

            <div class="row">



                <!-- FORMULAIRE MODIFICATION POST
                =================================================================================================================== -->
                <form class="col-4 mx-auto" action="{{ route('post.update', $post) }}" method="POST" enctype="multipart/form-data">
                @csrf

                    <!-- méthode "PUT" -->
                    @method('PUT')

                    <!-- label + input texte -->
                    <div class="form-group">
                        <label for="content">Nouveau texte</label>
                        <input required type="text" class="form-control" placeholder="modifier" name="content" value="{{ $post->content }}" id="content">
                    </div>

                    <!-- label + input image -->
                    <div class="form-group">
                        <label for="image">Nouvelle image</label>
                        <input required type="file" class="form-control" placeholder="modifier" name="image" value="{{ $post->image }}" id="image">
                    </div>

                    <!-- label + input tags -->
                    <div class="form-group">
                        <label for="tags">Nouveaux tags</label>
                        <input required type="text" class="form-control" placeholder="modifier" name="tags" value="{{ $post->tags }}" id="tags">
                    </div>

                    <!-- boutton validation du post -->
                    <button type="submit" class="btn btn-primary">Valider</button>

                </form>



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

        </div>
        
    </main>
@endsection