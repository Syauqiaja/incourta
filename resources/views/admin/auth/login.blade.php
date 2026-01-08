@extends('admin.layouts.auth')
@section('content')
    <div class="auth-form">
        <div class="card my-5">
            <form action="{{ route('admin.login') }}" method="POST" id="login-form">
                @csrf
                <div class="card-body">
                    <a href="#" class="d-flex justify-content-center">
                        <img src="{{ asset('assets/images/logo-dark.svg') }}" alt="image" class="img-fluid brand-logo" />
                    </a>
                    <div class="row">
                        <div class="d-flex justify-content-center">
                            <div class="auth-header">
                                <h2 class="text-secondary mt-5"><b>Hi, Welcome Back</b></h2>
                                <p class="f-16 mt-2">Enter your credentials to continue</p>
                            </div>
                        </div>
                    </div>

                    <h5 class="my-4 d-flex justify-content-center">Sign in with Email address</h5>
                    <div class="form-floating mb-3">
                        <input type="email" class="form-control" id="email" placeholder="Email address / Username"
                            name="email" />
                        <label for="email">Email address</label>
                    </div>
                    <div class="form-floating mb-3 position-relative">
                        <input type="password" class="form-control" id="password" placeholder="Password" name="password" />

                        <label for="password">Password</label>

                        <!-- Toggle Icon -->
                        <span class="position-absolute top-50 end-0 translate-middle-y me-3" style="cursor:pointer"
                            id="togglePassword">
                            <i class="bi bi-eye-slash" id="passwordIcon"></i>
                        </span>
                    </div>
                    {{-- <div class="form-floating mb-3">
                        <input type="password" class="form-control" id="password" placeholder="Password" name="password" />
                        <label for="password">Password</label>
                    </div> --}}
                    <div class="d-flex mt-1 justify-content-between">
                        <div class="form-check">
                            <input class="form-check-input input-primary" type="checkbox" id="remember" checked=""
                                value="1" name="remember" />
                            <label class="form-check-label text-muted" for="remember">Remember me</label>
                        </div>
                        <h5 class="text-secondary">Forgot Password?</h5>
                    </div>
                    <div class="d-grid mt-4">
                        <button type="submit" class="btn btn-secondary">Sign In</button>
                    </div>

                </div>

            </form>
        </div>
    </div>
@endsection
@pushOnce('scripts')
    <script src="{{ asset('assets/js/custom/ajax-request.js') }}"></script>
    <script>
        new AjaxForm('#login-form', {
            showLoader: false,
            beforeSubmit: (form) => {
                form.querySelector('button[type=submit]').disabled = true;
            },
            afterSubmit: () => {
                document.querySelector('button[type=submit]').disabled = false;
            },
            onError: (err, form) => {
                console.log(err.errors)
                // Laravel validation error
                Object.entries(err.errors).forEach(([field, messages]) => {
                    const input = form.querySelector(`[name="${field}"]`);
                    if (!input) return;

                    input.classList.add('is-invalid');

                    const wrapper =
                        input.closest('.form-floating, .mb-3') || input.parentElement;

                    let feedback = wrapper.querySelector('.invalid-feedback');
                    if (!feedback) {
                        feedback = document.createElement('div');
                        feedback.className = 'invalid-feedback';
                        wrapper.appendChild(feedback);
                    }

                    feedback.textContent = messages[0];
                });

                return;

            }
        });
        document.getElementById('togglePassword').addEventListener('click', function() {
            const passwordInput = document.getElementById('password');
            const icon = document.getElementById('passwordIcon');

            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                icon.classList.remove('bi-eye-slash');
                icon.classList.add('bi-eye');
            } else {
                passwordInput.type = 'password';
                icon.classList.remove('bi-eye');
                icon.classList.add('bi-eye-slash');
            }
        });
    </script>
@endPushOnce
