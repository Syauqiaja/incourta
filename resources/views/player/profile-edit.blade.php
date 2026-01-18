@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <!-- Page Header -->
            <div class="mb-4">
                <h2><i class="bi bi-person-circle me-2"></i>Edit Profile</h2>
                <p class="text-muted">Update your personal information and preferences</p>
            </div>

            <form action="{{ route('player.profile.update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="row">
                    <!-- Left Column -->
                    <div class="col-lg-4 mb-4">
                        <!-- Profile Picture Card -->
                        <div class="card">
                            <div class="card-body text-center">
                                <h5 class="card-title mb-3">Profile Picture</h5>
                                
                                <!-- Current Avatar Display -->
                                <div class="mb-3">
                                    @if(auth()->user()->player && auth()->user()->player->photo)
                                        <img src="{{ auth()->user()->player->photo }}" alt="Profile Picture" class="rounded-circle img-thumbnail" style="width: 150px; height: 150px; object-fit: cover;" id="avatar-preview">
                                    @else
                                        <div class="bg-secondary text-dark rounded-circle d-inline-flex align-items-center justify-content-center" style="width: 150px; height: 150px; font-size: 60px; font-weight: bold;" id="avatar-placeholder">
                                            {{-- {{ strtoupper(substr(auth()->user()->name, 0, 1)) }} --}}
                                            <img src="" alt="Profile Picture" class="rounded-circle img-thumbnail" style="width: 150px; height: 150px; object-fit: cover; display: none;" id="avatar-preview">
                                        </div>
                                    @endif
                                </div>

                                <!-- Avatar Upload -->
                                <div class="mb-3">
                                    <label for="avatar" class="btn btn-primary btn-sm w-100">
                                        <i class="bi bi-camera me-1"></i>Change Picture
                                    </label>
                                    <input 
                                        type="file" 
                                        id="avatar" 
                                        name="avatar" 
                                        class="d-none @error('avatar') is-invalid @enderror" 
                                        accept="image/*"
                                        onchange="previewAvatar(this)"
                                    >
                                    <small class="text-muted d-block mt-2">Max file size: 2MB</small>
                                    @error('avatar')
                                        <span class="text-danger small d-block mt-1">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Right Column -->
                    <div class="col-lg-8">
                        <!-- Account Information -->
                        <div class="card mb-4">
                            <div class="card-header bg-primary text-white">
                                <h5 class="mb-0"><i class="bi bi-person-fill me-2"></i>Account Information</h5>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <x-input.text-field 
                                            name="name"
                                            label="Full Name"
                                            type="text"
                                            placeholder="Enter your full name"
                                            :value="auth()->user()->name"
                                            :required="true"
                                        />
                                    </div>
                                    
                                    <div class="col-md-6">
                                        <x-input.text-field 
                                            name="email"
                                            label="Email Address"
                                            type="email"
                                            placeholder="Enter your email"
                                            :value="auth()->user()->email"
                                            :required="true"
                                        />
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Player Information -->
                        <div class="card mb-4">
                            <div class="card-header bg-info">
                                <h5 class="mb-0 text-white"><i class="bi bi-clipboard-data me-2"></i>Player Information</h5>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <x-input.text-field 
                                            name="phone_number"
                                            label="Phone Number"
                                            type="tel"
                                            placeholder="Enter your phone number"
                                            :value="auth()->user()->player ? auth()->user()->player->phone_number : ''"
                                            :required="true"
                                        />
                                    </div>

                                    <div class="col-md-6">
                                        <x-input.text-field 
                                            name="city"
                                            label="City"
                                            type="text"
                                            placeholder="Enter your city"
                                            :value="auth()->user()->player ? auth()->user()->player->city : ''"
                                            :required="true"
                                        />
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <x-input.text-field 
                                            name="nik"
                                            label="NIK (16 digits)"
                                            type="text"
                                            placeholder="Enter your NIK"
                                            :value="auth()->user()->player ? auth()->user()->player->nik : ''"
                                            :required="true"
                                            maxlength="16"
                                        />
                                    </div>

                                    <div class="col-md-6">
                                        <x-input.select-field 
                                            name="category"
                                            label="Category"
                                            :options="[
                                                '' => 'Select a category',
                                                App\MatchCategories::BEGINNER->value => 'Beginner',
                                                App\MatchCategories::INTERMEDIATE->value => 'Intermediate',
                                                App\MatchCategories::ADVANCED->value => 'Advanced',
                                            ]"
                                            :value="auth()->user()->player && auth()->user()->player->category ? auth()->user()->player->category->value : ''"
                                            :required="false"
                                        />
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <x-input.text-field 
                                            name="instagram"
                                            label="Instagram"
                                            type="text"
                                            placeholder="Enter your Instagram handle"
                                            :value="auth()->user()->player ? auth()->user()->player->instagram : ''"
                                            :required="false"
                                        />
                                    </div>

                                    <div class="col-md-6">
                                        <x-input.text-field 
                                            name="reclub"
                                            label="Reclub"
                                            type="text"
                                            placeholder="Enter your reclub"
                                            :value="auth()->user()->player ? auth()->user()->player->reclub : ''"
                                            :required="false"
                                        />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Submit Buttons -->
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex gap-2">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="bi bi-save me-2"></i>Save Changes
                                    </button>
                                    <a href="{{ route('player.profile') }}" class="btn btn-secondary">
                                        <i class="bi bi-x-circle me-2"></i>Cancel
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

@push('scripts')
<script>
    function previewAvatar(input) {
        const preview = document.getElementById('avatar-preview');
        const placeholder = document.getElementById('avatar-placeholder');
        
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            
            reader.onload = function(e) {
                preview.src = e.target.result;
                preview.style.display = 'inline-block';
                placeholder.hidden = true;
            }
            
            reader.readAsDataURL(input.files[0]);
        } else {
            if (placeholder) {
                preview.hidden = true;
                preview.src = '';
                placeholder.style.display = 'inline-flex';
            }
        }
    }
</script>
@endpush
@endsection
