@if(setting('success_video_status') !== '0')
@php
    $lang = app()->getLocale();
    $subtitle = setting('success_video_subtitle', $lang) ?: 'STUDENT SUCCESS';
    $title = setting('success_video_title', $lang) ?: 'Success Story Of My Students';
    $desc = setting('success_video_description', $lang) ?: 'Watch how our students transformed their careers and achieved real world success through guided learning and dedicated mentorship.';
    $btnText = setting('success_video_button_text', $lang) ?: 'ENROLL NOW';
    $btnUrl = setting('success_video_button_url', $lang) ?: (isset($course) ? route('course.details', $course->slug) : route('student.sign_up'));

    $videoUrl = setting('success_video_url', $lang);
    if ($videoUrl && strpos($videoUrl, '<iframe') !== false && preg_match('/src="([^"]+)"/', $videoUrl, $matches)) {
        $videoUrl = $matches[1];
    }
    
    $bannerImgSetting = setting('success_video_image');
    $bannerImageUrl = '';
    if ($bannerImgSetting) {
        $bannerImageUrl = getFileLink('original_image', $bannerImgSetting);
    }
    if (!$bannerImageUrl || str_contains($bannerImageUrl, 'default')) {
        $bannerImageUrl = 'https://images.unsplash.com/photo-1522202176988-66273c2fd55f?q=80&w=1200&auto=format&fit=crop';
    }
@endphp

<style>
    .video-banner-card {
        position: relative;
        border-radius: 20px;
        overflow: hidden;
        box-shadow: 0 20px 45px rgba(0, 0, 0, 0.08);
        border: 6px solid #ffffff;
        background: #110B3A;
    }
    .video-banner-card img {
        width: 100%;
        height: 100%;
        min-height: 420px;
        max-height: 480px;
        object-fit: cover;
        display: block;
        border-radius: 14px;
        transition: transform 0.4s ease;
    }
    .video-banner-card:hover img {
        transform: scale(1.03);
    }
    .play-btn-circle {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        width: 76px;
        height: 76px;
        background-color: #10b981;
        color: #ffffff;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 24px;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        box-shadow: 0 10px 30px rgba(16, 185, 129, 0.45);
        z-index: 5;
        text-decoration: none !important;
    }
    .play-btn-circle::before {
        content: '';
        position: absolute;
        width: 100%;
        height: 100%;
        border-radius: 50%;
        background: rgba(16, 185, 129, 0.5);
        animation: pulse-ring 2s infinite;
        z-index: -1;
    }
    @keyframes pulse-ring {
        0% {
            transform: scale(1);
            opacity: 0.8;
        }
        100% {
            transform: scale(1.6);
            opacity: 0;
        }
    }
    .video-banner-card:hover .play-btn-circle {
        transform: translate(-50%, -50%) scale(1.12);
        background-color: #059669;
        color: #ffffff;
    }
    .play-btn-circle i {
        margin-left: 4px;
    }
    .video-badge-floating {
        position: absolute;
        bottom: 25px;
        left: 25px;
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(10px);
        padding: 14px 20px;
        border-radius: 14px;
        box-shadow: 0 10px 30px rgba(0,0,0,0.12);
        display: flex;
        align-items: center;
        gap: 12px;
        z-index: 4;
    }
</style>

<section class="success-video-section p-t-80 p-b-80 position-relative" style="background-color: #ffffff;">
    <div class="container container-1278">
        <div class="row align-items-center g-5">
            
            <!-- Left Side: Content & Action Button -->
            <div class="col-lg-6 col-md-12" data-aos="fade-right">
                <div class="success-video-text-block pe-lg-4">
                    <div class="common-heading">
                        @if($subtitle)
                            <span class="sub-title text-uppercase fw-bold m-b-15 d-inline-block" style="color: #10b981; letter-spacing: 1.5px; font-size: 14px;">
                                {{ __($subtitle) }}
                            </span>
                        @endif

                        @if($title)
                            <h2 class="m-b-20" style="color: #1a1b4b; font-size: 38px; line-height: 1.25;">
                                {{ __($title) }}
                            </h2>
                        @endif

                        @if($desc)
                            <p class="m-b-30" style="color: #64748b; font-size: 16px; line-height: 1.7;">
                                {{ __($desc) }}
                            </p>
                        @endif

                        @if($btnText)
                            <a href="{{ $btnUrl }}" class="template-btn">
                                {{ __($btnText) }}
                            </a>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Right Side: Video Banner Card -->
            <div class="col-lg-6 col-md-12" data-aos="fade-left" data-aos-delay="100">
                <div class="video-banner-card">
                    <img src="{{ $bannerImageUrl }}" alt="{{ $title }}">
                    
                    <a href="{{ $videoUrl ?: '#' }}" class="play-btn-circle popup-video" target="_blank" title="Play Video">
                        <i class="fas fa-play"></i>
                    </a>

                    <div class="video-badge-floating d-none d-sm-flex">
                        <div class="badge-icon d-flex align-items-center justify-content-center" 
                             style="width: 42px; height: 42px; border-radius: 10px; background: rgba(16, 185, 129, 0.15); color: #10b981; font-size: 1.2rem;">
                            <i class="fas fa-video"></i>
                        </div>
                        <div>
                            <h6 class="fw-bold mb-0" style="color: #1a1b4b; font-size: 0.95rem;">Student Case Study</h6>
                            <span class="text-secondary" style="font-size: 0.82rem;">Real Results & Achievements</span>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>
@endif
<!--====== End Success Video Section ======-->
