@extends('layouts.app')
@section('content')
<h1>Menu Management</h1>
@foreach($menus as $menu)
<h3>{{ $menu->name }} ({{ $menu->location }})</h3>
<ul>@foreach($menu->items as $item)<li>{{ $item->label }} → {{ $item->url }}</li>@endforeach</ul>
<form method="POST" action="{{ route('admin.menus.items.store', $menu) }}">@csrf
<input name="label" placeholder="Label" required>
<input name="url" placeholder="URL" required>
<input type="number" name="position" value="1" required>
<button>Add Menu Item</button>
</form>
@endforeach
@endsection
