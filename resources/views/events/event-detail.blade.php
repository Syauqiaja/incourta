@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <!-- Event Header -->
        <div class="col-12 mb-4">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('events.index') }}">Events</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{ $event->title }}</li>
                </ol>
            </nav>
        </div>

        <!-- Main Event Content -->
        <div class="col-lg-8 mb-4">
            <!-- Event Image -->
            @if($event->image)
                <div class="card mb-4">
                    <img src="{{ $event->image }}" alt="{{ $event->title }}" class="card-img-top" style="height: 400px; object-fit: cover; border-radius: 12px;">
                </div>
            @endif

            <!-- Event Details Card -->
            <div class="card mb-4">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-start mb-3">
                        <h1 class="h2 mb-0">{{ $event->title }}</h1>
                        @php
                            $statusBadgeClass = match($event->status) {
                                \App\Enums\EventStatus::ONGOING => 'success',
                                \App\Enums\EventStatus::COMPLETED => 'danger',
                                default => 'info',
                            };
                        @endphp
                        <span class="badge bg-{{ $statusBadgeClass }} fs-6">
                            {{ ucfirst(str_replace('_', ' ', $event->status->name)) }}
                        </span>
                    </div>
                    
                    <div class="mb-4">
                        <div class="d-flex g-2 align-items-center mb-2">
                            <div class="me-2 event-badge event-badge-{{ strtolower($event->event_type->value) }}">{{ ucfirst(str_replace('_', ' ', $event->event_type->value)) }}</div>
                            <div class="event-badge bg-secondary">{{ ucfirst(str_replace('_', ' ', $event->category->value)) }}</div>
                        </div>
                    </div>

                    <div class="row g-3 mb-4">
                        <div class="col-md-6">
                            <x-events.event-info-item icon="calendar-event" label="Start Date" :value="$event->start_time->format('M d, Y h:i A')" />
                        </div>
                        <div class="col-md-6">
                            <x-events.event-info-item icon="calendar-check" label="End Date" :value="$event->end_time->format('M d, Y h:i A')" />
                        </div>
                        <div class="col-md-6">
                            <x-events.event-info-item icon="geo-alt-fill" label="Location" :value="$event->location" />
                        </div>
                        <div class="col-md-6">
                            <x-events.event-info-item icon="clock" label="Registration Deadline" :value="$event->registration_deadline ? $event->registration_deadline->format('M d, Y') : 'TBA'" />
                        </div>
                    </div>

                    
                    @if ($event->description)
                        <hr class="my-4">
                        <h3 class="mb-3">About This Event</h3>
                        <p class="text-secondary">{{ $event->description }}</p>
                    @endif
                </div>
            </div>

            <!-- Event Statistics -->
            <div class="card">
                <div class="card-body">
                    <h3 class="h5 mb-3">Event Details</h3>
                    <div class="row g-3">
                        <div class="col-md-4">
                            <div class="text-center p-3 bg-light rounded">
                                <i class="bi bi-people-fill text-primary fs-2 mb-2"></i>
                                <div class="fw-bold">{{ $event->max_participants }}</div>
                                <small class="text-muted">Max Teams</small>
                            </div>
                        </div>
                        @if($event->max_group)
                        <div class="col-md-4">
                            <div class="text-center p-3 bg-light rounded">
                                <i class="bi bi-collection-fill text-success fs-2 mb-2"></i>
                                <div class="fw-bold">{{ $event->max_group }}</div>
                                <small class="text-muted">Max Groups</small>
                            </div>
                        </div>
                        @endif
                        @if($event->max_participants_in_group)
                        <div class="col-md-4">
                            <div class="text-center p-3 bg-light rounded">
                                <i class="bi bi-person-fill text-info fs-2 mb-2"></i>
                                <div class="fw-bold">{{ $event->max_participants_in_group }}</div>
                                <small class="text-muted">Players Per Team</small>
                            </div>
                        </div>
                        @endif
                        @if($event->prize_pool)
                        <div class="col-md-4">
                            <div class="text-center p-3 bg-light rounded">
                                <i class="bi bi-trophy-fill text-warning fs-2 mb-2"></i>
                                <div class="fw-bold">Rp {{ number_format($event->prize_pool, 0, ',', '.') }}</div>
                                <small class="text-muted">Prize Pool</small>
                            </div>
                        </div>
                        @endif
                        @if($event->points_win)
                        <div class="col-md-4">
                            <div class="text-center p-3 bg-light rounded">
                                <i class="bi bi-arrow-up-circle-fill text-success fs-2 mb-2"></i>
                                <div class="fw-bold">{{ $event->points_win }}</div>
                                <small class="text-muted">Points for Win</small>
                            </div>
                        </div>
                        @endif
                        @if($event->points_lose)
                        <div class="col-md-4">
                            <div class="text-center p-3 bg-light rounded">
                                <i class="bi bi-arrow-down-circle-fill text-danger fs-2 mb-2"></i>
                                <div class="fw-bold">{{ $event->points_lose }}</div>
                                <small class="text-muted">Points for Loss</small>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <!-- Sidebar -->
        <div class="col-lg-4">
            <!-- Registration Card -->
            <div class="card mb-4 sticky-top" style="top: 20px;">
                <div class="card-body">
                    <h3 class="h5 mb-3">Registration</h3>
                    
                    @if($event->pricings->count() > 0)
                        <div class="mb-3">
                            <h4 class="h6 text-muted mb-3">Pricing Options</h4>
                            @foreach($event->pricings as $pricing)
                                <x-events.event-pricing-card 
                                    :name="$pricing->name"
                                    :price="$pricing->price"
                                    :description="$pricing->description"
                                />
                            @endforeach
                        </div>
                    @else
                        <div class="alert alert-info mb-3">
                            <i class="bi bi-info-circle me-2"></i>
                            Pricing will be announced soon
                        </div>
                    @endif

                    @if(($event->registration_deadline && $event->registration_deadline->isFuture()) || (!$event->registration_deadline && $event->start_time->isFuture()))
                        <a href="{{ route('events.register', $event->slug) }}" class="btn btn-primary w-100 btn-lg">
                            <i class="bi bi-clipboard-check me-2"></i>
                            Register Now
                        </a>
                        <div class="text-center mt-2">
                            <small class="text-muted">
                                <i class="bi bi-clock"></i>
                                @if($event->registration_deadline)
                                    {{ $event->registration_deadline->diffForHumans() }}
                                @else
                                    Registration open until event starts
                                @endif
                            </small>
                        </div>
                    @else
                        <button class="btn btn-secondary w-100 btn-lg" disabled>
                            <i class="bi bi-x-circle me-2"></i>
                            Registration Closed
                        </button>
                    @endif
                </div>
            </div>

            <!-- Organizer Card -->
            @if($event->creator)
            <div class="card">
                <div class="card-body">
                    <h3 class="h6 text-muted mb-3">Organized By</h3>
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0">
                            <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center" style="width: 48px; height: 48px; font-size: 20px; font-weight: bold;">
                                {{ strtoupper(substr($event->creator->name, 0, 1)) }}
                            </div>
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <div class="fw-bold">{{ $event->creator->name }}</div>
                            <small class="text-muted">{{ $event->creator->email }}</small>
                        </div>
                    </div>
                </div>
            </div>
            @endif
        </div>
    </div>
</div>
@endsection
