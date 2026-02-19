@extends('layouts.app')
@section('content')
<h1>Website Settings</h1>
<form method="POST" action="{{ route('admin.settings.update') }}">@csrf
@foreach($settings as $setting)
<div><label>{{ $setting->key }} <input name="{{ $setting->key }}" value="{{ $setting->value }}"></label></div>
@endforeach
<button>Save Settings</button>
</form>
@endsection
