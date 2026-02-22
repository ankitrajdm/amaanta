@extends('layouts.admin', ['page_title' => 'Settings', 'settings' => $settings ?? []])

@section('content')
<section class="section-padding">
	<div class="container">
		<div class="card">
			<h2 style="margin-top:0">Website Settings</h2>
			<form method="POST" action="{{ route('admin.settings.update') }}" enctype="multipart/form-data">@csrf
				@foreach($settings as $setting)
					<div style="margin-bottom:10px">
						<label style="display:block; font-weight:600">{{ ucwords(str_replace('_',' ', $setting->key)) }}</label>
						@if($setting->key === 'logo')
							@if($setting->value)
								<div style="margin:6px 0"><img src="{{ $setting->value }}" alt="logo" style="max-height:60px; display:block"></div>
							@endif
							<input type="file" name="logo" accept="image/*" style="margin-top:6px">
						@else
							<input name="{{ $setting->key }}" value="{{ $setting->value }}" style="width:100%; padding:8px; margin-top:6px">
						@endif
					</div>
				@endforeach
				<button class="btn">Save Settings</button>
			</form>
		</div>
	</div>
</section>
@endsection
