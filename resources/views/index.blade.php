@extends('layout.app')

@section('content')

    <!-- container -->
    <div class="container-fluid pt-5 d-flex align-items-center justify-content-center flex-column" style="background-image: linear-gradient(to right, #0000001c, #00000000), url('../images/image_fond_2.jpg')" id="index_blade">

        <div class="border-bottom rounded border-2 p-5 border-primary border-top">

            <!-- titre -->
            <div class="text-center mb-3">
                <h1 class="text-light">Bienvenue sur SociaLink</h1>
            </div>
    
            <!-- boutton inscription + connexion -->
            <div class="mt-5justify-content-center text-center boder-bottom">

                <!-- inscription -->
                <a href="register"><button class="btn btn-lg px-5 btn-primary fs-4 mb-4 m-3"><small>Inscription</small></button></a>

                <!-- connexion -->
                <a href="login"><button class="btn btn-lg px-5 btn-primary fs-4 mb-4 m-3"><small>Connexion</small></button></a>

            </div>

        </div>

    </div>

@endsection