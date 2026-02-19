<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? ($settings['website_name'] ?? 'Amaanta') }}</title>
    <link rel="stylesheet" href="{{ asset('assets/css/plugins.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
</head>
<body>
<nav style="padding: 1rem; background: #f5f5f5; display: flex; gap: 1rem; flex-wrap:wrap;">
    <a href="{{ route('home') }}">Home</a>
    <a href="{{ route('about') }}">About</a>
    <a href="{{ route('contact') }}">Contact</a>
    @auth
        <a href="{{ route('admin.dashboard') }}">Admin Panel</a>
        <form action="{{ route('logout') }}" method="POST" style="display:inline;">@csrf<button type="submit">Logout</button></form>
    @else
        <a href="{{ route('login') }}">Login</a>
    @endauth
</nav>
@if (session('status'))
<div style="margin:1rem; padding:0.75rem; background:#e8f7e8;">{{ session('status') }}</div>
@endif
<main style="padding: 1rem;">
    @yield('content')
</main>
</body>
</html>
