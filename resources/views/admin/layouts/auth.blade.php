<!DOCTYPE html>
<html lang="en">

<head>
    @include('admin.layouts.head-meta', ['title' => 'Login Admin Incourta'])
    @include('admin.layouts.head-css')
    @stack('css')

</head>

<body>
    <!-- Bagian Preloader -->
    @include('admin.layouts.preloader')
    <!--  Sweet Alert 2  -->
    @include('sweetalert::alert')

    <!-- [ Main Content ] start -->
    <div class="auth-main">
        <div class="auth-wrapper v3">
            @yield('content')
        </div>
    </div>
    <!-- [ Main Content ] end -->
    @include('admin.layouts.footer-js')
    @stack('scripts')
</body>

</html>
