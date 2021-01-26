@extends('layouts.layout-blank')

@section('styles')
    <!-- Page -->
    <link rel="stylesheet" href="{{ mix('/vendor/css/pages/authentication.css') }}">
@endsection

@section('content')
<div class="authentication-wrapper authentication-3">
    <div class="authentication-inner">
        <!-- Side container -->
        <!-- Do not display the container on extra small, small and medium screens -->
        <div class="d-none d-lg-flex col-lg-8 align-items-center ui-bg-cover ui-bg-overlay-container p-5" style="background-image: url('/images/bg/1.jpg');">
            <div class="ui-bg-overlay bg-dark opacity-50"></div>

            <!-- Text -->
            <div class="w-100 text-white px-5">
                <h1 class="display-2 font-weight-bolder mb-4"></h1>
                <div class="text-large font-weight-light"></div>
            </div>
            <!-- /.Text -->
        </div>
        <!-- / Side container -->

        <!-- Form container -->
        <div class="d-flex col-lg-4 align-items-center theme-bg-white p-5">
            <!-- Inner container -->
            <!-- Have to add `.d-flex` to control width via `.col-*` classes -->
            <div class="d-flex col-sm-7 col-md-5 col-lg-12 px-0 px-xl-4 mx-auto">
                <div class="w-100">

                    <!-- Logo -->
                    <div class="d-flex justify-content-center align-items-center">
                        <div class="">
                            <div class="position-relative">
                                <img src="/images/esri_logo.jpg" class="col" alt>
                            </div>
                        </div>
                    </div>
                    <!-- / Logo -->
                    <h4 class="text-center text-lighter font-weight-normal mt-2 mb-2">Login LOA</h4>
                    <!-- Form -->
                    <form method="POST" action="{{ route('login') }}">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                        <div class="form-group">
                            <label for="email" class="col-form-label text-md-right">{{ __('E-Mail') }}</label>
                            <div class="">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="password" class="col-form-label text-md-right">{{ __('Contraseña') }}</label>
                            <div class="">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                    <label class="form-check-label" for="remember">
                                        {{ __('Recordarme') }}
                                    </label>
                                </div>
                            </div>
                        </div>
                        <input type="submit" class="btn btn-primary" value="Login"/>
                    </form>
                    <div class="form-group mb-0">
                        <div class="">
                            @if (Route::has('password.request'))
                                <a class="btn btn-link" href="{{ route('password.request') }}">
                                    {{ __('¿Olvidaste tu contraseña?') }}
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- / Form container -->
    </div>
</div>
@endsection
