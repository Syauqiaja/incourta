<div class="event-card">
    <div class="event-badge event-badge-{{ strtolower($type) }}">{{ $type }}</div>
    <div class="event-header">
        <h3 class="event-title">{{ $title }}</h3>
        <div class="event-date">
            <i class="bi bi-calendar-event"></i>
            <span>{{ $dateRange }}</span>
        </div>
        <div class="event-location">
            <i class="bi bi-geo-alt"></i>
            <span>{{ $location }}</span>
        </div>
    </div>
    <div class="event-details">
        <div class="event-info">
            <span class="info-label">Category</span>
            <span class="info-value">{{ $category }}</span>
        </div>
        <div class="event-info">
            <span class="info-label">Teams</span>
            <span class="info-value">{{ $teams }}</span>
        </div>
        <div class="event-info">
            <span class="info-label">Entry Fee</span>
            <span class="info-value">{{ $entryFee }}</span>
        </div>
    </div>
    <a href="{{ $buttonLink }}" class="btn btn-primary w-100">{{ $buttonText }}</a>
</div>