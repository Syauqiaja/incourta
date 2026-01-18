@php
    use App\MatchCategories;
    use App\Enums\EventStatus;
    use App\EventType;

    $eventStatuses = [];
    $matchCategories = [];
    $eventTypes = [];

    foreach (MatchCategories::cases() as $category) {
        $matchCategories[$category->value] = ucwords(str_replace('_', ' ', $category->value));
    }

    foreach (EventStatus::cases() as $status) {
        $eventStatuses[$status->value] = ucwords(str_replace('_', ' ', $status->value));
    }

    foreach (EventType::cases() as $type) {
        $eventTypes[$type->value] = ucwords(str_replace('_', ' ', $type->value));
    }
@endphp

@extends('admin.layouts.app')
@section('content')
    <!-- [ breadcrumb ] start -->
    {{ Breadcrumbs::render('admin.events.edit', $event) }}
    <!-- [ breadcrumb ] end -->

    <!-- [ Main Content ] start -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h5>Edit Event: {{ $event->title }}</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.events.update', $event->id) }}" method="POST" id="event-form">
                        @csrf
                        @method('PUT')
                        
                        <div class="row">
                            <div class="col-md-8">
                                <x-admin.text-field
                                    name="name"
                                    label="Event Name"
                                    placeholder="Enter event name"
                                    :value="$event->title"
                                    :required="true"
                                    helpText="The name of the event as it will appear to users"
                                />
                            </div>
                            
                          <div class="col-md-4">
                                <x-admin.select-field
                                    name="category"
                                    label="Category"
                                    :options="$matchCategories"
                                    :value="$event->category->value"
                                    placeholder="Select category"
                                    :required="true"
                                />
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-6">
                                <x-admin.text-field
                                    name="start_date"
                                    label="Start Date"
                                    type="datetime-local"
                                    :value="$event->start_time ? $event->start_time->format('Y-m-d\TH:i') : ''"
                                    :required="true"
                                />
                            </div>
                            
                            <div class="col-md-6">
                                <x-admin.text-field
                                    name="end_date"
                                    label="End Date"
                                    type="datetime-local"
                                    :value="$event->end_time ? $event->end_time->format('Y-m-d\TH:i') : ''"
                                    :required="true"
                                />
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-6">
                                <x-admin.text-field
                                    name="location"
                                    label="Location"
                                    type="textarea"
                                    placeholder="Enter event location"
                                    :value="$event->location"
                                    :required="true"
                                />
                            </div>
                        </div>
                        <hr>
                        <div class="row">

                            <div class="col-md-4">
                                <x-admin.select-field
                                    name="type"
                                    label="Event Type"
                                    :options="$eventTypes"
                                    :value="$event->event_type->value"
                                    placeholder="Select event type"
                                    :required="true"
                                />
                            </div>
                            <div class="col-md-4">
                                <x-admin.select-field
                                    name="status"
                                    label="Status"
                                    :options="$eventStatuses"
                                    :value="$event->status->value"
                                    :required="true"
                                />
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4">
                                <x-admin.text-field
                                    name="max_teams"
                                    label="Maximum Teams"
                                    type="number"
                                    placeholder="Enter max teams"
                                    :value="$event->max_participants"
                                    :required="true"
                                    min="2"
                                />
                            </div>
                            <div class="col-md-4" id="max-groups-wrapper" style="display: {{ $event->event_type->value === 'league' ? 'block' : 'none' }};">
                                <x-admin.text-field
                                    name="max_groups"
                                    label="Maximum Groups"
                                    type="number"
                                    placeholder="Enter max groups"
                                    :value="$event->max_group"
                                    min="2"
                                />
                            </div>
                            <div class="col-md-4" id="max-teams-in-group-wrapper" style="display: {{ $event->event_type->value === 'league' ? 'block' : 'none' }};">
                                <x-admin.text-field
                                    name="max_teams_in_group"
                                    label="Maximum Teams in Group"
                                    type="number"
                                    placeholder="Enter max teams in group"
                                    :value="$event->max_participants_in_group"
                                    min="2"
                                />
                            </div>
                        </div>
                        <hr>
                        <div class="mb-3">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <h5 class="mb-0">Event Pricing</h5>
                                <button type="button" class="btn btn-sm btn-primary" id="add-pricing-btn">
                                    <i class="bi bi-plus-circle me-1"></i>Add Pricing Tier
                                </button>
                            </div>
                            
                            <div id="pricing-container">
                                <!-- Existing pricing items will be loaded here -->
                            </div>
                            
                            <small class="text-muted">Add pricing tiers for different registration periods (e.g., Early Bird, Regular, Late Registration)</small>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-12">
                                <x-admin.text-field
                                    name="description"
                                    label="Description"
                                    type="textarea"
                                    placeholder="Enter event description"
                                    :value="$event->description"
                                    helpText="Provide details about the event, rules, prizes, etc."
                                />
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-12">
                                @php
                                    $existingImage = [];
                                    if ($event->image) {
                                        // The image is already stored as full URL like /storage/uploads/events/xxx.png
                                        // We need to extract just the relative path: uploads/events/xxx.png
                                        $imagePath = str_replace('/storage/', '', $event->image);
                                        $existingImage = [$imagePath];
                                    }
                                @endphp
                                <x-admin.image-upload
                                    name="event_images"
                                    label="Event Images"
                                    :maxFiles="1"
                                    :maxFilesize="2"
                                    :existingFiles="$existingImage"
                                    helpText="Upload event photos, posters, or venue images (max 1 image, 2MB)"
                                />
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-6">
                                <x-admin.text-field
                                    name="registration_deadline"
                                    label="Registration Deadline"
                                    type="datetime-local"
                                    :value="$event->registration_deadline ? $event->registration_deadline->format('Y-m-d\TH:i') : ''"
                                    helpText="Optional: Last date for registration"
                                />
                            </div>
                            
                            <div class="col-md-6">
                                <x-admin.text-field
                                    name="prize_pool"
                                    label="Prize Pool"
                                    placeholder="e.g., $5,000 or Trophies & Medals"
                                    :value="$event->prize_pool"
                                    helpText="Optional: Prize information"
                                />
                            </div>
                        </div>
                        
                        <div class="row mt-4">
                            <div class="col-12">
                                <button type="submit" class="btn btn-primary">
                                    <i class="bi bi-save me-2"></i>Update Event
                                </button>
                                <a href="{{ route('admin.events.index') }}" class="btn btn-secondary">
                                    <i class="bi bi-x-circle me-2"></i>Cancel
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- [ Main Content ] end -->
@endsection

