@extends('admin.layout')

@section('title','Settings')
@section('page-title','Settings')

@section('content')
<div class="row mb-4">
    <div class="col-md-12">
        <h1>Website Settings</h1>
    </div>
</div>

<div class="card">
    <div class="card-body">
        <form method="POST" action="{{ route('admin.settings.update') }}" enctype="multipart/form-data">
            @csrf
            @foreach($settings as $setting)
                <div class="mb-3">
                    <label class="form-label">{{ ucwords(str_replace('_',' ', $setting->key)) }}</label>
                    @if($setting->key === 'logo')
                        @if($setting->value)
                            <div class="mb-2"><img src="{{ $setting->value }}" alt="logo" style="max-height:60px;"></div>
                        @endif
                        <input type="file" name="logo" accept="image/*" class="form-control">
                    @else
                        <input name="{{ $setting->key }}" value="{{ $setting->value }}" class="form-control">
                    @endif
                </div>
            @endforeach
            <button class="btn btn-success">Save Settings</button>
        </form>
    </div>
</div>
@endsection
