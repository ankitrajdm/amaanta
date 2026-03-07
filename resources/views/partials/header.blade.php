@php
    $headerMenu = \App\Models\Menu::where('location', 'header')->with('items')->first();
    $headerItems = $headerMenu ? $headerMenu->items->sortBy('position') : collect();
@endphp
<nav class="navbar navbar-expand-lg">
    <div class="container">
        <!-- Logo (same as home) -->
        <div class="logo-wrapper">
            <a class="logo" href="{{ route('home') }}"> 
                @if($settings['logo'] ?? null)
                    <img src="{{ asset($settings['logo']) }}" class="logo-img" alt="{{ $settings['website_name'] ?? 'Amaanta' }}">
                @else
                    {{ $settings['website_name'] ?? 'Amaanta' }}
                @endif
            </a>
        </div>
        <!-- Toggler with icon from home template -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar" aria-controls="navbar" aria-expanded="false" aria-label="Toggle navigation"> 
            <span class="navbar-toggler-icon"><i class="ti-menu"></i></span> 
        </button>
        <!-- Menu links -->
        <div class="collapse navbar-collapse" id="navbar">
            <ul class="navbar-nav ms-auto">
                @forelse($headerItems as $item)
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is(ltrim($item->url, '/')) ? 'active' : '' }}" href="{{ $item->url }}">{{ $item->label }}</a>
                    </li>
                @empty
                    <li class="nav-item"><a class="nav-link" href="{{ route('home') }}">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('about') }}">About</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('services') }}">Services</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('gallery') }}">Memorybook</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('contact') }}">Contact</a></li>
                @endforelse
                @auth
                    <li class="nav-item">
                        <a class="nav-link" href="/admin/dashboard">Admin</a>
                    </li>
                    <li class="nav-item">
                        <form action="/logout" method="POST" style="display:inline;">
                            @csrf
                            <button type="submit" class="btn btn-sm btn-outline-danger ms-2">Logout</button>
                        </form>
                    </li>
                @else
                    <li class="nav-item">
                        <a class="nav-link" href="/login">Login</a>
                    </li>
                @endauth
            </ul>
        </div>
    </div>
</nav>