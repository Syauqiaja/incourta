@extends('layouts.auth')

@section('content')
<div class="auth-wrapper">
    <div class="auth-container">
        <div class="card card-elevated animate-slideUp">
            <!-- Logo/Title Section -->
            <div class="auth-header">
                <h1>Welcome Back</h1>
                <p class="text-secondary">Sign in to your account</p>
            </div>

            <!-- Login Form -->
            <form method="POST" action="{{ route('login') }}">
                @csrf

                <!-- Email Field -->
                <x-input.text-field 
                    name="email"
                    label="Email Address"
                    type="email"
                    placeholder="Enter your email"
                    :required="true"
                    autocomplete="email"
                    :autofocus="true"
                />

                <!-- Password Field -->
                <x-input.text-field 
                    name="password"
                    label="Password"
                    type="password"
                    placeholder="Enter your password"
                    :required="true"
                    autocomplete="current-password"
                />

                <!-- Remember Me & Forgot Password -->
                <div class="form-options">
                    <div class="form-check">
                        <input 
                            class="checkbox-input" 
                            type="checkbox" 
                            name="remember" 
                            id="remember" 
                            {{ old('remember') ? 'checked' : '' }}
                        >
                        <label class="checkbox-label" for="remember">
                            Remember me
                        </label>
                    </div>

                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}">
                            Forgot password?
                        </a>
                    @endif
                </div>

                <!-- Submit Button -->
                <button type="submit" class="btn btn-primary btn-block">
                    Sign In
                </button>
            </form>

            <!-- Additional Links -->
            @if (Route::has('register'))
                <div class="auth-footer">
                    <p class="text-secondary">
                        Don't have an account? 
                        <a href="{{ route('register') }}">Sign up</a>
                    </p>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
