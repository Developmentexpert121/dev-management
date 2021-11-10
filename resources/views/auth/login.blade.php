@extends('layouts.app')

@section('content')
<section class="login_form">
<div class="container">
    <div class="row">
        <div class="col-md-6">
            <div class="login-content">
                <h2>Dev Management Tool</h2>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Quis ipsum suspendisse ultrices gravida.cilisis. </p>
                <img src="../../../images/auth/login.png">
            </div>
        </div>
        <div class="col-md-6">
            <div class="card login-card">
                <!-- <div class="card-header">{{ __('Login12') }}</div> -->

                <div class="card-body login-card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="form-head">
                            <h4>Login to screen</h4>
                            <ul>
                                <li><img src="../../../images/auth/google.png"> </li>
                                <li><img src="../../../images/auth/apple.png"> </li>
                                <li><img src="../../../images/auth/window.png"> </li>
                            </ul>
                        </div>
                        <div class="form-group">
                          <div class="form-sec">
                            <label for="email" class="col-form-label text-md-right">{{ __('E-Mail') }}
                            </label>
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group">
                          <div class="form-sec">
                            <label for="password" class="col-form-label text-md-right">{{ __('Password') }}</label>
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row ">
                            <div class="col-md-6">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-6 text-right forget-password">
                                @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif
                            </div>
                        </div>

                        <div class="form-group mb-0">
                            <div class="login-submit-btn">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Login') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</section>
@endsection
