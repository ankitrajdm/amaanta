<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? ($settings['website_name'] ?? 'Amaanta') }}</title>
    <link rel="stylesheet" href="{{ asset('assets/css/plugins.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, sans-serif;
            background-color: #f9f9f9;
            color: #333;
            line-height: 1.6;
        }

        nav {
            background: white;
            border-bottom: 1px solid #e0e0e0;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
        }

        nav a, nav button {
            color: #333;
            text-decoration: none;
            font-weight: 500;
            transition: color 0.3s ease;
            padding: 0.5rem 1rem;
            border: none;
            background: none;
            cursor: pointer;
            font-size: 1rem;
        }

        nav a:hover, nav button:hover {
            color: #667eea;
        }

        nav button {
            background: #667eea;
            color: white;
            border-radius: 4px;
            padding: 0.5rem 1rem;
        }

        nav button:hover {
            background: #764ba2;
            color: white;
        }

        main {
            max-width: 1200px;
            margin: 0 auto;
            background: white;
            min-height: calc(100vh - 100px);
            padding: 2rem;
        }

        @media (max-width: 768px) {
            nav {
                padding: 1rem;
                flex-wrap: wrap;
            }

            main {
                padding: 1.5rem;
            }
        }

        @media (max-width: 480px) {
            main {
                padding: 1rem;
            }

            nav a, nav button {
                padding: 0.5rem 0.75rem;
                font-size: 0.9rem;
            }
        }
    </style>
</head>
<body>
<nav style="padding: 1rem 2rem; display: flex; gap: 1rem; flex-wrap: wrap; align-items: center;">
    <a href="{{ route('home') }}" style="font-weight: 700; font-size: 1.1rem;">Home</a>
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
<div style="margin: 1rem 2rem; padding: 1rem; background: #e8f7e8; border-left: 4px solid #43a047; border-radius: 4px; color: #2e7d32;">{{ session('status') }}</div>
@endif
<main>
    @yield('content')
</main>
</body>
</html>
