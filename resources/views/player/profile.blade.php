@extends('layouts.app')

@section('content')
<div class="profile-wrapper">
    <div class="profile-container">
        <!-- Profile Header -->
        <div class="card card-elevated animate-slideUp">
            <div class="profile-header">
                <div class="profile-avatar">
                    @if($user->player && $user->player->photo)
                        <img src="{{ url($user->player->photo) }}" alt="{{ $user->name }}">
                    @else
                        <div class="avatar-placeholder">
                            {{ strtoupper(substr($user->name, 0, 2)) }}
                        </div>
                    @endif
                </div>
                <div class="profile-header-info">
                    <h1>{{ $user->name }}</h1>
                    <p class="text-secondary">{{ $user->email }}</p>
                    @if($user->player && $user->player->category)
                        <span class="category-badge category-{{ $user->player->category->value }}">
                            {{ ucfirst($user->player->category->value) }}
                        </span>
                    @endif
                </div>
                <div class="profile-header-actions">
                    <a href="{{ route('player.profile.edit') }}" class="btn btn-secondary btn-sm">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                        </svg>
                        Edit Profile
                    </a>
                </div>
            </div>
        </div>

        <div class="profile-content">
            <!-- Account Information -->
            <div class="card card-elevated animate-slideUp" style="animation-delay: 0.1s">
                <div class="card-header">
                    <h2>Account Information</h2>
                    <p class="text-secondary">Your basic account details</p>
                </div>
                <div class="info-grid">
                    <div class="info-item">
                        <div class="info-label">Full Name</div>
                        <div class="info-value">{{ $user->name }}</div>
                    </div>
                    <div class="info-item">
                        <div class="info-label">Email Address</div>
                        <div class="info-value">{{ $user->email }}</div>
                    </div>
                    <div class="info-item">
                        <div class="info-label">Account Created</div>
                        <div class="info-value">{{ $user->created_at->format('F d, Y') }}</div>
                    </div>
                    <div class="info-item">
                        <div class="info-label">Last Updated</div>
                        <div class="info-value">{{ $user->updated_at->diffForHumans() }}</div>
                    </div>
                </div>
            </div>

            <!-- Player Information -->
            @if($user->player)
                <div class="card card-elevated animate-slideUp" style="animation-delay: 0.2s">
                    <div class="card-header">
                        <h2>Player Information</h2>
                        <p class="text-secondary">Your player profile details</p>
                    </div>
                    <div class="info-grid">
                        <div class="info-item">
                            <div class="info-label">Phone Number</div>
                            <div class="info-value">{{ $user->player->phone_number }}</div>
                        </div>
                        <div class="info-item">
                            <div class="info-label">City</div>
                            <div class="info-value">{{ $user->player->city }}</div>
                        </div>
                        <div class="info-item">
                            <div class="info-label">NIK</div>
                            <div class="info-value">{{ $user->player->nik }}</div>
                        </div>
                        <div class="info-item">
                            <div class="info-label">Category</div>
                            <div class="info-value">
                                @if($user->player->category)
                                    <span class="category-badge category-{{ $user->player->category->value }}">
                                        {{ ucfirst($user->player->category->value) }}
                                    </span>
                                @else
                                    <span class="text-muted">Not set</span>
                                @endif
                            </div>
                        </div>
                        @if($user->player->instagram)
                            <div class="info-item">
                                <div class="info-label">Instagram</div>
                                <div class="info-value">
                                    <a href="https://instagram.com/{{ ltrim($user->player->instagram, '@') }}" target="_blank" class="social-link">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 24 24">
                                            <path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/>
                                        </svg>
                                        {{ $user->player->instagram }}
                                    </a>
                                </div>
                            </div>
                        @endif
                        @if($user->player->reclub)
                            <div class="info-item">
                                <div class="info-label">Reclub</div>
                                <div class="info-value">{{ $user->player->reclub }}</div>
                            </div>
                        @endif
                    </div>
                </div>
            @else
                <div class="card card-elevated animate-slideUp" style="animation-delay: 0.2s">
                    <div class="empty-state">
                        <svg xmlns="http://www.w3.org/2000/svg" width="64" height="64" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                        <h3>No Player Profile</h3>
                        <p class="text-secondary">You haven't set up your player profile yet.</p>
                        <a href="#" class="btn btn-primary">Complete Player Profile</a>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>

