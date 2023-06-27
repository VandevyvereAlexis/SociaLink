@extends('layout.app')

@section('title')
    Mon compte
@endsection

@section('content')
    <main class="container pt-5">

        <h1>Modification du commentaire</h1>

        <div class="row">
            
            <form class="col-4 mx-auto" action="{{ route('comment.update', $comment) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="content">Nouveau texte</label>
                    <input required type="text" class="form-control" placeholder="modifier" name="content" value="{{ $comment->content }}" id="content">
                </div>

                <div class="form-group">
                    <label for="image">Nouvelle image</label>
                    <input required type="text" class="form-control" placeholder="modifier" name="image" value="{{ $comment->image }}" id="image">
                </div>

                <div class="form-group">
                    <label for="tags">Nouveaux tags</label>
                    <input required type="text" class="form-control" placeholder="modifier" name="tags" value="{{ $comment->tags }}" id="tags">
                </div>

                

                <button type="submit" class="btn btn-primary">Valider</button>
            </form>
        </div>

        <form action="{{ route('comment.destroy', $comment) }}" method="post">
            @csrf
            @method('delete')
            <button type="submit" class="btn btn-danger">Supprimer le post</button>
        </form>
        
    </main>
@endsection