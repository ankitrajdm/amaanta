@extends('admin.layout')

@section('title','Menus')
@section('page-title','Menus')

@section('content')
<div class="row mb-4">
    <div class="col-md-12">
        <h1>Menu Management</h1>
    </div>
</div>

<div class="card">
    <div class="card-body">
        @foreach($menus as $menu)
            <h3>{{ $menu->name }} <small class="text-muted">({{ $menu->location }})</small></h3>
            <ul class="list-group mb-3">
                @foreach($menu->items as $item)
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        {{ $item->label }}
                        <span class="text-muted">{{ $item->url }}</span>
                    </li>
                @endforeach
            </ul>
            <form method="POST" action="{{ route('admin.menus.items.store', $menu) }}" class="row g-2 mb-4">
                @csrf
                <div class="col-md-3">
                    <input name="label" placeholder="Label" required class="form-control">
                </div>
                <div class="col-md-5">
                    <input name="url" placeholder="URL" required class="form-control">
                </div>
                <div class="col-md-2">
                    <input type="number" name="position" value="1" required class="form-control">
                </div>
                <div class="col-md-2">
                    <button class="btn btn-primary">Add</button>
                </div>
            </form>
        @endforeach
    </div>
</div>
@endsection
