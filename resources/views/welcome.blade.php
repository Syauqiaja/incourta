@extends('layouts.app')

@push('styles')
<style>
    /* Remove padding from main content for full-width sections */
    main.py-4 {
        padding: 0 !important;
    }
</style>
@endpush

@section('content')
<!-- Hero Section -->
<section class="hero-section">
    <div class="hero-overlay"></div>
    <div class="hero-content">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8 text-center">
                    <h1 class="hero-title">Welcome to Incourta</h1>
                    <p class="hero-subtitle">Your Premier Padel Tournament & League Platform</p>
                    <p class="hero-description">Join tournaments, track your matches, and compete with the best padel players in your region</p>
                    <div class="hero-actions">
                        <a href="{{ route('register') }}" class="btn btn-primary btn-lg">Get Started</a>
                        <a href="#events" class="btn btn-outline btn-lg">Browse Events</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Event Schedules Section -->
<section class="events-section" id="events">
    <div class="container">
        <div class="section-header text-center">
            <h2>Upcoming Events</h2>
            <p class="text-secondary">Join exciting tournaments and leagues near you</p>
        </div>
        
        <div class="row g-4">
            @foreach ($events as $event)
                <div class="col-md-6 col-lg-4">
                    <x-events.event-card :event="$event"
                    />
                </div>
            @endforeach
        </div>
    </div>
</section>

<!-- Player List Section -->
<section class="players-section">
    <div class="container">
        <div class="section-header text-center">
            <h2>Top Players</h2>
            <p class="text-secondary">Meet the best padel players in our community</p>
        </div>
        
        <div class="row g-4">
            <!-- Player Card 1 -->
            <div class="col-md-6 col-lg-3">
                <x-players.player-card
                    rank="1"
                    name="Juan Martinez"
                    category="Men's Doubles"
                    matches="156"
                    winRate="89%"
                    titles="12"
                />
            </div>

            <!-- Player Card 2 -->
            <div class="col-md-6 col-lg-3">
                <x-players.player-card
                    rank="2"
                    name="Sofia Rodriguez"
                    category="Women's Doubles"
                    matches="142"
                    winRate="86%"
                    titles="10"
                />
            </div>

            <!-- Player Card 3 -->
            <div class="col-md-6 col-lg-3">
                <x-players.player-card
                    rank="3"
                    name="Miguel Santos"
                    category="Mixed Doubles"
                    matches="138"
                    winRate="84%"
                    titles="9"
                />
            </div>

            <!-- Player Card 4 -->
            <div class="col-md-6 col-lg-3">
                <x-players.player-card
                    rank="4"
                    name="Ana Lopez"
                    category="Women's Doubles"
                    matches="125"
                    winRate="81%"
                    titles="8"
                />
            </div>

            <!-- Player Card 5 -->
            <div class="col-md-6 col-lg-3">
                <x-players.player-card
                    rank="5"
                    name="Carlos Fernandez"
                    category="Men's Doubles"
                    matches="118"
                    winRate="79%"
                    titles="7"
                />
            </div>

            <!-- Player Card 6 -->
            <div class="col-md-6 col-lg-3">
                <x-players.player-card
                    rank="6"
                    name="Isabella Garcia"
                    category="Mixed Doubles"
                    matches="112"
                    winRate="78%"
                    titles="6"
                />
            </div>

            <!-- Player Card 7 -->
            <div class="col-md-6 col-lg-3">
                <x-players.player-card
                    rank="7"
                    name="Diego Ramirez"
                    category="Men's Doubles"
                    matches="105"
                    winRate="76%"
                    titles="5"
                />
            </div>

            <!-- Player Card 8 -->
            <div class="col-md-6 col-lg-3">
                <x-players.player-card
                    rank="8"
                    name="Maria Silva"
                    category="Women's Doubles"
                    matches="98"
                    winRate="74%"
                    titles="5"
                />
            </div>
        </div>
    </div>
</section>

<!-- Footer -->
<footer class="footer">
    <div class="container">
        <div class="row g-4">
            <div class="col-lg-4">
                <h5 class="footer-heading">Incourta</h5>
                <p class="footer-text">The premier platform for padel tournaments and leagues. Join thousands of players competing in exciting events across the country.</p>
                <div class="social-links">
                    <a href="#" aria-label="Facebook"><i class="bi bi-facebook"></i></a>
                    <a href="#" aria-label="Twitter"><i class="bi bi-twitter"></i></a>
                    <a href="#" aria-label="Instagram"><i class="bi bi-instagram"></i></a>
                    <a href="#" aria-label="LinkedIn"><i class="bi bi-linkedin"></i></a>
                </div>
            </div>
            <div class="col-lg-2 col-md-6">
                <h5 class="footer-heading">Quick Links</h5>
                <ul class="footer-links">
                    <li><a href="#">Home</a></li>
                    <li><a href="#events">Events</a></li>
                    <li><a href="#">Players</a></li>
                    <li><a href="#">About Us</a></li>
                </ul>
            </div>
            <div class="col-lg-2 col-md-6">
                <h5 class="footer-heading">Events</h5>
                <ul class="footer-links">
                    <li><a href="#">Tournaments</a></li>
                    <li><a href="#">Leagues</a></li>
                    <li><a href="#">Calendar</a></li>
                    <li><a href="#">Results</a></li>
                </ul>
            </div>
            <div class="col-lg-2 col-md-6">
                <h5 class="footer-heading">Support</h5>
                <ul class="footer-links">
                    <li><a href="#">Help Center</a></li>
                    <li><a href="#">Contact Us</a></li>
                    <li><a href="#">FAQs</a></li>
                    <li><a href="#">Privacy Policy</a></li>
                </ul>
            </div>
            <div class="col-lg-2 col-md-6">
                <h5 class="footer-heading">Contact</h5>
                <ul class="footer-contact">
                    <li>
                        <i class="bi bi-envelope"></i>
                        <span>info@incourta.com</span>
                    </li>
                    <li>
                        <i class="bi bi-telephone"></i>
                        <span>+62 21 1234 5678</span>
                    </li>
                    <li>
                        <i class="bi bi-geo-alt"></i>
                        <span>Jakarta, Indonesia</span>
                    </li>
                </ul>
            </div>
        </div>
        <div class="footer-bottom">
            <p>&copy; {{ date('Y') }} Incourta. All rights reserved.</p>
        </div>
    </div>
</footer>
@endsection