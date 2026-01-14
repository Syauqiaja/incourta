<div class="player-card">
    <div class="player-rank">#{{ $rank }}</div>
    <div class="player-avatar">
        <img src="https://ui-avatars.com/api/?name={{ urlencode($name) }}&size=120&background=EAB308&color=fff&bold=true"
            alt="{{ $name }}">
    </div>
    <h4 class="player-name">{{ $name }}</h4>
    <p class="player-category">{{ $category }}</p>
    <div class="player-stats">
        <div class="stat-item">
            <span class="stat-value">{{ $matches }}</span>
            <span class="stat-label">Matches</span>
        </div>
        <div class="stat-item">
            <span class="stat-value">{{ $winRate }}</span>
            <span class="stat-label">Win Rate</span>
        </div>
        <div class="stat-item">
            <span class="stat-value">{{ $titles }}</span>
            <span class="stat-label">Titles</span>
        </div>
    </div>
</div>