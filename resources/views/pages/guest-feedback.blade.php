@php
    $settings = \App\Models\WebsiteSetting::first();
@endphp
<!DOCTYPE html>
<html lang="zxx">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <title>Guest Feedback - {{ $settings['website_name'] ?? 'Amaanta Farms' }}</title>
    <link rel="shortcut icon" href="/assets/img/favicon.png" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Didact+Gothic&family=Playfair+Display:ital@0;1&display=swap">
    <link rel="stylesheet" href="/assets/css/plugins.css" />
    <link rel="stylesheet" href="/assets/css/style.css" />
    <!-- FontAwesome for WhatsApp icon -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        /* WhatsApp Fixed Icon */
        .whatsapp-icon {
            position: fixed;
            bottom: 98px;
            right: 18px;
            z-index: 999;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .whatsapp-icon a {
            width: 60px;
            height: 60px;
            background: linear-gradient(135deg, #25d366 0%, #128c7e 100%);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.8rem;
            color: white;
            transition: transform 0.3s, box-shadow 0.3s;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
        }

        .whatsapp-icon a:hover {
            transform: scale(1.1);
            box-shadow: 0 6px 16px rgba(0, 0, 0, 0.3);
            color: white;
            text-decoration: none;
        }

        /* Guest Feedback Form Styles */
        .guest-feedback-section {
            padding: 80px 0;
            background: #101010;
            min-height: 100vh;
            font-family: 'Didact Gothic', sans-serif;
        }

        .feedback-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.2);
            overflow: hidden;
            
            margin-top: 46px;
            max-width: 800px;
        }

        .form-header {
            background: #7d6833;
            color: white;
            padding: 2rem;
            text-align: center;
            position: relative;
            font-family: 'Playfair Display', serif;
        }

        .form-header::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="grain" width="100" height="100" patternUnits="userSpaceOnUse"><circle cx="25" cy="25" r="1" fill="rgba(255,255,255,0.1)"/><circle cx="75" cy="75" r="1" fill="rgba(255,255,255,0.1)"/><circle cx="50" cy="10" r="0.5" fill="rgba(255,255,255,0.1)"/></pattern></defs><rect width="100" height="100" fill="url(%23grain)"/></svg>');
            opacity: 0.3;
        }

        .form-header h1 {
            font-size: 2.2rem;
            font-weight: 700;
            margin-bottom: 0.5rem;
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            font-family: 'Playfair Display', serif;
            position: relative;
            z-index: 1;
        }

        .form-header p {
            font-size: .8rem;
            opacity: 0.9;
            margin: 0;
            font-family: 'Didact Gothic', sans-serif;
            position: relative;
            z-index: 1;
        }

        .form-section {
            padding: 1rem;
            border-bottom: 1px solid #f0f0f0;
        }

        .form-section:last-child {
            border-bottom: none;
        }

        .section-title {
            font-size: 1rem;
            font-weight: 600;
            color: #1f2937;
            margin-bottom: 1.5rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            font-family: 'Playfair Display', serif;
        }

        .section-title::before {
            content: '';
            width: 4px;
            height: 24px;
            background: #7d6833;
            border-radius: 2px;
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-label {
            display: block;
            font-weight: 500;
            color: #374151;
            margin-bottom: 0.5rem;
            font-size: 1rem;
            font-family: 'Didact Gothic', sans-serif;
        }

        .form-input, .form-select, .form-textarea {
            width: 100%;
            padding: 0.875rem 1rem;
            border: 2px solid #e5e7eb;
            border-radius: 12px;
            font-size: 1rem;
            transition: all 0.3s ease;
            background: white;
            font-family: 'Didact Gothic', sans-serif;
        }

        .form-input:focus, .form-select:focus, .form-textarea:focus {
            outline: none;
            border-color: #25d366;
            box-shadow: 0 0 0 3px rgba(37, 211, 102, 0.1);
            transform: translateY(-1px);
        }

        .form-textarea {
            resize: vertical;
            min-height: 100px;
        }

        .radio-group {
            display: flex;
            flex-wrap: wrap;
            gap: 1rem;
            margin-top: 0.5rem;
        }

        .radio-option {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.75rem 1rem;
            border: 2px solid #e5e7eb;
            border-radius: 12px;
            cursor: pointer;
            transition: all 0.3s ease;
            background: white;
        }

        .radio-option:hover {
            border-color: #7d6833;
            transform: translateY(-1px);
        }

        .radio-option input[type="radio"] {
            margin: 0;
            width: 16px;
            height: 16px;
        }

        .radio-option.selected {
            border-color: #25d366;
            background: rgba(37, 211, 102, 0.05);
        }

        .checkbox-group {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            padding: 1rem;
            border: 2px solid #e5e7eb;
            border-radius: 12px;
            background: white;
            margin-top: 0.5rem;
        }

        .checkbox-group input[type="checkbox"] {
            width: 18px;
            height: 18px;
            margin: 0;
        }

        .submit-btn {
            background: linear-gradient(135deg, #7d6833 0%, #c1aa5c 100%);
            color: white;
            border: none;
            padding: 1rem 2rem;
            border-radius: 12px;
            font-size: 1.1rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            width: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            box-shadow: 0 4px 14px rgba(37, 211, 102, 0.3);
            font-family: 'Didact Gothic', sans-serif;
        }

        .submit-btn:hover:not(:disabled) {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(37, 211, 102, 0.4);
        }

        .submit-btn:disabled {
            opacity: 0.7;
            cursor: not-allowed;
            transform: none;
        }

        .message-container {
            margin-top: 1.5rem;
        }

        .message {
            padding: 1rem 1.5rem;
            border-radius: 12px;
            font-weight: 500;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .message.success {
            background: linear-gradient(135deg, #d1fae5 0%, #a7f3d0 100%);
            color: #065f46;
            border: 1px solid #34d399;
        }

        .message.error {
            background: linear-gradient(135deg, #fee2e2 0%, #fecaca 100%);
            color: #991b1b;
            border: 1px solid #f87171;
        }

        .required {
            color: #ef4444;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .guest-feedback-section {
                padding: 60px 0;
            }

            .feedback-card {
                margin: 40px 1rem;
                border-radius: 15px;
            }

            .form-header {
                padding: 1.5rem;
            }

            .form-header h1 {
                font-size: 2rem;
            }

            .form-section {
                padding: 1.5rem;
            }

            .radio-group {
                flex-direction: column;
                gap: 0.75rem;
            }

            .radio-option {
                padding: 0.625rem 0.875rem;
                font-size: 0.9rem;
            }

            .section-title {
                font-size: 1rem;
            }
        }

        @media (max-width: 480px) {
            .form-header h1 {
                font-size: 1rem;
            }

            .form-section {
                padding: 1rem;
            }

            .submit-btn {
                padding: 0.875rem 1.5rem;
                font-size: 1rem;
            }
        }
    </style>
</head>
<body>
    <!-- WhatsApp Icon -->
    @if($settings['whatsapp_link'] ?? null)
    <div class="whatsapp-icon">
        <a href="{{ $settings['whatsapp_link'] }}" target="_blank" title="Contact us on WhatsApp">
            <i class="fab fa-whatsapp"></i>
        </a>
    </div>
    @endif

    <!-- Preloader -->
    <div class="preloader-bg" style="display: none !important;"></div>
    <div id="preloader" style="display: none !important;">
        <div id="preloader-status">
            <div class="preloader-position loader"> <span></span> </div>
        </div>
    </div>

    <!-- Progress scroll totop -->
    <div class="progress-wrap cursor-pointer">
        <svg class="progress-circle svg-content" width="100%" height="100%" viewBox="-1 -1 102 102">
            <path d="M50,1 a49,49 0 0,1 0,98 a49,49 0 0,1 0,-98" />
        </svg>
    </div>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg">
        <div class="container">
            <!-- Logo -->
            <div class="logo-wrapper">
                <a class="logo" href="{{ route('home') }}">
                    @if($settings['logo'] ?? null)
                        <img src="{{ asset($settings['logo']) }}" class="logo-img" alt="{{ $settings['website_name'] ?? 'Amaanta' }}">
                    @else
                        <img src="/assets/img/logonew.png" class="logo-img" alt="">
                    @endif
                </a>
            </div>
            <!-- Button -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar" aria-controls="navbar" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"><i class="ti-menu"></i></span>
            </button>
            <!-- Menu -->
            <div class="collapse navbar-collapse" id="navbar">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link" href="{{ route('home') }}">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('about') }}">About</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('services') }}">Memorybook</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('memorybook') }}">Services</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('contact') }}">Contact</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Guest Feedback Section -->
    <section class="guest-feedback-section" style="display: block !important; visibility: visible !important;">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="feedback-card" style="display: block !important; visibility: visible !important;">
                        <!-- Header -->
                        <div class="form-header">
                            <h1>Amaanta Guest Feedback</h1>
                            <p>Your feedback helps us improve our services</p>
                        </div>

                        <!-- Success/Error Messages -->
                        @if(session('success'))
                        <div class="message-container">
                            <div class="message success">
                                <i class="fas fa-check-circle"></i>
                                {{ session('success') }}
                            </div>
                        </div>
                        @endif

                        @if($errors->any())
                        <div class="message-container">
                            <div class="message error">
                                <i class="fas fa-exclamation-circle"></i>
                                Please correct the errors below and try again.
                            </div>
                        </div>
                        @endif

                        <form action="{{ route('guest-feedback.store') }}" method="POST">
                            @csrf

                            <!-- Guest Information -->
                            <div class="form-section">
                                <h3 class="section-title">
                                    <i class="fas fa-user"></i>
                                    Guest Information
                                </h3>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label">Guest Name <span class="required">*</span></label>
                                            <input type="text" name="guest_name" class="form-input" value="{{ old('guest_name') }}" required>
                                            @error('guest_name')
                                                <div class="text-danger small mt-1">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label">Room # <span class="required">*</span></label>
                                            <input type="text" name="room_number" class="form-input" value="{{ old('room_number') }}" required>
                                            @error('room_number')
                                                <div class="text-danger small mt-1">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label">Check-in <span class="required">*</span></label>
                                            <input type="date" name="check_in_date" class="form-input" value="{{ old('check_in_date') }}" required>
                                            @error('check_in_date')
                                                <div class="text-danger small mt-1">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label">Check-out <span class="required">*</span></label>
                                            <input type="date" name="check_out_date" class="form-input" value="{{ old('check_out_date') }}" required>
                                            @error('check_out_date')
                                                <div class="text-danger small mt-1">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- How did you hear about us -->
                            <div class="form-section">
                                <h3 class="section-title">
                                    <i class="fas fa-bullhorn"></i>
                                    How did you hear about us? <span class="required">*</span>
                                </h3>
                                <div class="radio-group">
                                    <label class="radio-option {{ old('heard_about_us') == 'Friends & Family' ? 'selected' : '' }}">
                                        <input type="radio" name="heard_about_us" value="Friends & Family" {{ old('heard_about_us') == 'Friends & Family' ? 'checked' : '' }} required>
                                        <span>Friends & Family</span>
                                    </label>
                                    <label class="radio-option {{ old('heard_about_us') == 'Social Media' ? 'selected' : '' }}">
                                        <input type="radio" name="heard_about_us" value="Social Media" {{ old('heard_about_us') == 'Social Media' ? 'checked' : '' }}>
                                        <span>Social Media</span>
                                    </label>
                                    <label class="radio-option {{ old('heard_about_us') == 'Ads' ? 'selected' : '' }}">
                                        <input type="radio" name="heard_about_us" value="Ads" {{ old('heard_about_us') == 'Ads' ? 'checked' : '' }}>
                                        <span>Ads</span>
                                    </label>
                                    <label class="radio-option {{ old('heard_about_us') == 'Other' ? 'selected' : '' }}">
                                        <input type="radio" name="heard_about_us" value="Other" {{ old('heard_about_us') == 'Other' ? 'checked' : '' }}>
                                        <span>Other</span>
                                    </label>
                                </div>
                                @error('heard_about_us')
                                    <div class="text-danger small mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- How did you make your reservation -->
                            <div class="form-section">
                                <h3 class="section-title">
                                    <i class="fas fa-calendar-check"></i>
                                    How did you make your reservation? <span class="required">*</span>
                                </h3>
                                <div class="radio-group">
                                    <label class="radio-option {{ old('reservation_method') == 'Travel Agency' ? 'selected' : '' }}">
                                        <input type="radio" name="reservation_method" value="Travel Agency" {{ old('reservation_method') == 'Travel Agency' ? 'checked' : '' }} required>
                                        <span>Travel Agency</span>
                                    </label>
                                    <label class="radio-option {{ old('reservation_method') == 'Online' ? 'selected' : '' }}">
                                        <input type="radio" name="reservation_method" value="Online" {{ old('reservation_method') == 'Online' ? 'checked' : '' }}>
                                        <span>Online</span>
                                    </label>
                                    <label class="radio-option {{ old('reservation_method') == 'Application' ? 'selected' : '' }}">
                                        <input type="radio" name="reservation_method" value="Application" {{ old('reservation_method') == 'Application' ? 'checked' : '' }}>
                                        <span>Application</span>
                                    </label>
                                    <label class="radio-option {{ old('reservation_method') == 'Other' ? 'selected' : '' }}">
                                        <input type="radio" name="reservation_method" value="Other" {{ old('reservation_method') == 'Other' ? 'checked' : '' }}>
                                        <span>Other</span>
                                    </label>
                                </div>
                                @error('reservation_method')
                                    <div class="text-danger small mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Purpose of Visit -->
                            <div class="form-section">
                                <h3 class="section-title">
                                    <i class="fas fa-map-marker-alt"></i>
                                    Purpose of Visit <span class="required">*</span>
                                </h3>
                                <div class="radio-group">
                                    <label class="radio-option {{ old('visit_purpose') == 'Vacation' ? 'selected' : '' }}">
                                        <input type="radio" name="visit_purpose" value="Vacation" {{ old('visit_purpose') == 'Vacation' ? 'checked' : '' }} required>
                                        <span>Vacation</span>
                                    </label>
                                    <label class="radio-option {{ old('visit_purpose') == 'Wedding' ? 'selected' : '' }}">
                                        <input type="radio" name="visit_purpose" value="Wedding" {{ old('visit_purpose') == 'Wedding' ? 'checked' : '' }}>
                                        <span>Wedding</span>
                                    </label>
                                    <label class="radio-option {{ old('visit_purpose') == 'Business' ? 'selected' : '' }}">
                                        <input type="radio" name="visit_purpose" value="Business" {{ old('visit_purpose') == 'Business' ? 'checked' : '' }}>
                                        <span>Business</span>
                                    </label>
                                    <label class="radio-option {{ old('visit_purpose') == 'Other' ? 'selected' : '' }}">
                                        <input type="radio" name="visit_purpose" value="Other" {{ old('visit_purpose') == 'Other' ? 'checked' : '' }}>
                                        <span>Other</span>
                                    </label>
                                </div>
                                @error('visit_purpose')
                                    <div class="text-danger small mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Service Quality -->
                            <div class="form-section">
                                <h3 class="section-title">
                                    <i class="fas fa-star"></i>
                                    Service Quality <span class="required">*</span>
                                </h3>
                                <div class="radio-group">
                                    <label class="radio-option {{ old('service_quality') == 'Excellent' ? 'selected' : '' }}">
                                        <input type="radio" name="service_quality" value="Excellent" {{ old('service_quality') == 'Excellent' ? 'checked' : '' }} required>
                                        <span>Excellent</span>
                                    </label>
                                    <label class="radio-option {{ old('service_quality') == 'Very Good' ? 'selected' : '' }}">
                                        <input type="radio" name="service_quality" value="Very Good" {{ old('service_quality') == 'Very Good' ? 'checked' : '' }}>
                                        <span>Very Good</span>
                                    </label>
                                    <label class="radio-option {{ old('service_quality') == 'Good' ? 'selected' : '' }}">
                                        <input type="radio" name="service_quality" value="Good" {{ old('service_quality') == 'Good' ? 'checked' : '' }}>
                                        <span>Good</span>
                                    </label>
                                    <label class="radio-option {{ old('service_quality') == 'Satisfactory' ? 'selected' : '' }}">
                                        <input type="radio" name="service_quality" value="Satisfactory" {{ old('service_quality') == 'Satisfactory' ? 'checked' : '' }}>
                                        <span>Satisfactory</span>
                                    </label>
                                    <label class="radio-option {{ old('service_quality') == 'Poor' ? 'selected' : '' }}">
                                        <input type="radio" name="service_quality" value="Poor" {{ old('service_quality') == 'Poor' ? 'checked' : '' }}>
                                        <span>Poor</span>
                                    </label>
                                </div>
                                @error('service_quality')
                                    <div class="text-danger small mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Cleanliness -->
                            <div class="form-section">
                                <h3 class="section-title">
                                    <i class="fas fa-broom"></i>
                                    Cleanliness <span class="required">*</span>
                                </h3>
                                <div class="radio-group">
                                    <label class="radio-option {{ old('cleanliness') == 'Excellent' ? 'selected' : '' }}">
                                        <input type="radio" name="cleanliness" value="Excellent" {{ old('cleanliness') == 'Excellent' ? 'checked' : '' }} required>
                                        <span>Excellent</span>
                                    </label>
                                    <label class="radio-option {{ old('cleanliness') == 'Very Good' ? 'selected' : '' }}">
                                        <input type="radio" name="cleanliness" value="Very Good" {{ old('cleanliness') == 'Very Good' ? 'checked' : '' }}>
                                        <span>Very Good</span>
                                    </label>
                                    <label class="radio-option {{ old('cleanliness') == 'Good' ? 'selected' : '' }}">
                                        <input type="radio" name="cleanliness" value="Good" {{ old('cleanliness') == 'Good' ? 'checked' : '' }}>
                                        <span>Good</span>
                                    </label>
                                    <label class="radio-option {{ old('cleanliness') == 'Satisfactory' ? 'selected' : '' }}">
                                        <input type="radio" name="cleanliness" value="Satisfactory" {{ old('cleanliness') == 'Satisfactory' ? 'checked' : '' }}>
                                        <span>Satisfactory</span>
                                    </label>
                                    <label class="radio-option {{ old('cleanliness') == 'Poor' ? 'selected' : '' }}">
                                        <input type="radio" name="cleanliness" value="Poor" {{ old('cleanliness') == 'Poor' ? 'checked' : '' }}>
                                        <span>Poor</span>
                                    </label>
                                </div>
                                @error('cleanliness')
                                    <div class="text-danger small mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Staff -->
                            <div class="form-section">
                                <h3 class="section-title">
                                    <i class="fas fa-users"></i>
                                    Staff <span class="required">*</span>
                                </h3>
                                <div class="radio-group">
                                    <label class="radio-option {{ old('staff_rating') == 'Excellent' ? 'selected' : '' }}">
                                        <input type="radio" name="staff_rating" value="Excellent" {{ old('staff_rating') == 'Excellent' ? 'checked' : '' }} required>
                                        <span>Excellent</span>
                                    </label>
                                    <label class="radio-option {{ old('staff_rating') == 'Very Good' ? 'selected' : '' }}">
                                        <input type="radio" name="staff_rating" value="Very Good" {{ old('staff_rating') == 'Very Good' ? 'checked' : '' }}>
                                        <span>Very Good</span>
                                    </label>
                                    <label class="radio-option {{ old('staff_rating') == 'Good' ? 'selected' : '' }}">
                                        <input type="radio" name="staff_rating" value="Good" {{ old('staff_rating') == 'Good' ? 'checked' : '' }}>
                                        <span>Good</span>
                                    </label>
                                    <label class="radio-option {{ old('staff_rating') == 'Satisfactory' ? 'selected' : '' }}">
                                        <input type="radio" name="staff_rating" value="Satisfactory" {{ old('staff_rating') == 'Satisfactory' ? 'checked' : '' }}>
                                        <span>Satisfactory</span>
                                    </label>
                                    <label class="radio-option {{ old('staff_rating') == 'Poor' ? 'selected' : '' }}">
                                        <input type="radio" name="staff_rating" value="Poor" {{ old('staff_rating') == 'Poor' ? 'checked' : '' }}>
                                        <span>Poor</span>
                                    </label>
                                </div>
                                @error('staff_rating')
                                    <div class="text-danger small mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Additional Feedback -->
                            <div class="form-section">
                                <h3 class="section-title">
                                    <i class="fas fa-comment"></i>
                                    Additional Feedback
                                </h3>
                                <div class="form-group">
                                    <textarea name="additional_feedback" class="form-textarea" placeholder="Please share any additional comments or suggestions...">{{ old('additional_feedback') }}</textarea>
                                    @error('additional_feedback')
                                        <div class="text-danger small mt-1">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Agreement -->
                            <div class="form-section">
                                <div class="checkbox-group">
                                    <input type="checkbox" name="agree_to_submit" value="1" {{ old('agree_to_submit') ? 'checked' : '' }} required>
                                    <label class="form-label mb-0">I agree to submit this feedback <span class="required">*</span></label>
                                </div>
                                @error('agree_to_submit')
                                    <div class="text-danger small mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Submit Button -->
                            <div class="form-section">
                                <button type="submit" class="submit-btn">
                                    <i class="fas fa-paper-plane"></i>
                                    Submit Feedback
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    @include('partials.footer')

    <!-- Scripts same as home page -->
    <script src="/assets/js/jquery-3.6.3.min.js"></script>
    <script src="/assets/js/jquery-migrate-3.0.0.min.js"></script>
    <script src="/assets/js/modernizr-2.6.2.min.js"></script>
    <script src="/assets/js/imagesloaded.pkgd.min.js"></script>
    <script src="/assets/js/jquery.isotope.v3.0.2.js"></script>
    <script src="/assets/js/pace.js"></script>
    <script src="/assets/js/popper.min.js"></script>
    <script src="/assets/js/bootstrap.min.js"></script>
    <script src="/assets/js/scrollIt.min.js"></script>
    <script src="/assets/js/jquery.waypoints.min.js"></script>
    <script src="/assets/js/owl.carousel.min.js"></script>
    <script src="/assets/js/jquery.stellar.min.js"></script>
    <script src="/assets/js/jquery.magnific-popup.js"></script>
    <script src="/assets/js/YouTubePopUp.js"></script>
    <script src="/assets/js/smooth-scroll.min.js"></script>
    <script src="/assets/js/custom.js"></script>

    <script>
        // Radio button selection styling
        document.querySelectorAll('.radio-option').forEach(option => {
            option.addEventListener('click', function() {
                // Remove selected class from siblings
                this.parentElement.querySelectorAll('.radio-option').forEach(opt => {
                    opt.classList.remove('selected');
                });
                // Add selected class to clicked option
                this.classList.add('selected');
            });
        });

        // Form validation
        document.querySelector('form').addEventListener('submit', function(e) {
            const requiredRadios = ['heard_about_us', 'reservation_method', 'visit_purpose', 'service_quality', 'cleanliness', 'staff_rating'];

            requiredRadios.forEach(name => {
                const radios = document.querySelectorAll(`input[name="${name}"]`);
                const checked = Array.from(radios).some(radio => radio.checked);

                if (!checked) {
                    e.preventDefault();
                    // Find the section and highlight it
                    const section = document.querySelector(`input[name="${name}"]`).closest('.form-section');
                    section.style.borderLeft = '4px solid #ef4444';
                    section.scrollIntoView({ behavior: 'smooth', block: 'center' });
                    return;
                }
            });
        });
    </script>
</body>
</html>