@extends('admin.layouts.app-alpine')
@section('content')
    @include('admin.layouts.datatable')
    <!-- [ breadcrumb ] start -->
    {{ Breadcrumbs::render('admin.home.index') }}
    <!-- [ breadcrumb ] end -->
    <!-- [ Main Content ] start -->
    <div class="row">
        <!-- [ sample-page ] start -->
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between mb-3">
                        <h4>List Matches – {{ $event->title }}</h4>

                        <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#generate-modal">
                            Generate / Regenerate Match
                        </button>

                    </div>
                </div>
                <div class="card-body">
                    <div class="row g-3">
                        <table class="table align-middle" id="table-fixture">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Stage</th>
                                    <th>Team A</th>
                                    <th>Team B</th>
                                    <th>Court</th>
                                    <th>Schedule</th>
                                    <th>Action</th>
                                </tr>
                            </thead>

                            <tbody>
                                {{-- @foreach ($matches as $i => $match)
                                    <tr>
                                        <td>{{ $i + 1 }}</td>
                                        <td>{{ ucfirst($match->stage) }}</td>
                                        <td>{{ $match->teamA->name }}</td>
                                        <td>{{ $match->teamB->name }}</td>
                                        <td>{{ optional($match->schedule->court)->name ?? '-' }}</td>
                                        <td>{{ optional($match->schedule)->scheduled_time ?? '-' }}</td>
                                        <td>
                                            <button class="btn btn-sm btn-primary"
                                                onclick="openScheduleModal({{ $match->id }})">
                                                Set Schedule
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach --}}
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- [ sample-page ] end -->
    </div>
    <!-- [ Main Content ] end -->
@endsection
@section('modal-section')
    @include('admin.fixture.partials.generate-modal')
    {{-- @include('admin.fixture.partials.schedule-modal') --}}
@endsection
@push('scripts')
    <script src="{{ asset('assets/js/custom/ajax-request.js') }}"></script>
    <script>
        $(function() {
            let table = $('#table-fixture').DataTable();
            // approve Payment PC
            initAjaxForm({
                formSelector: '#generate-form',
                modalSelector: '#generate-modal',
                onSuccess: () => {
                    table.draw();
                }
            });
        });

        function initAjaxForm({
            formSelector,
            modalSelector = null,
            onSuccess = null,
            onAfterSuccess = null,
        }) {
            return new AjaxForm(formSelector, {
                showLoader: false,

                beforeSubmit: (form) => {
                    // reset error sebelumnya
                    form.querySelectorAll('.is-invalid').forEach(el => {
                        el.classList.remove('is-invalid');
                    });

                    form.querySelectorAll('.invalid-feedback').forEach(el => {
                        el.remove();
                    });
                    const btnSubmit = form.querySelector('button[type="submit"]');
                    if (!btnSubmit) return;

                    const btnText = btnSubmit.querySelector('.btn-text');
                    const spinner = btnSubmit.querySelector('.spinner-border');

                    btnSubmit.disabled = true;
                    btnText?.classList.add('d-none');
                    spinner?.classList.remove('d-none');
                },

                afterSubmit: (form) => {
                    const btnSubmit = form.querySelector('button[type="submit"]');
                    if (!btnSubmit) return;

                    const btnText = btnSubmit.querySelector('.btn-text');
                    const spinner = btnSubmit.querySelector('.spinner-border');

                    btnSubmit.disabled = false;
                    spinner?.classList.add('d-none');
                    btnText?.classList.remove('d-none');
                },

                onError: (err, form) => {
                    if (!err?.errors) return;

                    // reset error sebelumnya
                    form.querySelectorAll('.is-invalid').forEach(el => {
                        el.classList.remove('is-invalid');
                    });

                    form.querySelectorAll('.invalid-feedback').forEach(el => {
                        el.remove();
                    });

                    Object.entries(err.errors).forEach(([field, messages]) => {
                        const input = form.querySelector(`[name="${field}"]`);
                        if (!input) return;

                        input.classList.add('is-invalid');

                        const wrapper =
                            input.closest('.form-floating, .mb-3') || input.parentElement;

                        const feedback = document.createElement('div');
                        feedback.className = 'invalid-feedback';
                        feedback.textContent = messages[0];

                        wrapper.appendChild(feedback);
                    });
                },

                onSuccess: (data) => {
                    // close modal (optional)
                    if (modalSelector) {
                        $(modalSelector).modal('hide');
                    }

                    // callback success dari luar
                    if (typeof onSuccess === 'function') {
                        onSuccess(data);
                    }

                    // callback tambahan (optional)
                    if (typeof onAfterSuccess === 'function') {
                        onAfterSuccess(data);
                    }
                }
            });
        }
    </script>
@endpush
