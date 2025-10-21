<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <!-- Primary Meta Tags -->
    <title>Volt - Free Bootstrap 5 Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="title" content="Volt - Free Bootstrap 5 Dashboard">
    <meta name="author" content="Themesberg">

    <!-- Favicon -->
    <link rel="apple-touch-icon" sizes="120x120" href="{{ asset('assets-admin/img/favicon/apple-touch-icon.png') }}">
    <link rel="icon" type="image/png" sizes="32x32"
        href="{{ asset('assets-admin/img/favicon/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16"
        href="{{ asset('assets-admin/img/favicon/favicon-16x16.png') }}">
    <link rel="manifest" href="{{ asset('assets-admin/img/favicon/site.webmanifest') }}">
    <link rel="mask-icon" href="{{ asset('assets-admin/img/favicon/safari-pinned-tab.svg') }}" color="#ffffff">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="theme-color" content="#ffffff">

    {{-- Start CSS --}}

    <!-- Volt CSS -->
    @include('layouts.admin.css')
    {{-- End CSS --}}

</head>

<body>
    {{--Start Sidebar --}}
    @include('layouts.admin.sidebar')
    {{-- End Sidebar --}}

    <main class="content">

        {{-- Start Header --}}
        @include('layouts.admin.header')
        {{-- End Header --}}

        {{-- Start Main Content --}}
            @yield('content')
        {{-- End Main Content --}}

        {{-- Start Footer --}}
        @include('layouts.admin.footer')
        {{-- End Footer --}}
    </main>

    {{-- Start JS --}}
    <!-- Core -->
    @include('layouts.admin.js')
    {{-- End JS --}}

</body>

</html>
