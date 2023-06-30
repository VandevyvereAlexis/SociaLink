@extends('layout.app')

@section('title')
    Mon compte
@endsection

@section('content')
    <main class="container-fluid justify-content-center align-items-center d-flex pt-5" style="background-image: linear-gradient(to right, #0000001c, #00000000), url('/images/image_fond.jpg')" id="blade_comm">

        <div class="text-light border p-4 rounded">
            <h1 class="text-center mb-4">Modification du commentaire</h1>

            <div class="row">
            
                <form class="col mx-auto" action="{{ route('comment.update', $comment) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                    <div class="form-group mb-3">
                        <label for="content"><small>Nouveau texte</small></label>
                        <input required type="text" class="form-control" placeholder="modifier" name="content" value="{{ $comment->content }}" id="content">
                    </div>

                    <div class="form-group mb-3">
                        <label for="image"><small>Nouvelle image</small></label>
                        <input required type="file" class="form-control" placeholder="modifier" name="image" value="{{ $comment->image }}" id="image">
                    </div>

                    <div class="form-group mb-3">
                        <label for="tags"><small>Nouveaux tags</small></label>
                        <input required type="text" class="form-control" placeholder="modifier" name="tags" value="{{ $comment->tags }}" id="tags">
                    </div>

                    <div class="d-flex mt-4 justify-content-center gap-4">
                        <button type="submit" class="btn btn-primary">Valider</button>

                        <form action="{{ route('comment.destroy', $comment) }}" method="post">
                        @csrf
                        @method('delete')
                            <button type="submit" class="btn btn-danger">Supprimer le post</button>
                        </form>
                    </div>

                </form>

            </div>

        </div>  
        
    </main>
@endsection