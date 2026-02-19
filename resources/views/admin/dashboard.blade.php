@extends('layouts.app')

@section('content')
<h1>Admin Panel Overview</h1>
<p>All website pages and sections are managed from this panel.</p>
<table border="1" cellpadding="8" cellspacing="0" style="border-collapse:collapse; width:100%;">
    <tr><th>Module</th><th>Action</th></tr>
    <tr><td>Dashboard</td><td><a href="{{ route('admin.dashboard') }}">Open</a></td></tr>
    <tr><td>Pages</td><td><a href="{{ route('admin.pages.index') }}">Manage sections (Home/About/Contact)</a></td></tr>
    <tr><td>Posts / Blog Manager</td><td><a href="{{ route('admin.posts.index') }}">Create / edit / publish posts</a></td></tr>
    <tr><td>Gallery Images</td><td><a href="{{ route('admin.gallery.index') }}">Manage memorybook gallery</a></td></tr>
    <tr><td>Testimonials</td><td><a href="{{ route('admin.testimonials.index') }}">Add / edit testimonials</a></td></tr>
    <tr><td>Contact Form Management</td><td><a href="{{ route('admin.enquiries.index') }}">View all enquiries</a></td></tr>
    <tr><td>Menu</td><td><a href="{{ route('admin.menus.index') }}">Header / footer menu items</a></td></tr>
    @if(auth()->user()->isAdmin())<tr><td>Website Settings</td><td><a href="{{ route('admin.settings.index') }}">Logo, social links, copyright</a></td></tr>@endif
</table>

<ul>
    <li>Users: {{ $stats['users'] }}</li>
    <li>Pages: {{ $stats['pages'] }}</li>
    <li>Posts: {{ $stats['posts'] }}</li>
    <li>Testimonials: {{ $stats['testimonials'] }}</li>
    <li>Gallery Images: {{ $stats['gallery'] }}</li>
    <li>Enquiries: {{ $stats['enquiries'] }}</li>
</ul>
@endsection
