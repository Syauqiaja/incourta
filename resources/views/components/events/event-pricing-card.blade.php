<div class="pricing-card mb-3 p-3 border rounded {{ $featured ? 'border-primary bg-light' : '' }}">
    <div class="d-flex justify-content-between align-items-start mb-2">
        <div class="fw-bold">{{ $name }}</div>
        <div class="text-primary fw-bold">Rp {{ number_format($price, 0, ',', '.') }}</div>
    </div>
    @if($description)
        <p class="small text-muted mb-0">{{ $description }}</p>
    @endif
</div>