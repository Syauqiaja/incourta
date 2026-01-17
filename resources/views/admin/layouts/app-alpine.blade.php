<!DOCTYPE html>
<html lang="en">

<head>
    @include('admin.layouts.head-meta', ['title' => @$title ?? config('app.name', 'Incourta Padel')])
    @include('admin.layouts.head-css')
    @stack('css')
    @vite(['resources/js/echo.js'])
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>

<body data-pc-preset="preset-1" data-pc-sidebar-theme="light" data-pc-sidebar-caption="true" data-pc-direction="ltr"
    data-pc-theme="light">
    <!-- Bagian Preloader -->
    @include('admin.layouts.preloader')
    <!--  Sweet Alert 2  -->
    @include('sweetalert::alert')
    <!--  Sidebar Menu  -->
    @include('admin.layouts.sidebar')
    <!-- [ Header Topbar ] start -->
    @include('admin.layouts.head-content')
    <!-- [ Main Content ] start -->
    <div class="pc-container">
        <div class="pc-content">
            @yield('content')
        </div>
    </div>
    <!-- [ Main Content ] end -->
    @yield('modal-section')
    @include('admin.layouts.footer-block')
    @include('admin.layouts.footer-js')
    @stack('scripts')
</body>

</html>
