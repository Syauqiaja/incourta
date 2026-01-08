@extends('layouts.app')

@section('content')
<div class="auth-wrapper">
    <div class="auth-container">
        <div class="card card-elevated animate-slideUp">
            <!-- Logo/Title Section -->
            <div class="auth-header">
                <h1>Hello</h1>
                <p class="text-secondary">Sign up with your account</p>
            </div>

            <!-- Login Form -->
            <form method="POST" action="{{ route('register') }}">
                @csrf

                <!-- Name Field -->
                <x-input.text-field 
                    name="name"
                    label="Full Name"
                    type="text"
                    placeholder="Enter your full name"
                    :required="true"
                    autocomplete="name"
                    :autofocus="true"
                />

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
                    autocomplete="new-password"
                />

                <!-- Password Confirmation Field -->
                <x-input.text-field 
                    name="password_confirmation"
                    label="Confirm Password"
                    type="password"
                    placeholder="Confirm your password"
                    :required="true"
                    autocomplete="new-password"
                />

                <div class="form-options">
                    <div class="form-check">
                        <input 
                            class="checkbox-input" 
                            type="checkbox" 
                            name="terms" 
                            id="terms" 
                            {{ old('terms') ? 'checked' : '' }}
                        >
                        <label class="checkbox-label" for="terms">
                            I agree to the <a href="#">Terms and Conditions</a>
                        </label>
                    </div>
                </div>


                <!-- Submit Button -->
                <button type="submit" class="btn btn-primary btn-block">
                    Sign Up
                </button>
            </form>

            <!-- Additional Links -->
            @if (Route::has('register'))
                <div class="auth-footer">
                    <p class="text-secondary">
                        Already have an account? 
                        <a href="{{ route('login') }}">Sign in</a>
                    </p>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
