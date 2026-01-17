@props(['event'])

<div class="card mb-3 border">
    <div class="card-body">
        <div class="row align-items-center">
            <div class="col-md-2">
                @if ($event->image)
                    <img src="{{ $event->image }}" alt="{{ $event->title }}" class="img-fluid rounded">
                @else
                    <div class="bg-light rounded d-flex align-items-center justify-content-center" style="height: 120px;">
                        <i class="bi bi-calendar-event text-muted" style="font-size: 3rem;"></i>
                    </div>
                @endif
            </div>

            <div class="col-md-7">
                <div class="d-flex align-items-center gap-2 mb-2">
                    <h5 class="mb-0">{{ $event->title }}</h5>
                    <span
                        class="badge bg-{{ $event->status === 'published' ? 'success' : ($event->status === 'draft' ? 'secondary' : 'warning') }}">
                        {{ ucfirst($event->status) }}
                    </span>
                    <span class="badge bg-primary">{{ ucwords(str_replace('_', ' ', $event->event_type)) }}</span>
                    <span class="badge bg-info">{{ ucwords($event->category) }}</span>
                </div>

                <div class="text-muted small mb-2">
                    <i class="bi bi-calendar-event me-1"></i>
                    {{ \Carbon\Carbon::parse($event->start_time)->format('M d, Y') }} -
                    {{ \Carbon\Carbon::parse($event->end_time)->format('M d, Y') }}
                </div>

                <div class="text-muted small mb-2">
                    <i class="bi bi-geo-alt me-1"></i>
                    {{ $event->location }}
                </div>

                <div class="d-flex gap-3 small">
                    <span>
                        <i class="bi bi-people me-1"></i>
                        <strong>Max Teams:</strong> {{ $event->max_participants }}
                    </span>

                    @if ($event->max_group)
                        <span>
                            <i class="bi bi-grid me-1"></i>
                            <strong>Groups:</strong> {{ $event->max_group }}
                        </span>
                    @endif

                    @if ($event->prize_pool)
                        <span>
                            <i class="bi bi-trophy me-1"></i>
                            <strong>Prize:</strong> {{ $event->prize_pool }}
                        </span>
                    @endif
                </div>

                @if ($event->pricings->count() > 0)
                    <div class="mt-2">
                        <small class="text-muted">
                            <i class="bi bi-tag me-1"></i>
                            {{ $event->pricings->count() }} pricing tier(s)
                        </small>
                    </div>
                @endif
            </div>

            <div class="col-md-3 text-end">
                <div class="d-flex flex-column gap-2">
                    <a href="{{ route('admin.events.show', $event->id) }}" class="btn btn-info btn-sm">
                        <i class="bi bi-eye me-1"></i> View Details
                    </a>
                    <a href="{{ route('admin.events.edit', $event->id) }}" class="btn btn-primary btn-sm">
                        <i class="bi bi-pencil me-1"></i> Edit
                    </a>
                    <a href="{{ route('admin.event.fixture.index', $event->id) }}" class="btn btn-primary btn-sm">
                        <i class="bi bi-card-list me-1"></i> Match Schedule
                    </a>
                    <button type="button" class="btn btn-danger btn-sm delete-event-btn"
                        data-event-id="{{ $event->id }}" data-event-title="{{ $event->title }}">
                        <i class="bi bi-trash me-1"></i> Delete
                    </button>
                </div>

                <div class="mt-3 small text-muted">
                    <div>Created: {{ $event->created_at->format('M d, Y') }}</div>
                    <div>By: {{ $event->creator->name ?? 'Unknown' }}</div>
                </div>
            </div>
        </div>
    </div>
</div>
