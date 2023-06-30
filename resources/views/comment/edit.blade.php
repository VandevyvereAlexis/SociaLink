@extends('layout.app')

@section('title')
    Mon compte
@endsection

@section('content')

    <!-- container -->
    <main class="container-fluid justify-content-center align-items-center d-flex pt-5" style="background-image: linear-gradient(to right, #0000001c, #00000000), url('/images/image_fond.jpg')" id="blade_comm">

        <div class="text-light border p-4 rounded">
            <h1 class="text-center mb-4">Modification du commentaire</h1>

            <div class="row">
            
                <!-- formulaire modif commentaire -->
                <form class="col mx-auto" action="{{ route('comment.update', $comment) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                    <!-- texte -->
                    <div class="form-group mb-3">
                        <label for="content"><small>Nouveau texte</small></label>
                        <input required type="text" class="form-control" placeholder="modifier" name="content" value="{{ $comment->content }}" id="content">
                    </div>

                    <!-- image -->
                    <div class="form-group mb-3">
                        <label for="image"><small>Nouvelle image</small></label>
                        <input required type="file" class="form-control" placeholder="modifier" name="image" value="{{ $comment->image }}" id="image">
                    </div>

                    <!-- tags -->
                    <div class="form-group mb-3">
                        <label for="tags"><small>Nouveaux tags</small></label>
                        <input required type="text" class="form-control" placeholder="modifier" name="tags" value="{{ $comment->tags }}" id="tags">
                    </div>

                    <!-- boutton balider + supression -->
                    <div class="d-flex mt-4 justify-content-center gap-4">

                        <!-- boutton valider -->
                        <button type="submit" class="btn btn-primary">Valider</button>

                    </div>

                </form>

                <!-- boutton supression -->
                <form action="{{ route('comment.destroy', $comment) }}" method="post">
                @csrf
                @method('delete')
                    <button type="submit" class="btn btn-danger">Supprimer le post</button>
                </form>

            </div>

        </div>  

    </main>

@endsection