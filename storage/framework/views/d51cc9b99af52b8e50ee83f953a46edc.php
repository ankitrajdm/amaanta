

<?php $__env->startSection('title', 'Dashboard'); ?>

<?php $__env->startSection('content'); ?>
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

    /* Calendar Styles */
    .calendar-container {
        background: white;
        border-radius: 8px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        padding: 1.5rem;
        margin-bottom: 2rem;
    }

    .calendar-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 1.5rem;
    }

    .calendar-header h2 {
        margin: 0;
        color: #333;
        font-size: 1.3rem;
        font-weight: 600;
    }

    .calendar-controls {
        display: flex;
        gap: 0.5rem;
        align-items: center;
    }

    .calendar-controls button {
        background: #3498db;
        color: white;
        border: none;
        padding: 0.5rem 1rem;
        border-radius: 4px;
        cursor: pointer;
        font-size: 0.9rem;
        font-weight: 500;
        transition: all 0.3s ease;
    }

    .calendar-controls button:hover {
        background: #2980b9;
        transform: translateY(-2px);
    }

    .calendar-controls button.active {
        background: #667eea;
    }

    .calendar-wrapper {
        position: relative;
    }

    .fc {
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    .fc-button-primary {
        background-color: #3498db !important;
        border-color: #3498db !important;
    }

    .fc-button-primary:not(:disabled):hover {
        background-color: #2980b9 !important;
        border-color: #2980b9 !important;
    }

    .fc-button-primary.fc-button-active {
        background-color: #667eea !important;
        border-color: #667eea !important;
    }

    .fc .fc-button-group > button {
        border: 1px solid #3498db;
    }

    .fc .fc-dayGridMonth-view .fc-daygrid-day,
    .fc .fc-daygrid-day {
        background-color: #fff;
        border: 1px solid #e0e0e0;
    }

    .fc .fc-daygrid-day.fc-day-other {
        background-color: #f9f9f9;
    }

    .fc .fc-daygrid-day:hover {
        background-color: #f5f5f5;
    }

    .fc .fc-daygrid-day-number {
        padding: 6px 4px;
        font-weight: 600;
        color: #333;
    }

    .fc .fc-event {
        border-radius: 4px;
        cursor: pointer;
        transition: all 0.2s ease;
        border: none !important;
        padding: 2px 4px;
    }

    .fc .fc-event:hover {
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
    }

    .fc .fc-event-title {
        font-size: 0.8rem;
        font-weight: 600;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
    }

    .fc .fc-col-header-cell {
        background-color: #f5f5f5;
        border-color: #e0e0e0;
        font-weight: 700;
        padding: 10px 0;
        color: #333;
    }

    .fc .fc-daygrid-body {
        border-color: #e0e0e0;
    }

    /* Booking Event Colors */
    .fc-event-primary {
        background-color: #FFC107 !important;
        border-color: #FFC107 !important;
    }

    .fc-event-success {
        background-color: #28A745 !important;
        border-color: #28A745 !important;
    }

    .fc-event-info {
        background-color: #17A2B8 !important;
        border-color: #17A2B8 !important;
    }

    .fc-event-danger {
        background-color: #DC3545 !important;
        border-color: #DC3545 !important;
    }

    .event-tooltip {
        background: white;
        padding: 12px;
        border-radius: 6px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        z-index: 1000;
    }

    .event-tooltip p {
        margin: 4px 0;
        font-size: 0.85rem;
    }

    .event-tooltip .name {
        font-weight: 600;
        color: #333;
    }

    .event-tooltip .status {
        padding: 2px 8px;
        border-radius: 3px;
        font-size: 0.75rem;
        font-weight: 600;
        display: inline-block;
        margin-top: 4px;
    }

    .event-tooltip .status.pending { background-color: #FFC107; color: #000; }
    .event-tooltip .status.confirmed { background-color: #28A745; color: white; }
    .event-tooltip .status.completed { background-color: #17A2B8; color: white; }
    .event-tooltip .status.cancelled { background-color: #DC3545; color: white; }

</style>

<section class="section-padding">
    <div class="container">
        <div class="dashboard-header">
            <h1>Admin Dashboard</h1>
            <p>Manage your website content and settings from here</p>
        </div>

        <!-- Bookings Calendar -->
        <div class="calendar-container">
            <div class="calendar-header">
                <h2><i class="fas fa-calendar"></i> Bookings Calendar</h2>
                <div class="calendar-controls">
                    <button onclick="changeCalendarView('dayGridDay')" class="view-btn" data-view="dayGridDay" title="Daily View">
                        <i class="fas fa-sun"></i> Day
                    </button>
                    <button onclick="changeCalendarView('timeGridWeek')" class="view-btn" data-view="timeGridWeek" title="Weekly View">
                        <i class="fas fa-calendar-week"></i> Week
                    </button>
                    <button onclick="changeCalendarView('dayGridMonth')" class="view-btn active" data-view="dayGridMonth" title="Monthly View">
                        <i class="fas fa-calendar-alt"></i> Month
                    </button>
                    <button onclick="changeCalendarView('listMonth')" class="view-btn" data-view="listMonth" title="Yearly/List View">
                        <i class="fas fa-list"></i> List
                    </button>
                </div>
            </div>
            <div class="calendar-wrapper">
                <div id="bookingsCalendar"></div>
            </div>
        </div>

        <!-- Statistics Cards -->
        <div class="stats-grid">
    <div class="stat-card users">
        <div class="stat-number"><?php echo e($stats['users']); ?></div>
        <div class="stat-label">Users</div>
    </div>
    <div class="stat-card pages">
        <div class="stat-number"><?php echo e($stats['pages']); ?></div>
        <div class="stat-label">Pages</div>
    </div>
    <div class="stat-card posts">
        <div class="stat-number"><?php echo e($stats['posts']); ?></div>
        <div class="stat-label">Blog Posts</div>
    </div>
    <div class="stat-card testimonials">
        <div class="stat-number"><?php echo e($stats['testimonials']); ?></div>
        <div class="stat-label">Testimonials</div>
    </div>
    <div class="stat-card gallery">
        <div class="stat-number"><?php echo e($stats['gallery']); ?></div>
        <div class="stat-label">Gallery Items</div>
    </div>
    <div class="stat-card enquiries">
        <div class="stat-number"><?php echo e($stats['enquiries']); ?></div>
        <div class="stat-label">Enquiries</div>
    </div>
    <div class="stat-card" style="border-left-color: #FF6B6B;">
        <div class="stat-number"><?php echo e($stats['bookings']); ?></div>
        <div class="stat-label">Bookings</div>
    </div>
        </div>

        <!-- Edit Pages & Sections -->
        <?php if($pages->count() > 0): ?>
        <div class="modules-section">
            <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:1.5rem">
                <h2>Edit Pages & Sections</h2>
                <a href="<?php echo e(route('admin.pages.index')); ?>" class="btn" style="padding:6px 12px; font-size:0.9rem">View All Pages</a>
            </div>
            <?php $__currentLoopData = $pages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $page): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="card" style="margin-bottom:1.5rem">
                <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:1rem">
                    <h3 style="margin:0"><?php echo e($page->title); ?></h3>
                    <a href="<?php echo e(route('admin.pages.edit', $page)); ?>" class="btn" style="padding:6px 12px; font-size:0.9rem">Edit Page</a>
                </div>
                <?php $__currentLoopData = $page->sections; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $section): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div style="background:#f5f5f5; padding:12px; border-radius:6px; margin-bottom:10px">
                    <form method="POST" action="<?php echo e(route('admin.sections.update', $section)); ?>" style="display:flex; gap:8px; align-items:flex-end">
                        <?php echo csrf_field(); ?> <?php echo method_field('PUT'); ?>
                        <div style="flex:1">
                            <label style="font-weight:600; font-size:0.85rem"><?php echo e($section->section_key); ?></label>
                            <textarea name="content" placeholder="Section content" style="width:100%; padding:6px; margin-top:4px; font-size:0.9rem"><?php echo e($section->content); ?></textarea>
                        </div>
                        <input type="hidden" name="heading" value="<?php echo e($section->heading); ?>">
                        <input type="hidden" name="position" value="<?php echo e($section->position); ?>">
                        <button class="btn" type="submit" style="padding:6px 10px; font-size:0.9rem">Save</button>
                    </form>
                </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
        <?php endif; ?>

        <!-- Edit Blog Posts -->
        <?php if($posts->count() > 0): ?>
        <div class="modules-section">
            <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:1.5rem">
                <h2>Latest Blog Posts</h2>
                <a href="<?php echo e(route('admin.posts.index')); ?>" class="btn" style="padding:6px 12px; font-size:0.9rem">View All Posts</a>
            </div>
            <?php $__currentLoopData = $posts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $post): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="card" style="margin-bottom:1rem; padding:1rem">
                <div style="display:flex; justify-content:space-between; align-items:flex-start; gap:12px">
                    <div style="flex:1">
                        <h4 style="margin:0 0 4px 0"><?php echo e($post->title); ?></h4>
                        <p style="color:#666; font-size:0.85rem; margin:0 0 6px 0"><?php echo e($post->category); ?> — <?php echo e($post->created_at->format('M d, Y')); ?></p>
                        <p style="color:#444; font-size:0.9rem; margin:0"><?php echo e(\Illuminate\Support\Str::limit($post->excerpt ?? $post->content, 100)); ?></p>
                    </div>
                    <a href="<?php echo e(route('admin.posts.index')); ?>" class="btn" style="padding:6px 10px; font-size:0.9rem; white-space:nowrap">Edit</a>
                </div>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
        <?php endif; ?>

        <!-- Gallery Preview -->
        <?php if($gallery->count() > 0): ?>
        <div class="modules-section">
            <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:1.5rem">
                <h2>Gallery</h2>
                <a href="<?php echo e(route('admin.gallery.index')); ?>" class="btn" style="padding:6px 12px; font-size:0.9rem">Upload More</a>
            </div>
            <div style="display:grid; grid-template-columns:repeat(auto-fit,minmax(140px,1fr)); gap:12px">
                <?php $__currentLoopData = $gallery; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $image): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div style="border-radius:6px; overflow:hidden; box-shadow:0 2px 6px rgba(0,0,0,0.08)">
                    <div style="height:120px; background:#f0f0f0; display:flex; align-items:center; justify-content:center; overflow:hidden">
                        <img src="<?php echo e($image->image_path); ?>" alt="<?php echo e($image->title); ?>" style="max-width:100%; max-height:100%">
                    </div>
                    <div style="padding:8px; background:#fff">
                        <div style="font-weight:600; font-size:0.85rem; white-space:nowrap; overflow:hidden; text-overflow:ellipsis"><?php echo e($image->title); ?></div>
                        <div style="color:#666; font-size:0.75rem"><?php echo e($image->event_name); ?></div>
                    </div>
                </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
        <?php endif; ?>

        <!-- Testimonials -->
        <?php if($testimonials->count() > 0): ?>
        <div class="modules-section">
            <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:1.5rem">
                <h2>Client Testimonials</h2>
                <a href="<?php echo e(route('admin.testimonials.index')); ?>" class="btn" style="padding:6px 12px; font-size:0.9rem">Manage All</a>
            </div>
            <?php $__currentLoopData = $testimonials; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $t): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="card" style="margin-bottom:1rem; padding:1rem; border-left:4px solid #43a047">
                <div style="display:flex; justify-content:space-between; align-items:flex-start; gap:12px">
                    <div style="flex:1">
                        <div style="font-weight:700; color:#333"><?php echo e($t->author_name); ?></div>
                        <div style="color:#666; font-size:0.85rem"><?php echo e($t->author_title); ?></div>
                        <p style="color:#555; font-size:0.9rem; margin:6px 0 0"><?php echo e(\Illuminate\Support\Str::limit($t->quote, 120)); ?></p>
                    </div>
                    <a href="<?php echo e(route('admin.testimonials.index')); ?>" class="btn" style="padding:6px 10px; font-size:0.9rem; white-space:nowrap">Edit</a>
                </div>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
        <?php endif; ?>

        <!-- Modules Section -->
        <div class="modules-section">
            <h2>Module Management</h2>
            <div class="modules-grid">
                <!-- Pages -->
                <div class="module-card">
                    <h3>📄 Pages</h3>
                    <p>Manage website pages and their sections.</p>
                    <a href="<?php echo e(route('admin.pages.index')); ?>">Manage Pages</a>
                </div>

                <!-- Blog Posts -->
                <div class="module-card">
                    <h3>📝 Blog Posts</h3>
                    <p>Create and edit blog articles.</p>
                    <a href="<?php echo e(route('admin.posts.index')); ?>">Manage Posts</a>
                </div>

                <!-- Gallery -->
                <div class="module-card">
                    <h3>🖼️ Gallery</h3>
                    <p>Upload and manage gallery images.</p>
                    <a href="<?php echo e(route('admin.gallery.index')); ?>">Manage Gallery</a>
                </div>

                <!-- Testimonials -->
                <div class="module-card">
                    <h3>⭐ Testimonials</h3>
                    <p>Add and manage testimonials.</p>
                    <a href="<?php echo e(route('admin.testimonials.index')); ?>">Manage Testimonials</a>
                </div>

                <!-- Contact Forms -->
                <div class="module-card">
                    <h3>💬 Contact Forms</h3>
                    <p>View contact form submissions.</p>
                    <a href="<?php echo e(route('admin.contact-forms.index')); ?>">View Contact Forms</a>
                </div>

                <!-- Bookings -->
                <div class="module-card">
                    <h3>📅 Bookings</h3>
                    <p>Manage event bookings.</p>
                    <a href="<?php echo e(route('admin.bookings.index')); ?>">View Bookings</a>
                </div>

                <!-- Menu Management -->
                <div class="module-card">
                    <h3>🔗 Menu</h3>
                    <p>Manage navigation menus.</p>
                    <a href="<?php echo e(route('admin.menus.index')); ?>">Manage Menu</a>
                </div>

                <!-- Website Settings (Admin Only) -->
                <?php if(auth()->user()->isAdmin()): ?>
                <div class="module-card admin-only">
                    <h3>⚙️ Settings</h3>
                    <p>Configure website settings.</p>
                    <a href="<?php echo e(route('admin.settings.index')); ?>">Website Settings</a>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
