@extends('layouts.auth')

@section('content')
<div class="auth-wrapper">
    <div class="auth-container">
        <div class="card card-elevated animate-slideUp">
            <!-- Logo/Title Section -->
            <div class="auth-header">
                <h1>Hello</h1>
                <p class="text-secondary">Sign up with your account</p>
            </div>

            <!-- Step Indicator -->
            <div class="step-indicator">
                <div class="step active" data-step="1">
                    <div class="step-number">1</div>
                    <div class="step-label">Account Info</div>
                </div>
                <div class="step-line"></div>
                <div class="step" data-step="2">
                    <div class="step-number">2</div>
                    <div class="step-label">Player Info</div>
                </div>
            </div>

            <!-- Registration Form -->
            <form method="POST" action="{{ route('register') }}" id="registrationForm">
                @csrf

                <!-- Step 1: User Data -->
                <div class="form-step active" data-step="1">
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
                </div>

                <!-- Step 2: Player Data -->
                <div class="form-step" data-step="2">
                    <!-- Phone Number Field -->
                    <x-input.text-field 
                        name="phone_number"
                        label="Phone Number"
                        type="tel"
                        placeholder="Enter your phone number"
                        :required="true"
                        autocomplete="tel"
                    />

                    <!-- City Field -->
                    <x-input.text-field 
                        name="city"
                        label="City"
                        type="text"
                        placeholder="Enter your city"
                        :required="true"
                        autocomplete="address-level2"
                    />

                    <!-- NIK Field -->
                    <x-input.text-field 
                        name="nik"
                        label="NIK (16 digits)"
                        type="text"
                        placeholder="Enter your NIK"
                        :required="true"
                        maxlength="16"
                    />

                    <!-- Category Field (Optional) -->
                    <x-input.select-field 
                        name="category"
                        label="Category (Optional)"
                        :options="[
                            '' => 'Select a category',
                            App\MatchCategories::BEGINNER->value => 'Beginner',
                            App\MatchCategories::INTERMEDIATE->value => 'Intermediate',
                            App\MatchCategories::ADVANCED->value => 'Advanced',
                        ]"
                        :required="false"
                    />

                    <!-- Instagram Field (Optional) -->
                    <x-input.text-field 
                        name="instagram"
                        label="Instagram (Optional)"
                        type="text"
                        placeholder="Enter your Instagram handle"
                        :required="false"
                    />

                    <!-- Reclub Field (Optional) -->
                    <x-input.text-field 
                        name="reclub"
                        label="Reclub (Optional)"
                        type="text"
                        placeholder="Enter your reclub"
                        :required="false"
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
                </div>

                <!-- Navigation Buttons -->
                <div class="form-navigation">
                    <button type="button" class="btn btn-secondary btn-block" id="prevBtn" style="display: none;">
                        Back
                    </button>
                    <button type="button" class="btn btn-primary btn-block" id="nextBtn">
                        Next
                    </button>
                    <button type="submit" class="btn btn-primary btn-block" id="submitBtn" style="display: none;">
                        Sign Up
                    </button>
                </div>
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

@push('styles')
<style>
    .step-indicator {
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 2rem;
        padding: 0 1rem;
    }

    .step {
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 0.5rem;
        flex: 0 0 auto;
    }

    .step-number {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        background-color: #e2e8f0;
        color: #718096;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 600;
        transition: all 0.3s;
    }

    .step.active .step-number {
        background-color: var(--primary-color, #3b82f6);
        color: white;
    }

    .step.completed .step-number {
        background-color: #10b981;
        color: white;
    }

    .step-label {
        font-size: 0.875rem;
        color: #718096;
        font-weight: 500;
        white-space: nowrap;
    }

    .step.active .step-label {
        color: var(--primary-color, #3b82f6);
    }

    .step-line {
        height: 2px;
        background-color: #e2e8f0;
        flex: 1;
        margin: 0 1rem;
        max-width: 100px;
    }

    .form-step {
        display: none;
    }

    .form-step.active {
        display: block;
        animation: fadeIn 0.3s ease-in;
    }

    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: translateX(20px);
        }
        to {
            opacity: 1;
            transform: translateX(0);
        }
    }

    .form-navigation {
        display: flex;
        gap: 1rem;
        margin-top: 1.5rem;
    }

    .form-navigation .btn {
        flex: 1;
    }
</style>
@endpush

@push('scripts')
<script>
    let currentStep = 1;
    const totalSteps = 2;

    function showStep(step) {
        // Hide all steps
        document.querySelectorAll('.form-step').forEach(el => {
            el.classList.remove('active');
        });

        // Show current step
        document.querySelector(`.form-step[data-step="${step}"]`).classList.add('active');

        // Update step indicator
        document.querySelectorAll('.step').forEach(el => {
            const stepNum = parseInt(el.dataset.step);
            el.classList.remove('active', 'completed');
            
            if (stepNum === step) {
                el.classList.add('active');
            } else if (stepNum < step) {
                el.classList.add('completed');
            }
        });

        // Update buttons
        const prevBtn = document.getElementById('prevBtn');
        const nextBtn = document.getElementById('nextBtn');
        const submitBtn = document.getElementById('submitBtn');

        if (step === 1) {
            prevBtn.style.display = 'none';
            nextBtn.style.display = 'block';
            submitBtn.style.display = 'none';
        } else if (step === totalSteps) {
            prevBtn.style.display = 'block';
            nextBtn.style.display = 'none';
            submitBtn.style.display = 'block';
        } else {
            prevBtn.style.display = 'block';
            nextBtn.style.display = 'block';
            submitBtn.style.display = 'none';
        }
    }

    function validateStep(step) {
        const stepElement = document.querySelector(`.form-step[data-step="${step}"]`);
        const requiredFields = stepElement.querySelectorAll('input[required], select[required]');
        
        let isValid = true;
        requiredFields.forEach(field => {
            if (!field.value.trim()) {
                isValid = false;
                field.focus();
                return false;
            }
        });

        // Validate password confirmation on step 1
        if (step === 1) {
            const password = document.querySelector('input[name="password"]').value;
            const passwordConfirm = document.querySelector('input[name="password_confirmation"]').value;
            
            if (password !== passwordConfirm) {
                alert('Passwords do not match!');
                return false;
            }
        }

        return isValid;
    }

    document.getElementById('nextBtn').addEventListener('click', function() {
        if (validateStep(currentStep)) {
            currentStep++;
            showStep(currentStep);
        }
    });

    document.getElementById('prevBtn').addEventListener('click', function() {
        currentStep--;
        showStep(currentStep);
    });

    // Initialize
    showStep(currentStep);
</script>
@endpush
@endsection