@push('scripts')
<script src="{{ asset('assets/js/custom/ajax-request.js') }}"></script>
<script>
    // Pricing management
    let pricingCount = {{ $event->pricings->count() }};
    const pricingContainer = document.getElementById('pricing-container');
    const addPricingBtn = document.getElementById('add-pricing-btn');
    
    // Existing pricings data
    const existingPricings = @json($event->pricings);
    
    function createPricingItem(index, data = null) {
        const pricingItem = document.createElement('div');
        pricingItem.className = 'pricing-item p-3 border rounded mb-3';
        pricingItem.setAttribute('data-pricing-index', index);
        
        const pricingId = data?.id || '';
        const pricingName = data?.name || '';
        const pricingPrice = data?.price || '';
        const pricingStartDate = data?.start_date ? new Date(data.start_date).toISOString().slice(0, 16) : '';
        const pricingEndDate = data?.end_date ? new Date(data.end_date).toISOString().slice(0, 16) : '';
        const pricingDescription = data?.description || '';
        
        pricingItem.innerHTML = `
            ${pricingId ? `<input type="hidden" name="pricing_id[]" value="${pricingId}">` : ''}
            
            <div class="d-flex justify-content-between align-items-center mb-2">
                <h6 class="mb-0">Pricing Tier ${index + 1}</h6>
                <button type="button" class="btn btn-sm btn-danger remove-pricing-btn">
                    <i class="bi bi-trash"></i> Remove
                </button>
            </div>
            
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label">
                            Pricing Title
                            <span class="text-danger">*</span>
                        </label>
                        <input 
                            type="text"
                            class="form-control"
                            name="pricing_name[]"
                            placeholder="e.g., Early Bird, Regular, VIP"
                            value="${pricingName}"
                            required
                        >
                    </div>
                </div>
                
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label">
                            Price (IDR)
                            <span class="text-danger">*</span>
                        </label>
                        <input 
                            type="number"
                            class="form-control"
                            name="pricing_price[]"
                            placeholder="0"
                            min="0"
                            step="1000"
                            value="${pricingPrice}"
                            required
                        >
                    </div>
                </div>
            </div>
            
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label">Start Date</label>
                        <input 
                            type="datetime-local"
                            class="form-control"
                            name="pricing_start_date[]"
                            value="${pricingStartDate}"
                        >
                        <small class="text-muted">When this pricing becomes active</small>
                    </div>
                </div>
                
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label">End Date</label>
                        <input 
                            type="datetime-local"
                            class="form-control"
                            name="pricing_end_date[]"
                            value="${pricingEndDate}"
                        >
                        <small class="text-muted">When this pricing expires</small>
                    </div>
                </div>
            </div>
            
            <div class="row">
                <div class="col-12">
                    <div class="mb-3">
                        <label class="form-label">Description</label>
                        <textarea 
                            class="form-control"
                            name="pricing_description[]"
                            rows="2"
                            placeholder="Optional description for this pricing tier"
                        >${pricingDescription}</textarea>
                    </div>
                </div>
            </div>
        `;
        
        return pricingItem;
    }
    
    function addPricingItem(data = null) {
        const pricingItem = createPricingItem(pricingCount, data);
        pricingContainer.appendChild(pricingItem);
        
        // Add event listener to remove button
        const removeBtn = pricingItem.querySelector('.remove-pricing-btn');
        removeBtn.addEventListener('click', function() {
            removePricingItem(pricingItem);
        });
        
        pricingCount++;
    }
    
    function removePricingItem(item) {
        item.remove();
        updatePricingNumbers();
    }
    
    function updatePricingNumbers() {
        const items = pricingContainer.querySelectorAll('.pricing-item');
        items.forEach((item, index) => {
            item.setAttribute('data-pricing-index', index);
            const title = item.querySelector('h6');
            title.textContent = `Pricing Tier ${index + 1}`;
        });
    }
    
    // Load existing pricing items
    existingPricings.forEach(pricing => {
        addPricingItem(pricing);
    });
    
    // Add pricing button click handler
    addPricingBtn.addEventListener('click', () => addPricingItem());
    
    // Handle event type change to show/hide league-specific fields
    const eventTypeSelect = document.querySelector('select[name="type"]');
    const categorySelect = document.querySelector('select[name="category"]');
    const maxGroupsWrapper = document.getElementById('max-groups-wrapper');
    const maxTeamsInGroupWrapper = document.getElementById('max-teams-in-group-wrapper');
    const maxGroupsInput = document.querySelector('input[name="max_groups"]');
    const maxTeamsInGroupInput = document.querySelector('input[name="max_teams_in_group"]');
    
    function toggleLeagueFields() {
        const selectedType = eventTypeSelect.value;
        
        if (selectedType === 'league') {
            maxGroupsWrapper.style.display = 'block';
            maxTeamsInGroupWrapper.style.display = 'block';
            maxGroupsInput.setAttribute('required', 'required');
            maxTeamsInGroupInput.setAttribute('required', 'required');
        } else {
            maxGroupsWrapper.style.display = 'none';
            maxTeamsInGroupWrapper.style.display = 'none';
            maxGroupsInput.removeAttribute('required');
            maxTeamsInGroupInput.removeAttribute('required');
            maxGroupsInput.value = '';
            maxTeamsInGroupInput.value = '';
        }
    }
    
    // Initialize on page load
    toggleLeagueFields();
    
    // Listen for changes on event type
    eventTypeSelect.addEventListener('change', toggleLeagueFields);
    
    // Listen for changes on category
    categorySelect.addEventListener('change', function() {
        const selectedCategory = this.value;
        console.log('Category changed to:', selectedCategory);
    });
    
    new AjaxForm('#event-form', {
        showLoader: true,
        redirectDelay: 1500,
        beforeSubmit: (form) => {
            // Reset previous errors
            form.querySelectorAll('.is-invalid').forEach(el => {
                el.classList.remove('is-invalid');
            });
            
            form.querySelectorAll('.invalid-feedback').forEach(el => {
                el.remove();
            });
            
            form.querySelector('button[type=submit]').disabled = true;
        },
        afterSubmit: (form) => {
            form.querySelector('button[type=submit]').disabled = false;
        },
        onError: (err, form) => {
            if (!err?.errors) return;
            
            // Reset previous errors
            form.querySelectorAll('.is-invalid').forEach(el => {
                el.classList.remove('is-invalid');
            });
            
            form.querySelectorAll('.invalid-feedback').forEach(el => {
                el.remove();
            });
            
            // Display Laravel validation errors
            Object.entries(err.errors).forEach(([field, messages]) => {
                const input = form.querySelector(`[name="${field}"]`);
                if (!input) return;
                
                input.classList.add('is-invalid');
                
                const wrapper = input.closest('.mb-3') || input.parentElement;
                
                let feedback = wrapper.querySelector('.invalid-feedback');
                if (!feedback) {
                    feedback = document.createElement('div');
                    feedback.className = 'invalid-feedback d-block';
                    wrapper.appendChild(feedback);
                }
                
                feedback.textContent = messages[0];
            });
        }
    });
</script>
@endpush