<script>
    let calendarInstance = null;

    document.addEventListener('DOMContentLoaded', function () {
        const calendarEl = document.getElementById('bookingsCalendar');
        
        calendarInstance = new FullCalendar.Calendar(calendarEl, {
            initialView: 'dayGridMonth',
            headerToolbar: {
                left: 'prev,next today',
                center: 'title',
                right: ''
            },
            events: {
                url: '<?php echo e(route("admin.bookings.calendar-events")); ?>',
                failure: function() {
                    alert('Error fetching bookings');
                }
            },
            eventDidMount: function(info) {
                // Create custom tooltip
                const event = info.event;
                const extProps = event.extendedProps;
                
                tippy(info.el, {
                    content: `
                        <div class="event-tooltip">
                            <p class="name">${extProps.customer_name}</p>
                            <p><strong>Phone:</strong> ${extProps.phone}</p>
                            <p><strong>Cost:</strong> ₹${parseFloat(extProps.total_cost).toLocaleString('en-IN')}</p>
                            <span class="status ${extProps.status}">${extProps.status.toUpperCase()}</span>
                        </div>
                    `,
                    theme: 'light',
                    interactive: true,
                    allowHTML: true,
                    placement: 'top',
                    delay: [300, 0]
                });
            },
            eventClick: function(info) {
                const bookingId = info.event.extendedProps.booking_id;
                window.location.href = '<?php echo e(route("admin.bookings.show", "")); ?>/' + bookingId;
            },
            height: 'auto',
            contentHeight: 'auto',
            datesSet: function() {
                calendarInstance.refetchEvents();
            },
            businessHours: false,
            expandRows: true
        });
        
        calendarInstance.render();
    });

    function changeCalendarView(viewType) {
        // Update active button
        document.querySelectorAll('.view-btn').forEach(btn => {
            btn.classList.remove('active');
        });
        event.target.closest('button').classList.add('active');
        
        // Change calendar view
        if (calendarInstance) {
            calendarInstance.changeView(viewType);
        }
    }
</script>
<!-- Include Tippy.js for tooltips -->
<script src="https://unpkg.com/@popperjs/core@2"></script>
<script src="https://unpkg.com/tippy.js@6"></script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\amaanta\resources\views\admin\dashboard.blade.php ENDPATH**/ ?>