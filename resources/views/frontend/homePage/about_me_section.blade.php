@php
    $lang = app()->getLocale();
    $status = setting('about_me_status');
    $tag = setting('about_me_tag', $lang) ?: 'ABOUT ME';
    $title = setting('about_me_title', $lang) ?: 'I\'m Teaching Online For About 5+ Years On Programming';
    $desc1 = setting('about_me_description', $lang) ?: 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Donec odio. Quisque volutpat mattis eros. Nullam malesuada erat ut turpis. Suspendisse urna nibh, viverra non.';
    $desc2 = setting('about_me_description_2', $lang) ?: 'Donec nec justo eget felis facilisis fermentum. Aliquam porttitor mauris sit amet orci. Aenean dignissim pellentesque felis.';
    $btnText = setting('about_me_btn_text', $lang) ?: 'LEARN MORE';
    $btnUrl = setting('about_me_btn_url', $lang) ?: '#';

    $aboutImgSetting = setting('about_me_image');
    $aboutImgUrl = '';
    if ($aboutImgSetting) {
        $aboutImgUrl = getFileLink('original_image', $aboutImgSetting);
    }
    if (!$aboutImgUrl || str_contains($aboutImgUrl, 'default')) {
        $aboutImgUrl = static_asset('frontend/img/hero/hero-v5-masonry-1.jpg');
    }
@endphp

@if($status !== '0')
<section class="about-me-section p-t-80 p-b-80 p-t-sm-40 p-b-sm-50 position-relative overflow-hidden bg-white">
    <div class="container container-1278">
        <div class="row align-items-center g-4 g-lg-5">
            <!-- Left Side Image Card (Matching FacultyLMS section card styles) -->
            <div class="col-lg-6 col-md-12">
                <div class="about-me-card position-relative overflow-hidden shadow-sm" 
                     style="border-radius: 12px; min-height: 520px; background: linear-gradient(135deg, #FFE485 0%, #FCD34D 100%);">
                    
                    <img src="{{ $aboutImgUrl }}" alt="About Me Instructor" 
                         class="img-fluid w-100" 
                         style="object-fit: cover; width: 100%; height: 100%; min-height: 520px; border-radius: 12px; display: block;">
                </div>
            </div>

            <!-- Right Side Text Content (Using FacultyLMS common-heading and template-btn) -->
            <div class="col-lg-6 col-md-12">
                <div class="about-me-text-block ps-lg-4">
                    <div class="common-heading">
                        @if($tag)
                            <span class="sub-title text-uppercase fw-bold m-b-15 d-inline-block" style="color: #10b981; letter-spacing: 1.5px; font-size: 14px;">
                                {{ __($tag) }}
                            </span>
                        @endif

                        @if($title)
                            <h3 class="m-b-20" style="color: #1a1b4b;">
                                {{ __($title) }}
                            </h3>
                        @endif

                        @if($desc1)
                            <p class="m-b-15">
                                {{ __($desc1) }}
                            </p>
                        @endif

                        @if($desc2)
                            <p class="m-b-25">
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
        </div>
    </div>
</section>
@endif
