<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'POS System')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/pos.css') }}">
</head>
<body>
<div class="d-flex min-vh-100">
    @include('partials.sidebar')
    <div class="main-wrapper flex-grow-1">
        @include('partials.navbar')
        <main class="p-4">@yield('content')</main>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
document.querySelectorAll('.sidebar-toggle').forEach(btn => {
    btn.addEventListener('click', () => document.body.classList.toggle('sidebar-collapsed'));
});
</script>
@stack('scripts')
</body>
</html>
