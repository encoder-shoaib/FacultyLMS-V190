<section class="hero-area hero-area-v5 p-t-120 p-b-60 p-b-md-40">
    <div class="container container-1278">
        <div class="row justify-content-center align-items-center">
            <div class="col-xl-6 col-lg-6 col-md-10">
                <div class="hero-content text-align-center text-align-lg-start p-b-md-40" data-aos="fade-up" data-aos-delay="200">
                    <span class="hero-subtitle">#1 {{__('elearning_platform')}}</span>
                    <h1 class="hero-title"><span>grow up</span> your skill<span>.</span></h1>
                    <p>Explore new skills beyond the world of of creativity.</p>
                    <ul class="hero-btns d-flex justify-content-center justify-content-lg-start align-items-center">
                        <li>
                            <a href="#" class="template-btn">
                                Browse All Course <i class="fas fa-long-arrow-right"></i>
                            </a>
                        </li>
                        <li>
                            <a href="#" class="template-btn text-uppercase bordered-btn-secondary">
{{--                                Get started--}}
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-xl-6 col-lg-6 col-md-9">
                @php
                    $resolveHeroImg = function($key, $fallback = '') {
                        $val = setting($key);
                        if ($val) {
                            if (is_numeric($val)) {
                                $media = \App\Models\MediaLibrary::find($val);
                                if ($media && $media->image_variants) {
                                    return getFileLink('original_image', $media->image_variants);
                                }
                            }
                            if (is_array($val)) {
                                return getFileLink('original_image', $val);
                            }
                            if (is_string($val) && (str_contains($val, '/') || str_contains($val, '.'))) {
                                return getFileLink('original_image', $val);
                            }
                        }
                        return $fallback;
                    };
                    $hImg1 = $resolveHeroImg('header1_hero_image1') ?: static_asset('frontend/img/hero/hero-v5-masonry-1.jpg');
                    $hImg2 = $resolveHeroImg('header1_hero_image2') ?: static_asset('frontend/img/hero/hero-v5-masonry-2.jpg');
                    $hImg3 = $resolveHeroImg('header1_hero_image3') ?: static_asset('frontend/img/hero/hero-v5-masonry-3.jpg');
                    $hImg4 = $resolveHeroImg('header1_hero_image4') ?: static_asset('frontend/img/hero/hero-v5-masonry-4.jpg');
                @endphp
                <div class="hero-staggered-collage position-relative w-100" data-aos="fade-up" data-aos-delay="400" style="min-height: 520px; max-width: 580px; margin: 0 auto;">
                    <!-- Top Right Image -->
                    @if($hImg1)
                    <div class="collage-card card-1 position-absolute shadow-lg overflow-hidden" 
                         style="top: 0; right: 0; width: 55%; height: 320px; border-radius: 24px; z-index: 2; border: 3px solid rgba(255,255,255,0.15);">
                        <img src="{{ $hImg1 }}" alt="Hero Image 1" style="width: 100%; height: 100%; object-fit: cover;">
                    </div>
                    @endif

                    <!-- Left Middle Image -->
                    @if($hImg2)
                    <div class="collage-card card-2 position-absolute shadow-lg overflow-hidden" 
                         style="top: 90px; left: 0; width: 52%; height: 340px; z-index: 1; border-radius: 24px; border: 3px solid rgba(255,255,255,0.15);">
                        <img src="{{ $hImg2 }}" alt="Hero Image 2" style="width: 100%; height: 100%; object-fit: cover;">
                    </div>
                    @endif

                    <!-- Bottom Right Image -->
                    @if($hImg3)
                    <div class="collage-card card-3 position-absolute shadow-lg overflow-hidden" 
                         style="top: 230px; right: 2%; width: 55%; height: 310px; z-index: 3; border-radius: 24px; border: 3px solid rgba(255,255,255,0.2);">
                        <img src="{{ $hImg3 }}" alt="Hero Image 3" style="width: 100%; height: 100%; object-fit: cover;">
                    </div>
                    @endif

                    <!-- Fourth Floating Accent Image -->
                    @if($hImg4)
                    <div class="collage-card card-4 position-absolute shadow-lg overflow-hidden" 
                         style="bottom: -15px; left: 10%; width: 36%; height: 160px; z-index: 4; border-radius: 20px; border: 4px solid #ffffff;">
                        <img src="{{ $hImg4 }}" alt="Hero Image 4" style="width: 100%; height: 100%; object-fit: cover;">
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</section>
@include('frontend.homePage.feature_section')
