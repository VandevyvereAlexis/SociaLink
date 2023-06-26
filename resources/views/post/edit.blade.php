@extends('layout.app')

@section('title')
    Mon compte
@endsection

@section('content')
    <main class="container pt-5">

        <h1>Modification du post</h1>

        <div class="row">
            
            <form class="col-4 mx-auto" action="{{ route('post.update', $post) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="pseudo">Nouveau pseudo</label>
                    <input required type="text" class="form-control" placeholder="modifier" name="pseudo" value="{{ $post->content }}" id="pseudo">
                </div>

                <div class="form-group">
                    <label for="image">Nouvelle image</label>
                    <input required type="text" class="form-control" placeholder="modifier" name="image" value="{{ $post->image }}" id="image">
                </div>

                <div class="form-group">
                    <label for="image">Nouvelle image</label>
                    <input required type="text" class="form-control" placeholder="modifier" name="image" value="{{ $post->image }}" id="image">
                </div>

                

                <button type="submit" class="btn btn-primary">Valider</button>
            </form>
        </div>

        <form action="{{ route('post.destroy', $post) }}" method="post">
            @csrf
            @method('delete')
            <button type="submit" class="btn btn-danger">Supprimer le post</button>
        </form>
        
    </main>
@endsection