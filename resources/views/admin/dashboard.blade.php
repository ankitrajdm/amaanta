@extends('layouts.admin', ['page_title' => 'Dashboard', 'settings' => $settings ?? []])

@section('content')
<style>
    /* Dashboard Styles */
    .dashboard-header {
        margin-bottom: 2rem;
    }

    .dashboard-header h1 {
        font-size: 2.2rem;
        color: #333;
        margin: 0 0 0.5rem 0;
        font-weight: 700;
    }

    .dashboard-header p {
        color: #666;
        font-size: 1rem;
        margin: 0;
    }

    /* Stats Grid */
    .stats-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 1.5rem;
        margin-bottom: 3rem;
    }

    .stat-card {
        background: white;
        border-radius: 8px;
        padding: 1.5rem;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        border-left: 4px solid #667eea;
        transition: all 0.3s ease;
    }

    .stat-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 8px 16px rgba(0, 0, 0, 0.15);
    }

    .stat-card.users { border-left-color: #667eea; }
    .stat-card.pages { border-left-color: #764ba2; }
    .stat-card.posts { border-left-color: #f093fb; }
    .stat-card.testimonials { border-left-color: #4facfe; }
    .stat-card.gallery { border-left-color: #43e97b; }
    .stat-card.enquiries { border-left-color: #fa709a; }

    .stat-card .stat-number {
        font-size: 2.5rem;
        font-weight: 700;
        color: #333;
        margin-bottom: 0.5rem;
    }

    .stat-card .stat-label {
        color: #666;
        font-size: 0.9rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        font-weight: 600;
    }

    /* Modules Grid */
    .modules-section {
        margin-top: 2rem;
    }

    .modules-section h2 {
        font-size: 1.5rem;
        color: #333;
        margin-bottom: 1.5rem;
        font-weight: 700;
    }

    .modules-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
        gap: 1.5rem;
    }

    .module-card {
        background: white;
        border-radius: 8px;
        padding: 1.5rem;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
    }

    .module-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 4px;
        background: linear-gradient(90deg, #667eea, #764ba2);
    }

    .module-card:nth-child(2)::before {
        background: linear-gradient(90deg, #764ba2, #f093fb);
    }

    .module-card:nth-child(3)::before {
        background: linear-gradient(90deg, #f093fb, #4facfe);
    }

    .module-card:nth-child(4)::before {
        background: linear-gradient(90deg, #4facfe, #43e97b);
    }

    .module-card:nth-child(5)::before {
        background: linear-gradient(90deg, #43e97b, #fa709a);
    }

    .module-card:nth-child(6)::before {
        background: linear-gradient(90deg, #fa709a, #667eea);
    }

    .module-card:nth-child(7)::before {
        background: linear-gradient(90deg, #667eea, #764ba2);
    }

    .module-card:nth-child(8)::before {
        background: linear-gradient(90deg, #764ba2, #f093fb);
    }

    .module-card:hover {
        transform: translateY(-6px);
        box-shadow: 0 12px 24px rgba(0, 0, 0, 0.15);
    }

    .module-card h3 {
        color: #333;
        margin: 0.5rem 0 0.8rem 0;
        font-size: 1.1rem;
        font-weight: 600;
    }

    .module-card p {
        color: #666;
        font-size: 0.9rem;
        margin: 0 0 1.2rem 0;
        line-height: 1.5;
    }

    .module-card a {
        display: inline-block;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        padding: 0.7rem 1.5rem;
        border-radius: 6px;
        text-decoration: none;
        font-weight: 600;
        font-size: 0.9rem;
        transition: all 0.3s ease;
    }

    .module-card a:hover {
        transform: translateX(4px);
        box-shadow: 0 4px 12px rgba(102, 126, 234, 0.4);
    }

    .admin-only {
        opacity: 0.9;
    }

    .admin-only::after {
        content: ' (Admin Only)';
        color: #fa709a;
        font-size: 0.8rem;
        font-weight: 600;
    }

    /* Responsive */
    @media (max-width: 768px) {
        .dashboard-header h1 {
            font-size: 1.8rem;
        }

        .stats-grid {
            grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
            gap: 1rem;
        }

        .stat-card {
            padding: 1rem;
        }

        .stat-card .stat-number {
            font-size: 2rem;
        }

        .modules-grid {
            grid-template-columns: 1fr;
        }
    }

    @media (max-width: 480px) {
        .dashboard-header h1 {
            font-size: 1.5rem;
        }

        .stats-grid {
            grid-template-columns: repeat(2, 1fr);
        }

        .module-card h3 {
            font-size: 1rem;
        }

        .module-card p {
            font-size: 0.85rem;
        }
    }
</style>

<section class="section-padding">
    <div class="container">
        <div class="dashboard-header">
            <h1>Admin Dashboard</h1>
            <p>Manage your website content and settings from here</p>
        </div>

        <!-- Statistics Cards -->
        <div class="stats-grid">
    <div class="stat-card users">
        <div class="stat-number">{{ $stats['users'] }}</div>
        <div class="stat-label">Users</div>
    </div>
    <div class="stat-card pages">
        <div class="stat-number">{{ $stats['pages'] }}</div>
        <div class="stat-label">Pages</div>
    </div>
    <div class="stat-card posts">
        <div class="stat-number">{{ $stats['posts'] }}</div>
        <div class="stat-label">Blog Posts</div>
    </div>
    <div class="stat-card testimonials">
        <div class="stat-number">{{ $stats['testimonials'] }}</div>
        <div class="stat-label">Testimonials</div>
    </div>
    <div class="stat-card gallery">
        <div class="stat-number">{{ $stats['gallery'] }}</div>
        <div class="stat-label">Gallery Items</div>
    </div>
    <div class="stat-card enquiries">
        <div class="stat-number">{{ $stats['enquiries'] }}</div>
        <div class="stat-label">Enquiries</div>
    </div>
        </div>

        <!-- Edit Pages & Sections -->
        @if($pages->count() > 0)
        <div class="modules-section">
            <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:1.5rem">
                <h2>Edit Pages & Sections</h2>
                <a href="{{ route('admin.pages.index') }}" class="btn" style="padding:6px 12px; font-size:0.9rem">View All Pages</a>
            </div>
            @foreach($pages as $page)
            <div class="card" style="margin-bottom:1.5rem">
                <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:1rem">
                    <h3 style="margin:0">{{ $page->title }}</h3>
                    <a href="{{ route('admin.pages.edit', $page) }}" class="btn" style="padding:6px 12px; font-size:0.9rem">Edit Page</a>
                </div>
                @foreach($page->sections as $section)
                <div style="background:#f5f5f5; padding:12px; border-radius:6px; margin-bottom:10px">
                    <form method="POST" action="{{ route('admin.sections.update', $section) }}" style="display:flex; gap:8px; align-items:flex-end">
                        @csrf @method('PUT')
                        <div style="flex:1">
                            <label style="font-weight:600; font-size:0.85rem">{{ $section->section_key }}</label>
                            <textarea name="content" placeholder="Section content" style="width:100%; padding:6px; margin-top:4px; font-size:0.9rem">{{ $section->content }}</textarea>
                        </div>
                        <input type="hidden" name="heading" value="{{ $section->heading }}">
                        <input type="hidden" name="position" value="{{ $section->position }}">
                        <button class="btn" type="submit" style="padding:6px 10px; font-size:0.9rem">Save</button>
                    </form>
                </div>
                @endforeach
            </div>
            @endforeach
        </div>
        @endif

        <!-- Edit Blog Posts -->
        @if($posts->count() > 0)
        <div class="modules-section">
            <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:1.5rem">
                <h2>Latest Blog Posts</h2>
                <a href="{{ route('admin.posts.index') }}" class="btn" style="padding:6px 12px; font-size:0.9rem">View All Posts</a>
            </div>
            @foreach($posts as $post)
            <div class="card" style="margin-bottom:1rem; padding:1rem">
                <div style="display:flex; justify-content:space-between; align-items:flex-start; gap:12px">
                    <div style="flex:1">
                        <h4 style="margin:0 0 4px 0">{{ $post->title }}</h4>
                        <p style="color:#666; font-size:0.85rem; margin:0 0 6px 0">{{ $post->category }} — {{ $post->created_at->format('M d, Y') }}</p>
                        <p style="color:#444; font-size:0.9rem; margin:0">{{ \Illuminate\Support\Str::limit($post->excerpt ?? $post->content, 100) }}</p>
                    </div>
                    <a href="{{ route('admin.posts.index') }}" class="btn" style="padding:6px 10px; font-size:0.9rem; white-space:nowrap">Edit</a>
                </div>
            </div>
            @endforeach
        </div>
        @endif

        <!-- Gallery Preview -->
        @if($gallery->count() > 0)
        <div class="modules-section">
            <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:1.5rem">
                <h2>Gallery</h2>
                <a href="{{ route('admin.gallery.index') }}" class="btn" style="padding:6px 12px; font-size:0.9rem">Upload More</a>
            </div>
            <div style="display:grid; grid-template-columns:repeat(auto-fit,minmax(140px,1fr)); gap:12px">
                @foreach($gallery as $image)
                <div style="border-radius:6px; overflow:hidden; box-shadow:0 2px 6px rgba(0,0,0,0.08)">
                    <div style="height:120px; background:#f0f0f0; display:flex; align-items:center; justify-content:center; overflow:hidden">
                        <img src="{{ $image->image_path }}" alt="{{ $image->title }}" style="max-width:100%; max-height:100%">
                    </div>
                    <div style="padding:8px; background:#fff">
                        <div style="font-weight:600; font-size:0.85rem; white-space:nowrap; overflow:hidden; text-overflow:ellipsis">{{ $image->title }}</div>
                        <div style="color:#666; font-size:0.75rem">{{ $image->event_name }}</div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        @endif

        <!-- Testimonials -->
        @if($testimonials->count() > 0)
        <div class="modules-section">
            <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:1.5rem">
                <h2>Client Testimonials</h2>
                <a href="{{ route('admin.testimonials.index') }}" class="btn" style="padding:6px 12px; font-size:0.9rem">Manage All</a>
            </div>
            @foreach($testimonials as $t)
            <div class="card" style="margin-bottom:1rem; padding:1rem; border-left:4px solid #43a047">
                <div style="display:flex; justify-content:space-between; align-items:flex-start; gap:12px">
                    <div style="flex:1">
                        <div style="font-weight:700; color:#333">{{ $t->author_name }}</div>
                        <div style="color:#666; font-size:0.85rem">{{ $t->author_title }}</div>
                        <p style="color:#555; font-size:0.9rem; margin:6px 0 0">{{ \Illuminate\Support\Str::limit($t->quote, 120) }}</p>
                    </div>
                    <a href="{{ route('admin.testimonials.index') }}" class="btn" style="padding:6px 10px; font-size:0.9rem; white-space:nowrap">Edit</a>
                </div>
            </div>
            @endforeach
        </div>
        @endif

        <!-- Modules Section -->
        <div class="modules-section">
            <h2>Module Management</h2>
            <div class="modules-grid">
                <!-- Pages -->
                <div class="module-card">
                    <h3>📄 Pages</h3>
                    <p>Manage website pages and their sections.</p>
                    <a href="{{ route('admin.pages.index') }}">Manage Pages</a>
                </div>

                <!-- Blog Posts -->
                <div class="module-card">
                    <h3>📝 Blog Posts</h3>
                    <p>Create and edit blog articles.</p>
                    <a href="{{ route('admin.posts.index') }}">Manage Posts</a>
                </div>

                <!-- Gallery -->
                <div class="module-card">
                    <h3>🖼️ Gallery</h3>
                    <p>Upload and manage gallery images.</p>
                    <a href="{{ route('admin.gallery.index') }}">Manage Gallery</a>
                </div>

                <!-- Testimonials -->
                <div class="module-card">
                    <h3>⭐ Testimonials</h3>
                    <p>Add and manage testimonials.</p>
                    <a href="{{ route('admin.testimonials.index') }}">Manage Testimonials</a>
                </div>

                <!-- Contact Enquiries -->
                <div class="module-card">
                    <h3>💬 Enquiries</h3>
                    <p>View contact form submissions.</p>
                    <a href="{{ route('admin.enquiries.index') }}">View Enquiries</a>
                </div>

                <!-- Menu Management -->
                <div class="module-card">
                    <h3>🔗 Menu</h3>
                    <p>Manage navigation menus.</p>
                    <a href="{{ route('admin.menus.index') }}">Manage Menu</a>
                </div>

                <!-- Website Settings (Admin Only) -->
                @if(auth()->user()->isAdmin())
                <div class="module-card admin-only">
                    <h3>⚙️ Settings</h3>
                    <p>Configure website settings.</p>
                    <a href="{{ route('admin.settings.index') }}">Website Settings</a>
                </div>
                @endif
            </div>
        </div>
    </div>
</section>

@endsection
