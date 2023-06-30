@extends('layout.app')

@section('content')



    <div class="container-fluid pt-5 mt-5" style="background-image: linear-gradient(to right, #0000001c, #00000000), url('../images/image_fond.jpg')" id="register_blade">
        <div class="row justify-content-center mt-5">
            <div class="col-md-6">

                <!-- card -->
                <div class="card text-light border-light">
                    <div class="card-header border-light">{{ __('Inscription') }}</div>

                    <!-- card body -->
                    <div class="card-body mt-4">

                        <!-- formulaire inscription -->
                        <form method="POST" action="{{ route('register') }}"  enctype="multipart/form-data">
                        @csrf

                            <!-- pseudo -->
                            <div class="row mb-3">
                                <label for="pseudo" class="col-md-4 col-form-label text-md-end">{{ __('pseudo') }}</label>

                                <div class="col-md-6">
                                    <input id="pseudo" type="text" class="form-control @error('pseudo') is-invalid @enderror" name="pseudo" value="{{ old('pseudo') }}" required autocomplete="pseudo" autofocus>

                                    @error('pseudo')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <!-- image -->
                            <div class="row mb-3">
                                <label for="image" class="col-md-4 col-form-label text-md-end">{{ __('image') }}</label>

                                <div class="col-md-6">
                                    <input id="image" type="file" class="form-control @error('image') is-invalid @enderror" name="image" value="{{ old('image') }}" required autocomplete="image" autofocus>

                                    @error('image')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <!-- email -->
                            <div class="row mb-3">
                                <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('e-mail') }}</label>

                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

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
                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <!-- confirme mot de passe -->
                            <div class="row mb-3 pb-4">
                                <label for="password-confirm" class="col-md-4 col-form-label text-md-end">{{ __('confirmez le mot de passe') }}</label>

                                <div class="col-md-6">
                                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                                </div>
                            </div>

                            <!-- boutton valider -->
                            <div class="row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary px-4">
                                        {{ __('Valider') }}
                                    </button>
                                </div>
                            </div>

                        </form>

                    </div>

                </div>

            </div>
        </div>
    </div>
    
@endsection
