@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center mt-5 mb-5">
            <div class="col-md-8 mb-5">
                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <fieldset>
                        <legend>Accédez à votre compte</legend>
                        <div class="form-group row pt-4">
                            <label for="email"
                                class="col-md-4 col-form-label text-md-right">{{ __('Adresse Email') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                                    name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password"
                                class="col-md-4 col-form-label text-md-right">{{ __('Mot de passe') }}</label>
                            <div class="col-md-6">
                                <input id="password" type="password"
                                    class="form-control @error('password') is-invalid @enderror" name="password" required
                                    autocomplete="current-password">

                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-0 pb-4">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="primary-btn my-4">
                                    {{ __('Me connecter') }}
                                </button>
                                <a class="ml-3 btn btn-link" href="{{ route('register') }}">
                                    Pas encore inscrit ?
                                </a>
                            </div>
                        </div>
                    </fieldset>
                </form>
            </div>
        </div>
    </div>
    </div>
@endsection
