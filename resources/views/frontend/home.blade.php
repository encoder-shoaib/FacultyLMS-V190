@extends('frontend.layouts.master')
@section('title', isset($course) && $course ? $course->title : __('home'))

@section('base.content')
    <!--====== Start Header ======-->
    @include('frontend.layouts.header.'.$section['header'])
    
    @if(isset($course) && $course)
    @php
        $lang = app()->getLocale();
        
        $resolveImg = function($key, $fallback = '') {
            $settingVal = setting($key);
            if ($settingVal) {
                if (is_numeric($settingVal)) {
                    $media = \App\Models\MediaLibrary::find($settingVal);
                    if ($media && $media->image_variants) {
                        return getFileLink('original_image', $media->image_variants);
                    }
                }
                if (is_array($settingVal)) {
                    return getFileLink('original_image', $settingVal);
                }
                if (is_string($settingVal) && (str_contains($settingVal, '/') || str_contains($settingVal, '.'))) {
                    return getFileLink('original_image', $settingVal);
                }
            }
            return $fallback;
        };

        $heroTitle = setting('hero_title', $lang) ?: (setting('single_hero_title') ?: $course->title);
        $heroDesc = setting('hero_description', $lang) ?: (setting('single_hero_description') ?: ($course->short_description ?? strip_tags($course->description)));
        $heroBtnLabel = setting('hero_main_action_btn_label', $lang) ?: __('Enroll Now');
        $heroBtnUrl = setting('hero_main_action_btn_url') ? url(setting('hero_main_action_btn_url')) : route('course.details', $course->slug);

        $heroImg1 = $resolveImg('header1_hero_image1') ?: ($resolveImg('header2_hero_image1') ?: ($resolveImg('single_hero_image') ?: ($course->image ? getFileLink('original_image', $course->image) : static_asset('frontend/img/hero/hero-v5-masonry-1.jpg'))));
        $heroImg2 = $resolveImg('header1_hero_image2') ?: ($resolveImg('header2_hero_image2') ?: static_asset('frontend/img/hero/hero-v5-masonry-2.jpg'));
        $heroImg3 = $resolveImg('header1_hero_image3') ?: ($resolveImg('header2_hero_image3') ?: static_asset('frontend/img/hero/hero-v5-masonry-3.jpg'));
        $heroImg4 = $resolveImg('header1_hero_image4') ?: ($resolveImg('header2_hero_image4') ?: static_asset('frontend/img/hero/hero-v5-masonry-4.jpg'));
    @endphp
    <!--====== Start Single Course Hero Section ======-->
    <section class="hero-area hero-area-v5 p-t-120 p-b-100 p-b-md-40" style="background-color: #110B3A;">
        <div class="container">
            <div class="row align-items-center g-4">
                <div class="col-lg-6">
                    @if(setting('hero_subtitle', $lang))
                        <span class="hero-subtitle mb-2 d-inline-block text-uppercase fw-bold" style="color: #10b981; letter-spacing: 1px;">{!! setting('hero_subtitle', $lang) !!}</span>
                    @endif
                    <h1 class="hero-title m-b-20" style="color: #ffffff; font-size: 2.8rem; line-height: 1.25;">{!! $heroTitle !!}</h1>
                    <p class="m-b-30" style="font-size: 1.1rem; line-height: 1.8; color: #d1d5db;">
                        {!! $heroDesc !!}
                    </p>
                    <a href="{{ $heroBtnUrl }}" class="template-btn mt-3">{{ $heroBtnLabel }}</a>
                </div>
                <div class="col-lg-6">
                    <div class="hero-staggered-collage position-relative w-100" style="min-height: 520px; max-width: 580px; margin: 0 auto;">
                        <!-- Top Right Image -->
                        @if($heroImg1)
                        <div class="collage-card card-1 position-absolute shadow-lg overflow-hidden" 
                             style="top: 0; right: 0; width: 55%; height: 320px; border-radius: 24px; z-index: 2; border: 3px solid rgba(255,255,255,0.15); transition: transform 0.3s ease;">
                            <img src="{{ $heroImg1 }}" alt="Hero Image 1" style="width: 100%; height: 100%; object-fit: cover;">
                        </div>
                        @endif

                        <!-- Left Middle Image -->
                        @if($heroImg2)
                        <div class="collage-card card-2 position-absolute shadow-lg overflow-hidden" 
                             style="top: 90px; left: 0; width: 52%; height: 340px; z-index: 1; border-radius: 24px; border: 3px solid rgba(255,255,255,0.15); transition: transform 0.3s ease;">
                            <img src="{{ $heroImg2 }}" alt="Hero Image 2" style="width: 100%; height: 100%; object-fit: cover;">
                        </div>
                        @endif

                        <!-- Bottom Right Image -->
                        @if($heroImg3)
                        <div class="collage-card card-3 position-absolute shadow-lg overflow-hidden" 
                             style="top: 230px; right: 2%; width: 55%; height: 310px; z-index: 3; border-radius: 24px; border: 3px solid rgba(255,255,255,0.2); transition: transform 0.3s ease;">
                            <img src="{{ $heroImg3 }}" alt="Hero Image 3" style="width: 100%; height: 100%; object-fit: cover;">
                        </div>
                        @endif

                        <!-- Fourth Floating Accent Image -->
                        @if($heroImg4)
                        <div class="collage-card card-4 position-absolute shadow-lg overflow-hidden" 
                             style="bottom: -15px; left: 10%; width: 36%; height: 160px; z-index: 4; border-radius: 20px; border: 4px solid #ffffff; transition: transform 0.3s ease;">
                            <img src="{{ $heroImg4 }}" alt="Hero Image 4" style="width: 100%; height: 100%; object-fit: cover;">
                        </div>
                        @endif
                    </div>
            </div>
        </div>
    </section>
    @endif

    <!--====== Start Feature Cards Section (Life Time Access, Free Course Materials, Dedicated Support) ======-->
    @include('frontend.homePage.feature_section')

    <!--====== Start About Me Section ======-->
    @include('frontend.homePage.about_me_section')

    <!--====== Start Stats Counter Section (Dynamic Database System Counts & Theme Green) ======-->
    @php
        // 1. Dynamic Enrolled Students Count from DB
        $total_enrolments = \App\Models\Enroll::count();
        if ($total_enrolments == 0) {
            $total_enrolments = \App\Models\User::where('user_type', 'student')->count();
        }
        $stat1_number = $total_enrolments > 0 ? number_format($total_enrolments) . '+' : (setting('instructor_stat1_number') ?: '1,200+');
        $stat1_title  = setting('instructor_stat1_title') ?: 'Students Enrolled';

        // 2. Dynamic Online Courses Count from DB
        $total_courses = \App\Models\Course::where('status', 1)->count();
        if ($total_courses == 0) {
            $total_courses = \App\Models\Course::count();
        }
        $stat2_number = $total_courses > 0 ? number_format($total_courses) . '+' : (setting('instructor_stat2_number') ?: '15+');
        $stat2_title  = setting('instructor_stat2_title') ?: 'Online Courses';

        // 3. Dynamic Success Rate from Ratings / Success Stories or Setting
        $total_ratings = \App\Models\Rating::count();
        if ($total_ratings > 0) {
            $avg_rating = \App\Models\Rating::avg('rating');
            $stat3_number = round(($avg_rating / 5) * 100) . '%';
        } else {
            $stat3_number = setting('instructor_stat3_number') ?: '99%';
        }
        $stat3_title = setting('instructor_stat3_title') ?: 'Success Rate';
    @endphp
    <section class="stats-counter-section p-t-60 p-b-60 bg-white">
        <div class="container container-1278">
            <div class="row justify-content-center align-items-center g-4 text-center">
                <!-- Stat 1: Students Enrolled -->
                <div class="col-md-4 col-4" data-aos="fade-up" data-aos-delay="0">
                    <div class="stat-counter-item">
                        <h2 class="fw-bold mb-2" style="font-size: 3.4rem; color: #10b981; font-weight: 800; line-height: 1; letter-spacing: -1px;">
                            {{ $stat1_number }}
                        </h2>
                        <h6 class="fw-bold mb-0" style="color: #1a1b4b; font-size: 17px;">
                            {{ __($stat1_title) }}
                        </h6>
                    </div>
                </div>

                <!-- Stat 2: Online Courses -->
                <div class="col-md-4 col-4" data-aos="fade-up" data-aos-delay="100">
                    <div class="stat-counter-item">
                        <h2 class="fw-bold mb-2" style="font-size: 3.4rem; color: #10b981; font-weight: 800; line-height: 1; letter-spacing: -1px;">
                            {{ $stat2_number }}
                        </h2>
                        <h6 class="fw-bold mb-0" style="color: #1a1b4b; font-size: 17px;">
                            {{ __($stat2_title) }}
                        </h6>
                    </div>
                </div>

                <!-- Stat 3: Success Rate -->
                <div class="col-md-4 col-4" data-aos="fade-up" data-aos-delay="200">
                    <div class="stat-counter-item">
                        <h2 class="fw-bold mb-2" style="font-size: 3.4rem; color: #10b981; font-weight: 800; line-height: 1; letter-spacing: -1px;">
                            {{ $stat3_number }}
                        </h2>
                        <h6 class="fw-bold mb-0" style="color: #1a1b4b; font-size: 17px;">
                            {{ __($stat3_title) }}
                        </h6>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!--====== Start Single Course Section ======-->
    @include('frontend.homePage.single_course_section')

    <!--====== Start Ad Banner 1 (Upper Home Section) ======-->
    @php
        $b1ImgSetting = setting('home_ad_banner_image_1') ?: setting('home_ad_banner_image');
        $b1Url = '';
        if ($b1ImgSetting) {
            $b1Url = getFileLink('original_image', $b1ImgSetting);
        }
        $b1Status = setting('home_ad_banner_status_1') !== '0';
        $b1Link = setting('home_ad_banner_link_1') ?: setting('home_ad_banner_link');
    @endphp
    @if($b1Url && $b1Status && !str_contains($b1Url, 'default'))
    <section class="ad-banner-section-1 p-t-60 p-b-60 bg-white overflow-hidden">
        <div class="container container-1278">
            <div class="row justify-content-center">
                <div class="col-12 text-center">
                    @if($b1Link)
                        <a href="{{ $b1Link }}" target="_blank" class="d-block w-100 overflow-hidden">
                    @endif
                        <img src="{{ $b1Url }}" alt="Ad Banner 1" class="img-fluid w-100" style="border-radius: 0px !important; width: 100%; max-height: 280px; object-fit: cover; display: block; box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);">
                    @if($b1Link)
                        </a>
                    @endif
                </div>
            </div>
        </div>
    </section>
    @endif

    <!--====== Promo Banner Restored to Original Position ======-->
    <section class="promo-banner-section p-t-60 p-b-60 bg-white">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-10">
                    <div class="promo-box rounded-4 p-5 text-center shadow-lg" style="background-color: {{ setting('promo_banner_bg_color') ?: '#fcd34d' }};">
                        <h2 class="fw-bold mb-4" style="font-size: 2.2rem; color: #1e3a8a;">
                            {{ setting('promo_banner_title') ?: 'Admission Is Open For The Next Batch. Take Admission And Get 40% Discount' }}
                        </h2>
                        
                        <div class="countdown-container d-flex justify-content-center gap-3 mb-5" id="promoCountdownMain" data-target="{{ setting('promo_banner_countdown') ?: date('Y-m-d H:i:s', strtotime('+5 days')) }}">
                            <div class="countdown-item bg-white rounded p-3 shadow-sm" style="width: 100px;">
                                <h3 class="days m-0 fw-bold" style="color: #ea580c; font-size: 2rem;">00</h3>
                                <span class="small fw-semibold text-secondary text-uppercase">Days</span>
                            </div>
                            <div class="countdown-item bg-white rounded p-3 shadow-sm" style="width: 100px;">
                                <h3 class="hours m-0 fw-bold" style="color: #ea580c; font-size: 2rem;">00</h3>
                                <span class="small fw-semibold text-secondary text-uppercase">Hours</span>
                            </div>
                            <div class="countdown-item bg-white rounded p-3 shadow-sm" style="width: 100px;">
                                <h3 class="minutes m-0 fw-bold" style="color: #ea580c; font-size: 2rem;">00</h3>
                                <span class="small fw-semibold text-secondary text-uppercase">Minutes</span>
                            </div>
                            <div class="countdown-item bg-white rounded p-3 shadow-sm" style="width: 100px;">
                                <h3 class="seconds m-0 fw-bold" style="color: #ea580c; font-size: 2rem;">00</h3>
                                <span class="small fw-semibold text-secondary text-uppercase">Seconds</span>
                            </div>
                        </div>

                        <a href="{{ setting('promo_banner_btn_link') ?: '#' }}" class="template-btn">
                            {{ setting('promo_banner_btn_text') ?: 'APPLY NOW' }}
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--====== Start What You Will Learn ======-->
    @if(isset($course) && $course && $course->outcomes)
    <section class="what-you-learn-section p-t-80 p-b-80 position-relative" style="background-color: #F9FAFB;">
        <div class="container container-1278">
            <div class="row justify-content-center">
                <div class="col-lg-10">
                    <div class="common-heading text-center m-b-40">
                        <span class="sub-title text-uppercase fw-bold m-b-12 d-inline-block" style="color: #10b981; letter-spacing: 1.5px; font-size: 14px;">
                            {{ __('WHAT YOU WILL LEARN') }}
                        </span>
                        <h2 class="fw-bold m-b-0" style="color: #1a1b4b; font-size: 38px; line-height: 1.25;">
                            {{ __('Course Outcomes & Key Takeaways') }}
                        </h2>
                    </div>
                    <div class="card shadow-lg border-0 p-4 p-md-5" style="border-radius: 20px; background: #ffffff;">
                        <div class="learn-outcomes-content" style="color: #475569; font-size: 16px; line-height: 1.8;">
                            {!! $course->outcomes !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @endif

    <!--====== Start Instructor Profile ======-->
    @if(isset($course) && $course && $course->instructor)
    <section class="instructor-section p-t-80 p-b-80 bg-white">
        <div class="container container-1278">
            <div class="row justify-content-center">
                <div class="col-lg-8 text-center">
                    <div class="common-heading text-center m-b-40">
                        <span class="sub-title text-uppercase fw-bold m-b-12 d-inline-block" style="color: #10b981; letter-spacing: 1.5px; font-size: 14px;">
                            {{ __('MEET YOUR INSTRUCTOR') }}
                        </span>
                        <h2 class="fw-bold m-b-0" style="color: #1a1b4b; font-size: 38px; line-height: 1.25;">
                            {{ __('Learn From An Expert Mentor') }}
                        </h2>
                    </div>

                    <div class="instructor-card p-4 p-md-5 bg-white shadow-lg border border-light" style="border-radius: 20px;">
                        <img src="{{ getFileLink('100x100', $course->instructor->image) }}" 
                             class="rounded-circle mb-4 shadow" 
                             alt="{{ $course->instructor->name }}" 
                             style="width: 130px; height: 130px; object-fit: cover; border: 4px solid #10b981; padding: 3px;">
                        
                        <h3 class="fw-bold mb-1" style="color: #1a1b4b; font-size: 24px;">{{ $course->instructor->name }}</h3>
                        <span class="d-inline-block fw-semibold mb-4 px-3 py-1 rounded-pill" style="background: rgba(16, 185, 129, 0.12); color: #10b981; font-size: 14px;">
                            {{ $course->instructor->instructor->designation ?? 'Lead Instructor' }}
                        </span>
                        
                        <div class="text-secondary" style="line-height: 1.8; color: #64748b; font-size: 15.5px;">
                            {!! $course->instructor->about !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @endif

    <!--====== Start Webinar Section ======-->
    @include('frontend.homePage.webinar_section')

    <!--====== Start Success Video Section ======-->
    @include('frontend.homePage.success_video')

    <!--====== Start Success Story Section ======-->
    @include('frontend.homePage.success')

    <!--====== Start Why Choose Me Section ======-->
    @include('frontend.homePage.why_choose_section')

    <!--====== Start FAQ Section ======-->
    @include('frontend.homePage.faq')

    <!--====== Start Ad Banner 2 (Lower Home Section) ======-->
    @php
        $b2ImgSetting = setting('home_ad_banner_image_2');
        $b2Url = '';
        if ($b2ImgSetting) {
            $b2Url = getFileLink('original_image', $b2ImgSetting);
        }
        $b2Status = setting('home_ad_banner_status_2') !== '0';
        $b2Link = setting('home_ad_banner_link_2');
    @endphp

    @if($b2Url && $b2Status && !str_contains($b2Url, 'default'))
    <section class="ad-banner-section-2 p-t-60 p-b-60 bg-white overflow-hidden">
        <div class="container container-1278">
            <div class="row justify-content-center">
                <div class="col-12 text-center">
                    @if($b2Link)
                        <a href="{{ $b2Link }}" target="_blank" class="d-block w-100 overflow-hidden">
                    @endif
                        <img src="{{ $b2Url }}" alt="Ad Banner 2" class="img-fluid w-100" style="border-radius: 0px !important; width: 100%; max-height: 280px; object-fit: cover; display: block; box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);">
                    @if($b2Link)
                        </a>
                    @endif
                </div>
            </div>
        </div>
    </section>
    @endif



    <!--====== Global Countdown Script for both timers ======-->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            function initCountdown(elementId) {
                const countdownEl = document.getElementById(elementId);
                if(countdownEl) {
                    const targetDateStr = countdownEl.getAttribute('data-target');
                    const targetDate = new Date(targetDateStr.replace(/-/g, '/')).getTime();

                    const timer = setInterval(function() {
                        const now = new Date().getTime();
                        const distance = targetDate - now;

                        if (distance < 0) {
                            clearInterval(timer);
                            return;
                        }

                        const days = Math.floor(distance / (1000 * 60 * 60 * 24));
                        const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                        const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                        const seconds = Math.floor((distance % (1000 * 60)) / 1000);

                        if(countdownEl.querySelector('.days')) countdownEl.querySelector('.days').innerText = days;
                        if(countdownEl.querySelector('.hours')) countdownEl.querySelector('.hours').innerText = hours;
                        if(countdownEl.querySelector('.minutes')) countdownEl.querySelector('.minutes').innerText = minutes;
                        if(countdownEl.querySelector('.seconds')) countdownEl.querySelector('.seconds').innerText = seconds;
                    }, 1000);
                }
            }
            initCountdown('promoCountdownMain');
            initCountdown('promoCountdownFooter');
        });
    </script>

    <!--====== Start Footer ======-->
    @include('frontend.layouts.footer')
@endsection

