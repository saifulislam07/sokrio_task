<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>@yield('title', 'SOKRIO')</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @include('backend.layouts.styles')
    @yield('styles')
    <script src="{{ asset('backend/jquery.min.js') }}"></script>
</head>

<body class="sidebar-mini skin-purple-light sidebar-mini layout-fixed  text-sm">


    @include('backend.layouts.header')
    @include('backend.layouts.sidebar')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        @yield('navbar-content')
        <section class="content">
            <div class="container-fluid">
                @yield('admin-content')
            </div>
        </section>
    </div>


    @include('backend.layouts.footer')
    @include('backend.layouts.scripts')
    @yield('scripts')
</body>

</html>
