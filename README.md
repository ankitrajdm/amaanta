# Amaanta Laravel CMS + Admin Panel

This project now uses a Laravel-style structure where the **frontend content is managed from admin**.

## Admin capabilities implemented
- Authentication and multi-user roles (`admin`, `editor`, `viewer`).
- Dashboard with modules for:
  - Pages & sections (Home, About, Contact)
  - Blog posts
  - Gallery entries
  - Testimonials
  - Contact enquiries
  - Header/Footer menus
  - Website settings (admin-only)
- Contact form saves enquiries for admin review.

## Data model added
- `pages`, `page_sections`
- `website_settings`
- `menus`, `menu_items`
- `posts`
- `testimonials`
- `gallery_images`
- `contact_enquiries`
- plus role-based users (`users`, `roles`, `role_user`)

## Default credentials
- Admin: `admin@amaanta.com` / `password123`
- Editor: `editor@amaanta.com` / `password123`

## Setup
```bash
composer install
cp .env.example .env
touch database/database.sqlite
php artisan key:generate
php artisan migrate --seed
php artisan serve
```

> Note: In this execution environment, outbound package download was blocked, so dependencies were not installed here.
