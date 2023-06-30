@extends('layout.app')

@section('content')

    <!-- container -->
    <div class="container-fluid pt-5" style="background-image: linear-gradient(to right, #0000001c, #00000000), url('../images/image_fond.jpg')" id="login_blade">
        <div class="row justify-content-center mt-5 pt-5">
            <div class="col-md-6">

                <!-- card -->
                <div class="text-light border border-light card">

                    <!-- card header -->
                    <div class="card-header border-light">
                        {{ __('Se connecter') }}
                    </div>

                    <!-- card body -->
                    <div class="card-body">

                        <!-- fourmulaire connexion -->
                        <form method="POST" action="{{ route('login') }}">
                        @csrf

                            <!-- email -->
                            <div class="row mb-3 mt-4">
                                <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email') }}</label>

                                <div class="col-md-6">

                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror

                                </div>

                            </div>

                            <!-- mot de passe -->
                            <div class="row mb-3">
                                    
                                <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Mot de passe') }}</label>

                                <div class="col-md-6">
                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror

                                </div>

                            </div>

                            <!-- checkbox 'se souvenir de moi' -->
                            <div class="row mb-3 pt-3">
                                <div class="col-md-6 offset-md-4">
                                    <div class="form-check">

                                        <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                        <label class="form-check-label" for="remember">
                                            {{ __('Se souvenir de moi') }}
                                        </label>

                                    </div>
                                </div>
                            </div>

                            <!-- mot de passe oublié -->
                            <div class="row mb-0">
                                <div class="col-md-8 offset-md-4">

                                    <button type="submit" class="btn btn-primary px-4">
                                        {{ __('Connexion') }}
                                    </button>

                                    @if (Route::has('password.request'))
                                        <a class="btn btn-link" href="{{ route('password.request') }}">
                                            {{ __('Mot de passe oublié ?') }}
                                        </a>
                                    @endif

                                </div>
                            </div>

                        </form>

                    </div>

                </div>
            </div>

        </div>
    </div>

@endsection
