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
    {{ Breadcrumbs::render('admin.events.create') }}
    <!-- [ breadcrumb ] end -->

    <!-- [ Main Content ] start -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h5>Create New Event</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.events.store') }}" method="POST" id="event-form">
                        @csrf
                        
                        <div class="row">
                            <div class="col-md-8">
                                <x-admin.text-field
                                    name="name"
                                    label="Event Name"
                                    placeholder="Enter event name"
                                    :required="true"
                                    helpText="The name of the event as it will appear to users"
                                />
                            </div>
                            
                          <div class="col-md-4">
                                <x-admin.select-field
                                    name="category"
                                    label="Category"
                                    :options="$matchCategories"
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
                                    :required="true"
                                />
                            </div>
                            
                            <div class="col-md-6">
                                <x-admin.text-field
                                    name="end_date"
                                    label="End Date"
                                    type="datetime-local"
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
                                    placeholder="Select event type"
                                    :required="true"
                                />
                            </div>
                            <div class="col-md-4">
                                <x-admin.select-field
                                    name="status"
                                    label="Status"
                                    :options="$eventStatuses"
                                    value="draft"
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
                                    :required="true"
                                    min="2"
                                />
                            </div>
                            <div class="col-md-4" id="max-groups-wrapper" style="display: none;">
                                <x-admin.text-field
                                    name="max_groups"
                                    label="Maximum Groups"
                                    type="number"
                                    placeholder="Enter max groups"
                                    min="2"
                                />
                            </div>
                            <div class="col-md-4" id="max-teams-in-group-wrapper" style="display: none;">
                                <x-admin.text-field
                                    name="max_teams_in_group"
                                    label="Maximum Teams in Group"
                                    type="number"
                                    placeholder="Enter max teams in group"
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
                                <!-- Pricing items will be added here dynamically -->
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
                                    helpText="Provide details about the event, rules, prizes, etc."
                                />
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-12">
                                <x-admin.image-upload
                                    name="event_images"
                                    label="Event Images"
                                    :maxFiles="1"
                                    :maxFilesize="2"
                                    helpText="Upload event photos, posters, or venue images (max 5 images, 2MB each)"
                                />
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-6">
                                <x-admin.text-field
                                    name="registration_deadline"
                                    label="Registration Deadline"
                                    type="datetime-local"
                                    helpText="Optional: Last date for registration"
                                />
                            </div>
                            
                            <div class="col-md-6">
                                <x-admin.text-field
                                    name="prize_pool"
                                    label="Prize Pool"
                                    placeholder="e.g., $5,000 or Trophies & Medals"
                                    helpText="Optional: Prize information"
                                />
                            </div>
                        </div>
                        
                        <div class="row mt-4">
                            <div class="col-12">
                                <button type="submit" class="btn btn-primary">
                                    <i class="bi bi-send me-2"></i>Create Event
                                </button>
                                <a href="{{ route('admin.events.index') }}" class="btn btn-danger">
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
    let pricingCount = 0;
    const pricingContainer = document.getElementById('pricing-container');
    const addPricingBtn = document.getElementById('add-pricing-btn');
    
    function createPricingItem(index) {
        const pricingItem = document.createElement('div');
        pricingItem.className = 'pricing-item p-3 border rounded mb-3';
        pricingItem.setAttribute('data-pricing-index', index);
        
        pricingItem.innerHTML = `
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
                        ></textarea>
                    </div>
                </div>
            </div>
        `;
        
        return pricingItem;
    }
    
    function addPricingItem() {
        const pricingItem = createPricingItem(pricingCount);
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
    
    // Add pricing button click handler
    addPricingBtn.addEventListener('click', addPricingItem);
    
    // Handle event type change to show/hide league-specific fields
    const eventTypeSelect = document.querySelector('select[name="type"]');
    const categorySelect = document.querySelector('select[name="category"]');
    const maxGroupsWrapper = document.getElementById('max-groups-wrapper');
    const maxTeamsInGroupWrapper = document.getElementById('max-teams-in-group-wrapper');
    const maxGroupsInput = document.querySelector('input[name="max_groups"]');
    const maxTeamsInGroupInput = document.querySelector('input[name="max_teams_in_group"]');
    
    function toggleLeagueFields() {
        const selectedType = eventTypeSelect.value;

        console.log('Event type changed to:', selectedType);
        
        if (selectedType == 'league') {
            if (maxGroupsWrapper) maxGroupsWrapper.style.display = 'block';
            if (maxTeamsInGroupWrapper) maxTeamsInGroupWrapper.style.display = 'block';
            if (maxGroupsInput) maxGroupsInput.setAttribute('required', 'required');
            if (maxTeamsInGroupInput) maxTeamsInGroupInput.setAttribute('required', 'required');
        } else {
            if (maxGroupsWrapper) maxGroupsWrapper.style.display = 'none';
            if (maxTeamsInGroupWrapper) maxTeamsInGroupWrapper.style.display = 'none';
            if (maxGroupsInput) {
                maxGroupsInput.removeAttribute('required');
                maxGroupsInput.value = '';
            }
            if (maxTeamsInGroupInput) {
                maxTeamsInGroupInput.removeAttribute('required');
                maxTeamsInGroupInput.value = '';
            }
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
        // Add your custom logic here based on category selection
        // For example:
        // if (selectedCategory === 'professional') {
        //     // Show/hide certain fields
        // }
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
