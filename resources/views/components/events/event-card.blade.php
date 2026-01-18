<div class="event-card">
    @if($event->image)
        <div class="event-image">
            <img src="{{ $event->image }}" alt="{{ $event->title }}" class="img-fluid w-100">
        </div>
    @endif
    <div class="event-badge event-badge-{{ strtolower($event->event_type->value) }}">{{ ucwords(str_replace('_', ' ', $event->event_type->value)) }}</div>
    <div class="event-header">
        <h3 class="event-title">{{ $event->title }}</h3>
        <div class="event-date">
            <i class="bi bi-calendar-event"></i>
            <span>
                {{ $event->start_time->format('M d, Y') }} - {{ $event->end_time->format('M d, Y') }}
            </span>
        </div>
        <div class="event-location">
            <i class="bi bi-geo-alt"></i>
            <span>{{ $event->location }}</span>
        </div>
    </div>
    <div class="event-details">
        <div class="event-info">
            <span class="info-label">Category</span>
            <span class="info-value">{{ ucwords($event->category->value) }}</span>
        </div>
        <div class="event-info">
            <span class="info-label">Teams</span>
            <span class="info-value">{{ $event->max_participants }}</span>
        </div>
        <div class="event-info">
            <span class="info-label">Entry Fee</span>
            <span class="info-value">
                @if($event->pricings->count() > 0)
                    @php
                        $minPrice = $event->pricings->min('price');
                        $maxPrice = $event->pricings->max('price');
                    @endphp
                    @if($minPrice === $maxPrice)
                        Rp {{ number_format($minPrice, 0, ',', '.') }}
                    @else
                        Rp {{ number_format($minPrice, 0, ',', '.') }} - Rp {{ number_format($maxPrice, 0, ',', '.') }}
                    @endif
                @else
                    TBA
                @endif
            </span>
        </div>
    </div>
    <a href="{{ $buttonLink }}" class="btn btn-primary w-100">{{ $buttonText }}</a>
</div>