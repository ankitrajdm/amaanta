@extends('layouts.app')
@section('content')
<h1>Testimonials</h1>
<form method="POST" action="{{ route('admin.testimonials.store') }}">@csrf
<input name="author_name" placeholder="Author" required>
<input name="author_title" placeholder="Role">
<textarea name="quote" placeholder="Quote" required></textarea>
<label><input type="checkbox" name="is_active" value="1" checked> Active</label>
<button>Add Testimonial</button>
</form>
<ul>@foreach($testimonials as $t)<li>{{ $t->author_name }} - {{ $t->quote }}</li>@endforeach</ul>
@endsection
