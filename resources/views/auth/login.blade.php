@extends('layouts.app')

@section('content')
<section style="padding:2rem; max-width:480px; margin:0 auto;">
    <h1>Admin Login</h1>
    <form method="POST" action="{{ route('login.attempt') }}" style="display:grid; gap:0.8rem;">
        @csrf
        <input type="email" name="email" placeholder="Email" required>
        <input type="password" name="password" placeholder="Password" required>
        <label><input type="checkbox" name="remember"> Remember me</label>
        <button type="submit">Login</button>
    </form>

    @if ($errors->any())
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif
</section>
@endsection
