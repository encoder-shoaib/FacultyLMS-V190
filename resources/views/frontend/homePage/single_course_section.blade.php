@if(setting('single_course_status') !== '0')
@php
    $lang = app()->getLocale();
    $tag = setting('single_course_tag', $lang) ?: 'FEATURED COURSE';
    $title = setting('single_course_title', $lang) ?: 'Master Web Development With Expert Guidance';
    $desc1 = setting('single_course_description_1', $lang) ?: 'Join our comprehensive single course program designed to take you from beginner to advanced level with real-world projects and direct mentor support.';
    $desc2 = setting('single_course_description_2', $lang) ?: 'Get lifetime access to premium curriculum, practical assignments, downloadable resources, and a verified completion certificate.';
    $btnText = setting('single_course_btn_text', $lang) ?: 'ENROLL NOW';
    $btnUrl = setting('single_course_btn_url', $lang) ?: (isset($course) ? route('course.details', $course->slug) : route('student.sign_up'));

    $imgSetting = setting('single_course_image');
    $imageUrl = '';
    if ($imgSetting) {
        $imageUrl = getFileLink('original_image', $imgSetting);
    }
    if (!$imageUrl || str_contains($imageUrl, 'default')) {
        $imageUrl = 'https://images.unsplash.com/photo-1531482615713-2afd69097998?q=80&w=1200&auto=format&fit=crop';
    }
@endphp

<section class="single-course-section p-t-80 p-b-80 position-relative" style="background-color: #ffffff;">
    <div class="container container-1278">
        <div class="row align-items-center g-5">
            
            <!-- Left Side: Content & Action Button -->
            <div class="col-lg-6 col-md-12" data-aos="fade-right">
                <div class="single-course-content pe-lg-4">
                    <div class="common-heading">
                        @if($tag)
                            <span class="sub-title text-uppercase fw-bold m-b-15 d-inline-block" style="color: #10b981; letter-spacing: 1.5px; font-size: 14px;">
                                {{ __($tag) }}
                            </span>
                        @endif

                        @if($title)
                            <h2 class="m-b-20" style="color: #1a1b4b; font-size: 38px; line-height: 1.25;">
                                {{ __($title) }}
                            </h2>
                        @endif

                        @if($desc1)
                            <p class="m-b-15" style="color: #64748b; font-size: 16px; line-height: 1.7;">
                                {{ __($desc1) }}
                            </p>
                        @endif

                        @if($desc2)
                            <p class="m-b-25" style="color: #64748b; font-size: 16px; line-height: 1.7;">
                                {{ __($desc2) }}
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

            <!-- Right Side: Course Image (Right Side Image) -->
            <div class="col-lg-6 col-md-12" data-aos="fade-left" data-aos-delay="100">
                <div class="single-course-img-card position-relative overflow-hidden shadow-lg" 
                     style="border-radius: 20px; background: #ffffff; border: 4px solid #ffffff; min-height: 600px;">
                    <img src="{{ $imageUrl }}" alt="{{ $title }}" class="img-fluid w-100" 
                         style="width: 100%; height: 100%; min-height: 600px; max-height: 640px; object-fit: cover; display: block; border-radius: 16px;">
                </div>
            </div>

        </div>
    </div>
</section>
@endif
