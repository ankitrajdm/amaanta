@extends('layouts.admin', ['page_title' => 'Menus', 'settings' => $settings ?? []])

@section('content')
<section class="section-padding">
	<div class="container">
		<div class="card">
			<h2 style="margin-top:0">Menu Management</h2>
			@foreach($menus as $menu)
				<div style="margin-bottom:16px">
					<h3 style="margin:6px 0">{{ $menu->name }} <small style="color:#666">({{ $menu->location }})</small></h3>
					<ul style="list-style:none; padding:0; margin:0 0 8px 0">
						@foreach($menu->items as $item)
							<li style="padding:8px 0; border-bottom:1px solid #f0f0f0">{{ $item->label }} → <span style="color:#666">{{ $item->url }}</span></li>
						@endforeach
					</ul>
					<form method="POST" action="{{ route('admin.menus.items.store', $menu) }}" style="display:flex; gap:8px; align-items:center">
						@csrf
						<input name="label" placeholder="Label" required style="padding:8px; flex:1">
						<input name="url" placeholder="URL" required style="padding:8px; flex:2">
						<input type="number" name="position" value="1" required style="width:80px; padding:8px">
						<button class="btn">Add</button>
					</form>
				</div>
			@endforeach
		</div>
	</div>
</section>
@endsection
