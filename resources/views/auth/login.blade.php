@extends('layouts.auth')

@push('prepend-script')
<!-- Tambahkan di dalam <head> pada layout utama atau di blade yang relevan -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
@endpush

@section('content')
<div class="page-content page-auth">
    <div class="section-store-auth" data-aos="fade-up">
        <div class="container">
            <div class="row align-items-center row-login">
            <div class="col-lg-6 text-center">
                <img src="/images/login-placeholder.png" alt="" class="w-50 mb-4 mb-lg-none">
            </div>
            <div class="col-lg-5">
                <h2>
                Belanja kebutuhan utama, <br />
                menjadi lebih mudah
                </h2>
                <form method="POST" action="{{ route('login') }}" class="mt-3">
                    @csrf
                    <div class="form-group">
                        <label>Email Address</label>
                        <input id="email" type="email" class="form-control w-75 @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>Password</label>
                        <div class="input-group w-75">
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                            <div class="input-group-append">
                                <span class="input-group-text" id="togglePassword">
                                    <i class="fa fa-eye"></i>
                                </span>
                            </div>
                        </div>
                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        <!-- <input id="password" type="password" class="form-control w-75 @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror -->
                    </div>
                    <a href="{{ route('password.request') }}">
                        {{ __('Forgot Your Password?') }}
                    </a>
                    <a href="{{ route('login') }}">
                        Reset
                    </a>

                    <button type="submit" class="btn btn-success btn-block w-75 mt-4">
                        Sign In to My Account
                    </button>
                    <a href="{{route('register')}}" class="btn btn-signup btn-block w-75 mt-4">
                        Sign Up
                    </a>
                </form>
                <!-- @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}">
                        {{ __('Forgot Your Password?') }}
                    </a>
                @endif -->
            </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('addon-script')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const togglePassword = document.getElementById('togglePassword');
    const passwordField = document.getElementById('password');
    const eyeIcon = togglePassword.querySelector('i');
    
    togglePassword.addEventListener('click', function() {
        // Toggle password visibility
        if (passwordField.type === 'password') {
            passwordField.type = 'text';
            eyeIcon.classList.remove('fa-eye');
            eyeIcon.classList.add('fa-eye-slash');
        } else {
            passwordField.type = 'password';
            eyeIcon.classList.remove('fa-eye-slash');
            eyeIcon.classList.add('fa-eye');
        }
    });
});
</script>
@endpush