@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <!-- Event Info Header -->
            <div class="card mb-4 p-2">
                <div class="card-body">
                    <h2 class="mb-3">Register for {{ $event->title }}</h2>
                    <div class="mb-4">
                        <img src="{{ $event->image }}" alt="{{ $event->title }}" class="card-img-top" style="height: 400px; object-fit: cover; border-radius: 12px;">
                    </div>
                    <div class="d-flex gap-3 text-muted">
                        <span><i class="bi bi-calendar-event me-1"></i> {{ $event->start_time->format('M d, Y') }}</span>
                        <span><i class="bi bi-geo-alt me-1"></i> {{ $event->location }}</span>
                    </div>
                </div>
            </div>

            <!-- Registration Form -->
            <form action="{{ route('events.register.store', $event->slug) }}" method="POST" enctype="multipart/form-data" id="registrationForm">
                @csrf

                <!-- First Player Data -->
                <div class="card mb-4">
                    <div class="card-header bg-primary text-white">
                        <h5 class="mb-0"><i class="bi bi-person-fill me-2"></i>First Player</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <x-input.text-field 
                                    name="player1_name"
                                    label="Full Name"
                                    type="text"
                                    placeholder="Enter player name"
                                    :value="auth()->check() ? auth()->user()->name : ''"
                                    :required="true"
                                    :readonly="auth()->check()"
                                />
                            </div>
                            
                            <div class="col-md-6">
                                <x-input.text-field 
                                    name="player1_email"
                                    label="Email Address"
                                    type="email"
                                    placeholder="Enter email"
                                    :value="auth()->check() ? auth()->user()->email : ''"
                                    :required="true"
                                    :readonly="auth()->check()"
                                />
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <x-input.text-field 
                                    name="player1_phone"
                                    label="Phone Number"
                                    type="tel"
                                    placeholder="Enter phone number"
                                    :value="auth()->check() && auth()->user()->player ? auth()->user()->player->phone_number : ''"
                                    :required="true"
                                />
                            </div>

                            <div class="col-md-6">
                                <x-input.text-field 
                                    name="player1_city"
                                    label="City"
                                    type="text"
                                    placeholder="Enter city"
                                    :value="auth()->check() && auth()->user()->player ? auth()->user()->player->city : ''"
                                    :required="true"
                                />
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <x-input.text-field 
                                    name="player1_nik"
                                    label="NIK (16 digits)"
                                    type="text"
                                    placeholder="Enter NIK"
                                    :value="auth()->check() && auth()->user()->player ? auth()->user()->player->nik : ''"
                                    :required="true"
                                    maxlength="16"
                                    :readonly="auth()->check() && auth()->user()->player ? true : false"
                                />
                            </div>

                            <div class="col-md-6">
                                <x-input.select-field 
                                    name="player1_category"
                                    label="Category"
                                    :options="[
                                        '' => 'Select a category',
                                        App\MatchCategories::BEGINNER->value => 'Beginner',
                                        App\MatchCategories::INTERMEDIATE->value => 'Intermediate',
                                        App\MatchCategories::ADVANCED->value => 'Advanced',
                                    ]"
                                    :value="auth()->check() && auth()->user()->player ? auth()->user()->player->category?->value : ''"
                                    :required="true"
                                />
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Second Player Data -->
                <div class="card mb-4">
                    <div class="card-header bg-secondary text-white">
                        <h5 class="mb-0"><i class="bi bi-person-fill me-2"></i>Second Player</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <x-input.text-field 
                                    name="player2_name"
                                    label="Full Name"
                                    type="text"
                                    placeholder="Enter player name"
                                    :required="true"
                                />
                            </div>
                            
                            <div class="col-md-6">
                                <x-input.text-field 
                                    name="player2_email"
                                    label="Email Address"
                                    type="email"
                                    placeholder="Enter email"
                                    :required="true"
                                />
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <x-input.text-field 
                                    name="player2_phone"
                                    label="Phone Number"
                                    type="tel"
                                    placeholder="Enter phone number"
                                    :required="true"
                                />
                            </div>

                            <div class="col-md-6">
                                <x-input.text-field 
                                    name="player2_city"
                                    label="City"
                                    type="text"
                                    placeholder="Enter city"
                                    :required="true"
                                />
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <x-input.text-field 
                                    name="player2_nik"
                                    label="NIK (16 digits)"
                                    type="text"
                                    placeholder="Enter NIK"
                                    :required="true"
                                    maxlength="16"
                                />
                            </div>

                            <div class="col-md-6">
                                <x-input.select-field 
                                    name="player2_category"
                                    label="Category"
                                    :options="[
                                        '' => 'Select a category',
                                        App\MatchCategories::BEGINNER->value => 'Beginner',
                                        App\MatchCategories::INTERMEDIATE->value => 'Intermediate',
                                        App\MatchCategories::ADVANCED->value => 'Advanced',
                                    ]"
                                    :required="true"
                                />
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Payment Evidence -->
                <div class="card mb-4">
                    <div class="card-header bg-success">
                        <h5 class="mb-0 text-white"><i class="bi bi-receipt me-2"></i>Payment Evidence</h5>
                    </div>
                    <div class="card-body">
                        <x-input.image-upload 
                            name="payment_evidence"
                            label="Upload Payment Proof"
                            :required="true"
                            helpText="Upload a screenshot or photo of your payment receipt (max 2MB)"
                        />

                        @if($event->pricings->count() > 0)
                            <div class="alert alert-info mt-3">
                                <h6 class="alert-heading"><i class="bi bi-info-circle me-2"></i>Payment Information</h6>
                                <div class="mb-2"><strong>Available Pricing Options:</strong></div>
                                @foreach($event->pricings as $pricing)
                                    <div class="mb-2">
                                        <strong>{{ $pricing->name }}:</strong> Rp {{ number_format($pricing->price, 0, ',', '.') }}
                                        @if($pricing->description)
                                            <br><small class="text-muted">{{ $pricing->description }}</small>
                                        @endif
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Submit Button -->
                <div class="card">
                    <div class="card-body">
                        <div class="form-check mb-3">
                            <input 
                                class="form-check-input" 
                                type="checkbox" 
                                name="terms" 
                                id="terms" 
                                required
                            >
                            <label class="form-check-label" for="terms">
                                I agree to the terms and conditions and confirm that all information provided is accurate
                            </label>
                        </div>

                        <div class="d-flex gap-2">
                            <a href="{{ route('events.show', $event->slug) }}" class="btn btn-secondary">
                                <i class="bi bi-arrow-left me-2"></i>Back to Event
                            </a>
                            <button type="submit" class="btn btn-primary flex-grow-1">
                                <i class="bi bi-send me-2"></i>Submit Registration
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
