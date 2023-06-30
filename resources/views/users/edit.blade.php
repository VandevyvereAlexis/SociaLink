@extends ('layout.app')

@section('title')
    Mon compte
@endsection

    @section('content')

        <main class="container-fluid pt-5 d-flex justify-content-center flex-column" id="blade_users" style="background-image: linear-gradient(to right, #0000001c, #00000000), url('/images/image_fond.jpg')">
            <div class=" col-5 mx-auto mb-5 p-3 text-light border rounded">

                <!-- titre -->
                <h1 class="text-center">Mon compte</h1>
                <h3 class="pb-3 text-center fs-5">Modifier mes information </h3>

                <div class="row">
                    
                    <!-- formulaire uptade informations -->
                    <form class="col-8 mx-auto" action="{{ route('users.update', $user) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                        <!-- pseudo -->
                        <div class="form-group mb-3">
                            <label for="pseudo">Nouveau pseudo</label>
                            <input required type="text" class="form-control" placeholder="modifier" name="pseudo" value="{{ $user->pseudo }}" id="pseudo">
                        </div>

                        <!-- image -->
                        <div class="form-group">
                            <label for="image">Nouvelle image</label>
                            <input required type="file" class="form-control" placeholder="modifier" name="image" value="{{ $user->image}}" id="image">
                        </div>

                        <!-- boutton valider + supprimer -->
                        <div class="d-flex mt-5 justify-content-center gap-3">

                            <!-- boutton valider -->
                            <button type="submit" class="btn btn-primary">Valider</button>

                        </div>

                    </form>

                    <!-- boutton supprimer -->
                    <form action="{{route('users.destroy', $user)}}" method="post">
                    @csrf
                    @method("delete ")
                        <button type="submit" class="btn btn-danger">supprimer le compte</button>
                    </form>

                </div>

            </div>
        
        </main>

    @endsection