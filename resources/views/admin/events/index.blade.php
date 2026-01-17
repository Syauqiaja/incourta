@extends('admin.layouts.app')
@section('content')
    <!-- [ breadcrumb ] start -->
    {{ Breadcrumbs::render('admin.events.index') }}
    <!-- [ breadcrumb ] end -->

    <!-- [ Main Content ] start -->
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Events Management</h5>
                    <a href="{{ route('admin.events.create') }}" class="btn btn-primary">
                        <i class="bi bi-plus-circle me-1"></i> Create New Event
                    </a>
                </div>
                <div class="card-body">
                    @if($events->count() > 0)
                        @foreach($events as $event)
                            <x-admin.event-card :event="$event" />
                        @endforeach
                        
                        <!-- Pagination -->
                        <div class="d-flex justify-content-center mt-4">
                            {{ $events->links() }}
                        </div>
                    @else
                        <div class="text-center py-5">
                            <i class="bi bi-calendar-x" style="font-size: 4rem; color: #ccc;"></i>
                            <h4 class="mt-3 text-muted">No Events Found</h4>
                            <p class="text-muted">Create your first event to get started.</p>
                            <a href="{{ route('admin.events.create') }}" class="btn btn-primary mt-3">
                                <i class="bi bi-plus-circle me-1"></i> Create Event
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <!-- [ Main Content ] end -->
@endsection

@push('scripts')
<script src="{{ asset('assets/js/custom/ajax-request.js') }}"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Handle delete event
        const deleteButtons = document.querySelectorAll('.delete-event-btn');
        
        deleteButtons.forEach(button => {
            button.addEventListener('click', function() {
                const eventId = this.dataset.eventId;
                const eventTitle = this.dataset.eventTitle;
                
                Swal.fire({
                    title: 'Are you sure?',
                    html: `You are about to delete the event <strong>"${eventTitle}"</strong>. This action cannot be undone.`,
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Yes, delete it!',
                    cancelButtonText: 'Cancel'
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Show loading
                        Swal.fire({
                            title: 'Deleting...',
                            text: 'Please wait',
                            allowOutsideClick: false,
                            allowEscapeKey: false,
                            showConfirmButton: false,
                            willOpen: () => {
                                Swal.showLoading();
                            }
                        });
                        
                        // Send delete request
                        fetch(`/admin/events/${eventId}`, {
                            method: 'DELETE',
                            headers: {
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                                'Accept': 'application/json',
                                'Content-Type': 'application/json'
                            }
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Deleted!',
                                    text: data.message,
                                    showConfirmButton: false,
                                    timer: 1500
                                }).then(() => {
                                    window.location.reload();
                                });
                            } else {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Error!',
                                    text: data.message
                                });
                            }
                        })
                        .catch(error => {
                            Swal.fire({
                                icon: 'error',
                                title: 'Error!',
                                text: 'An error occurred while deleting the event'
                            });
                        });
                    }
                });
            });
        });
    });
</script>
@endpush