@push('styles')
<style>
    .profile-wrapper {
        min-height: 100vh;
        padding: 48px 24px;
        background: #f9fafb;
    }

    .profile-container {
        max-width: 900px;
        margin: 0 auto;
    }

    .profile-header {
        display: flex;
        align-items: center;
        gap: 24px;
        padding: 32px;
    }

    .profile-avatar {
        flex-shrink: 0;
    }

    .profile-avatar img,
    .avatar-placeholder {
        width: 100px;
        height: 100px;
        border-radius: 50%;
        object-fit: cover;
    }

    .avatar-placeholder {
        background: linear-gradient(135deg, #EAB308 0%, #854D0E 100%);
        color: white;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 32px;
        font-weight: 700;
        letter-spacing: 1px;
    }

    .profile-header-info {
        flex: 1;
    }

    .profile-header-info h1 {
        margin-bottom: 4px;
        font-size: 28px;
    }

    .profile-header-info p {
        margin-bottom: 8px;
    }

    .profile-header-actions {
        flex-shrink: 0;
    }

    .btn-sm {
        padding: 10px 16px;
        font-size: 14px;
    }

    .btn-secondary {
        background: white;
        color: #374151;
        border: 1px solid #e2e8f0;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
    }

    .btn-secondary:hover {
        background: #f9fafb;
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
    }

    .category-badge {
        display: inline-block;
        padding: 6px 12px;
        border-radius: 6px;
        font-size: 12px;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .category-beginner {
        background: #d1fae5;
        color: #047857;
    }

    .category-intermediate {
        background: #dbeafe;
        color: #1d4ed8;
    }

    .category-advanced {
        background: #fef3c7;
        color: #b45309;
    }

    .profile-content {
        margin-top: 24px;
        display: flex;
        flex-direction: column;
        gap: 24px;
    }

    .card-header {
        padding: 0 0 20px 0;
        border-bottom: 1px solid #e2e8f0;
        margin-bottom: 24px;
    }

    .card-header h2 {
        margin-bottom: 4px;
        font-size: 20px;
    }

    .card-header p {
        margin: 0;
        font-size: 14px;
    }

    .info-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 24px;
    }

    .info-item {
        display: flex;
        flex-direction: column;
        gap: 8px;
    }

    .info-label {
        font-size: 13px;
        font-weight: 600;
        color: #64748b;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .info-value {
        font-size: 16px;
        color: #1f2937;
        font-weight: 500;
    }

    .text-muted {
        color: #9ca3af;
        font-style: italic;
    }

    .social-link {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        color: #EAB308;
        font-weight: 500;
    }

    .social-link:hover {
        color: #CA8A04;
    }

    .social-link svg {
        flex-shrink: 0;
    }

    .empty-state {
        text-align: center;
        padding: 64px 32px;
    }

    .empty-state svg {
        margin: 0 auto 24px;
        color: #cbd5e1;
    }

    .empty-state h3 {
        margin-bottom: 8px;
        font-size: 20px;
        color: #1f2937;
    }

    .empty-state p {
        margin-bottom: 24px;
        font-size: 14px;
    }

    @media (max-width: 768px) {
        .profile-wrapper {
            padding: 24px 16px;
        }

        .profile-header {
            flex-direction: column;
            text-align: center;
            padding: 24px;
        }

        .profile-header-info {
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .info-grid {
            grid-template-columns: 1fr;
        }

        .profile-avatar img,
        .avatar-placeholder {
            width: 80px;
            height: 80px;
        }

        .avatar-placeholder {
            font-size: 28px;
        }
    }
</style>
@endpush
@endsection
