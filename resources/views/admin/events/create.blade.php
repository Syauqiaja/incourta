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
                                    name="type"
                                    label="Event Type"
                                    :options="[
                                        'tournament' => 'Tournament',
                                        'league' => 'League'
                                    ]"
                                    placeholder="Select event type"
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
                                    placeholder="Enter event location"
                                    :required="true"
                                />
                            </div>
                            
                            <div class="col-md-6">
                                <x-admin.select-field
                                    name="category"
                                    label="Category"
                                    :options="[
                                        'beginner' => 'Beginner',
                                        'intermediate' => 'Intermediate',
                                        'advanced' => 'Advanced',
                                        'professional' => 'Professional',
                                        'mixed' => 'Mixed',
                                        'mens' => 'Men\'s',
                                        'womens' => 'Women\'s'
                                    ]"
                                    placeholder="Select category"
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
                            
                            <div class="col-md-4">
                                <x-admin.text-field
                                    name="entry_fee"
                                    label="Entry Fee"
                                    type="number"
                                    placeholder="0"
                                    helpText="Leave 0 for free events"
                                    step="0.01"
                                />
                            </div>
                            
                            <div class="col-md-4">
                                <x-admin.select-field
                                    name="status"
                                    label="Status"
                                    :options="[
                                        'draft' => 'Draft',
                                        'published' => 'Published',
                                        'registration_open' => 'Registration Open',
                                        'registration_closed' => 'Registration Closed',
                                        'ongoing' => 'Ongoing',
                                        'completed' => 'Completed',
                                        'cancelled' => 'Cancelled'
                                    ]"
                                    value="draft"
                                    :required="true"
                                />
                            </div>
                        </div>
                        
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
                                    :maxFiles="5"
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
