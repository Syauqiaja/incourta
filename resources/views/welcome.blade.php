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
            <!-- Tournament Card 1 -->
            <div class="col-md-6 col-lg-4">
                <div class="event-card">
                    <div class="event-badge event-badge-tournament">Tournament</div>
                    <div class="event-header">
                        <h3 class="event-title">Summer Championship 2026</h3>
                        <div class="event-date">
                            <i class="bi bi-calendar-event"></i>
                            <span>Feb 15 - Feb 20, 2026</span>
                        </div>
                        <div class="event-location">
                            <i class="bi bi-geo-alt"></i>
                            <span>Padel Arena Jakarta</span>
                        </div>
                    </div>
                    <div class="event-details">
                        <div class="event-info">
                            <span class="info-label">Category</span>
                            <span class="info-value">Mixed Doubles</span>
                        </div>
                        <div class="event-info">
                            <span class="info-label">Teams</span>
                            <span class="info-value">16/32</span>
                        </div>
                        <div class="event-info">
                            <span class="info-label">Prize Pool</span>
                            <span class="info-value">$5,000</span>
                        </div>
                    </div>
                    <a href="#" class="btn btn-primary w-100">Register Now</a>
                </div>
            </div>

            <!-- Tournament Card 2 -->
            <div class="col-md-6 col-lg-4">
                <div class="event-card">
                    <div class="event-badge event-badge-league">League</div>
                    <div class="event-header">
                        <h3 class="event-title">Spring League 2026</h3>
                        <div class="event-date">
                            <i class="bi bi-calendar-event"></i>
                            <span>Feb 1 - Apr 30, 2026</span>
                        </div>
                        <div class="event-location">
                            <i class="bi bi-geo-alt"></i>
                            <span>Multiple Venues</span>
                        </div>
                    </div>
                    <div class="event-details">
                        <div class="event-info">
                            <span class="info-label">Category</span>
                            <span class="info-value">Men's Doubles</span>
                        </div>
                        <div class="event-info">
                            <span class="info-label">Teams</span>
                            <span class="info-value">24/30</span>
                        </div>
                        <div class="event-info">
                            <span class="info-label">Duration</span>
                            <span class="info-value">12 Weeks</span>
                        </div>
                    </div>
                    <a href="#" class="btn btn-primary w-100">Join League</a>
                </div>
            </div>

            <!-- Tournament Card 3 -->
            <div class="col-md-6 col-lg-4">
                <div class="event-card">
                    <div class="event-badge event-badge-tournament">Tournament</div>
                    <div class="event-header">
                        <h3 class="event-title">Beginner's Cup</h3>
                        <div class="event-date">
                            <i class="bi bi-calendar-event"></i>
                            <span>Feb 8 - Feb 9, 2026</span>
                        </div>
                        <div class="event-location">
                            <i class="bi bi-geo-alt"></i>
                            <span>Padel Club Bandung</span>
                        </div>
                    </div>
                    <div class="event-details">
                        <div class="event-info">
                            <span class="info-label">Category</span>
                            <span class="info-value">Beginner</span>
                        </div>
                        <div class="event-info">
                            <span class="info-label">Teams</span>
                            <span class="info-value">8/16</span>
                        </div>
                        <div class="event-info">
                            <span class="info-label">Entry Fee</span>
                            <span class="info-value">Free</span>
                        </div>
                    </div>
                    <a href="#" class="btn btn-primary w-100">Register Now</a>
                </div>
            </div>

            <!-- Tournament Card 4 -->
            <div class="col-md-6 col-lg-4">
                <div class="event-card">
                    <div class="event-badge event-badge-tournament">Tournament</div>
                    <div class="event-header">
                        <h3 class="event-title">Women's Open</h3>
                        <div class="event-date">
                            <i class="bi bi-calendar-event"></i>
                            <span>Mar 5 - Mar 7, 2026</span>
                        </div>
                        <div class="event-location">
                            <i class="bi bi-geo-alt"></i>
                            <span>Padel Center Surabaya</span>
                        </div>
                    </div>
                    <div class="event-details">
                        <div class="event-info">
                            <span class="info-label">Category</span>
                            <span class="info-value">Women's Doubles</span>
                        </div>
                        <div class="event-info">
                            <span class="info-label">Teams</span>
                            <span class="info-value">12/20</span>
                        </div>
                        <div class="event-info">
                            <span class="info-label">Prize Pool</span>
                            <span class="info-value">$3,500</span>
                        </div>
                    </div>
                    <a href="#" class="btn btn-primary w-100">Register Now</a>
                </div>
            </div>

            <!-- League Card -->
            <div class="col-md-6 col-lg-4">
                <div class="event-card">
                    <div class="event-badge event-badge-league">League</div>
                    <div class="event-header">
                        <h3 class="event-title">Elite Division</h3>
                        <div class="event-date">
                            <i class="bi bi-calendar-event"></i>
                            <span>Mar 1 - May 31, 2026</span>
                        </div>
                        <div class="event-location">
                            <i class="bi bi-geo-alt"></i>
                            <span>Premium Courts Jakarta</span>
                        </div>
                    </div>
                    <div class="event-details">
                        <div class="event-info">
                            <span class="info-label">Category</span>
                            <span class="info-value">Advanced</span>
                        </div>
                        <div class="event-info">
                            <span class="info-label">Teams</span>
                            <span class="info-value">18/20</span>
                        </div>
                        <div class="event-info">
                            <span class="info-label">Prize Pool</span>
                            <span class="info-value">$10,000</span>
                        </div>
                    </div>
                    <a href="#" class="btn btn-primary w-100">Join League</a>
                </div>
            </div>

            <!-- Tournament Card 5 -->
            <div class="col-md-6 col-lg-4">
                <div class="event-card">
                    <div class="event-badge event-badge-tournament">Tournament</div>
                    <div class="event-header">
                        <h3 class="event-title">City Championship</h3>
                        <div class="event-date">
                            <i class="bi bi-calendar-event"></i>
                            <span>Mar 20 - Mar 22, 2026</span>
                        </div>
                        <div class="event-location">
                            <i class="bi bi-geo-alt"></i>
                            <span>City Sports Complex</span>
                        </div>
                    </div>
                    <div class="event-details">
                        <div class="event-info">
                            <span class="info-label">Category</span>
                            <span class="info-value">All Categories</span>
                        </div>
                        <div class="event-info">
                            <span class="info-label">Teams</span>
                            <span class="info-value">28/48</span>
                        </div>
                        <div class="event-info">
                            <span class="info-label">Prize Pool</span>
                            <span class="info-value">$8,000</span>
                        </div>
                    </div>
                    <a href="#" class="btn btn-primary w-100">Register Now</a>
                </div>
            </div>
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
                <div class="player-card">
                    <div class="player-rank">#1</div>
                    <div class="player-avatar">
                        <img src="https://ui-avatars.com/api/?name=Juan+Martinez&size=120&background=EAB308&color=fff&bold=true" alt="Juan Martinez">
                    </div>
                    <h4 class="player-name">Juan Martinez</h4>
                    <p class="player-category">Men's Doubles</p>
                    <div class="player-stats">
                        <div class="stat-item">
                            <span class="stat-value">156</span>
                            <span class="stat-label">Matches</span>
                        </div>
                        <div class="stat-item">
                            <span class="stat-value">89%</span>
                            <span class="stat-label">Win Rate</span>
                        </div>
                        <div class="stat-item">
                            <span class="stat-value">12</span>
                            <span class="stat-label">Titles</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Player Card 2 -->
            <div class="col-md-6 col-lg-3">
                <div class="player-card">
                    <div class="player-rank">#2</div>
                    <div class="player-avatar">
                        <img src="https://ui-avatars.com/api/?name=Sofia+Rodriguez&size=120&background=EAB308&color=fff&bold=true" alt="Sofia Rodriguez">
                    </div>
                    <h4 class="player-name">Sofia Rodriguez</h4>
                    <p class="player-category">Women's Doubles</p>
                    <div class="player-stats">
                        <div class="stat-item">
                            <span class="stat-value">142</span>
                            <span class="stat-label">Matches</span>
                        </div>
                        <div class="stat-item">
                            <span class="stat-value">86%</span>
                            <span class="stat-label">Win Rate</span>
                        </div>
                        <div class="stat-item">
                            <span class="stat-value">10</span>
                            <span class="stat-label">Titles</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Player Card 3 -->
            <div class="col-md-6 col-lg-3">
                <div class="player-card">
                    <div class="player-rank">#3</div>
                    <div class="player-avatar">
                        <img src="https://ui-avatars.com/api/?name=Miguel+Santos&size=120&background=EAB308&color=fff&bold=true" alt="Miguel Santos">
                    </div>
                    <h4 class="player-name">Miguel Santos</h4>
                    <p class="player-category">Mixed Doubles</p>
                    <div class="player-stats">
                        <div class="stat-item">
                            <span class="stat-value">138</span>
                            <span class="stat-label">Matches</span>
                        </div>
                        <div class="stat-item">
                            <span class="stat-value">84%</span>
                            <span class="stat-label">Win Rate</span>
                        </div>
                        <div class="stat-item">
                            <span class="stat-value">9</span>
                            <span class="stat-label">Titles</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Player Card 4 -->
            <div class="col-md-6 col-lg-3">
                <div class="player-card">
                    <div class="player-rank">#4</div>
                    <div class="player-avatar">
                        <img src="https://ui-avatars.com/api/?name=Ana+Lopez&size=120&background=EAB308&color=fff&bold=true" alt="Ana Lopez">
                    </div>
                    <h4 class="player-name">Ana Lopez</h4>
                    <p class="player-category">Women's Doubles</p>
                    <div class="player-stats">
                        <div class="stat-item">
                            <span class="stat-value">125</span>
                            <span class="stat-label">Matches</span>
                        </div>
                        <div class="stat-item">
                            <span class="stat-value">81%</span>
                            <span class="stat-label">Win Rate</span>
                        </div>
                        <div class="stat-item">
                            <span class="stat-value">8</span>
                            <span class="stat-label">Titles</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Player Card 5 -->
            <div class="col-md-6 col-lg-3">
                <div class="player-card">
                    <div class="player-rank">#5</div>
                    <div class="player-avatar">
                        <img src="https://ui-avatars.com/api/?name=Carlos+Fernandez&size=120&background=EAB308&color=fff&bold=true" alt="Carlos Fernandez">
                    </div>
                    <h4 class="player-name">Carlos Fernandez</h4>
                    <p class="player-category">Men's Doubles</p>
                    <div class="player-stats">
                        <div class="stat-item">
                            <span class="stat-value">118</span>
                            <span class="stat-label">Matches</span>
                        </div>
                        <div class="stat-item">
                            <span class="stat-value">79%</span>
                            <span class="stat-label">Win Rate</span>
                        </div>
                        <div class="stat-item">
                            <span class="stat-value">7</span>
                            <span class="stat-label">Titles</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Player Card 6 -->
            <div class="col-md-6 col-lg-3">
                <div class="player-card">
                    <div class="player-rank">#6</div>
                    <div class="player-avatar">
                        <img src="https://ui-avatars.com/api/?name=Isabella+Garcia&size=120&background=EAB308&color=fff&bold=true" alt="Isabella Garcia">
                    </div>
                    <h4 class="player-name">Isabella Garcia</h4>
                    <p class="player-category">Mixed Doubles</p>
                    <div class="player-stats">
                        <div class="stat-item">
                            <span class="stat-value">112</span>
                            <span class="stat-label">Matches</span>
                        </div>
                        <div class="stat-item">
                            <span class="stat-value">78%</span>
                            <span class="stat-label">Win Rate</span>
                        </div>
                        <div class="stat-item">
                            <span class="stat-value">6</span>
                            <span class="stat-label">Titles</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Player Card 7 -->
            <div class="col-md-6 col-lg-3">
                <div class="player-card">
                    <div class="player-rank">#7</div>
                    <div class="player-avatar">
                        <img src="https://ui-avatars.com/api/?name=Diego+Ramirez&size=120&background=EAB308&color=fff&bold=true" alt="Diego Ramirez">
                    </div>
                    <h4 class="player-name">Diego Ramirez</h4>
                    <p class="player-category">Men's Doubles</p>
                    <div class="player-stats">
                        <div class="stat-item">
                            <span class="stat-value">105</span>
                            <span class="stat-label">Matches</span>
                        </div>
                        <div class="stat-item">
                            <span class="stat-value">76%</span>
                            <span class="stat-label">Win Rate</span>
                        </div>
                        <div class="stat-item">
                            <span class="stat-value">5</span>
                            <span class="stat-label">Titles</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Player Card 8 -->
            <div class="col-md-6 col-lg-3">
                <div class="player-card">
                    <div class="player-rank">#8</div>
                    <div class="player-avatar">
                        <img src="https://ui-avatars.com/api/?name=Maria+Silva&size=120&background=EAB308&color=fff&bold=true" alt="Maria Silva">
                    </div>
                    <h4 class="player-name">Maria Silva</h4>
                    <p class="player-category">Women's Doubles</p>
                    <div class="player-stats">
                        <div class="stat-item">
                            <span class="stat-value">98</span>
                            <span class="stat-label">Matches</span>
                        </div>
                        <div class="stat-item">
                            <span class="stat-value">74%</span>
                            <span class="stat-label">Win Rate</span>
                        </div>
                        <div class="stat-item">
                            <span class="stat-value">5</span>
                            <span class="stat-label">Titles</span>
                        </div>
                    </div>
                </div>
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