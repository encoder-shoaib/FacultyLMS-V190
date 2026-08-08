@php
    $lang = app()->getLocale();
    $status = setting('why_choose_status');
    $title = setting('why_choose_title', $lang) ?: 'Why Choose Me?';

    $item1_title = setting('why_choose_item1_title', $lang) ?: 'Highly Experienced';
    $item1_desc  = setting('why_choose_item1_desc', $lang) ?: 'Donec nec justo eget felis facilisis fermentum. Aliquam porttitor mauris sit amet orci. Aenean dignissim.';

    $item2_title = setting('why_choose_item2_title', $lang) ?: 'Question, Quiz & Course Materials';
    $item2_desc  = setting('why_choose_item2_desc', $lang) ?: 'Donec nec justo eget felis facilisis fermentum. Aliquam porttitor mauris sit amet orci. Aenean dignissim.';

    $item3_title = setting('why_choose_item3_title', $lang) ?: 'Lifetime Course Update & Access';
    $item3_desc  = setting('why_choose_item3_desc', $lang) ?: 'Donec nec justo eget felis facilisis fermentum. Aliquam porttitor mauris sit amet orci. Aenean dignissim.';

    $item4_title = setting('why_choose_item4_title', $lang) ?: 'Dedicated Support';
    $item4_desc  = setting('why_choose_item4_desc', $lang) ?: 'Donec nec justo eget felis facilisis fermentum. Aliquam porttitor mauris sit amet orci. Aenean dignissim.';

    $resolveImgUrl = function($settingKey, $defaultUrl) {
        $val = setting($settingKey);
        if ($val) {
            $url = getFileLink('original_image', $val);
            if ($url && !str_contains($url, 'default')) return $url;
        }
        return $defaultUrl;
    };

    $img1 = $resolveImgUrl('why_choose_image_1', 'https://images.unsplash.com/photo-1573496359142-b8d87734a5a2?q=80&w=600&auto=format&fit=crop');
    $img2 = $resolveImgUrl('why_choose_image_2', 'https://images.unsplash.com/photo-1522202176988-66273c2fd55f?q=80&w=600&auto=format&fit=crop');
    $img3 = $resolveImgUrl('why_choose_image_3', 'https://images.unsplash.com/photo-1523240795612-9a054b0db644?q=80&w=600&auto=format&fit=crop');
@endphp

@if($status !== '0')
<section class="why-choose-section p-t-80 p-b-80 position-relative bg-white">
    <div class="container container-1278">
        <div class="row align-items-center g-5">
            
            <!-- Left Side: Staggered 3-Image Collage -->
            <div class="col-lg-6 col-md-12">
                <div class="why-choose-collage position-relative w-100" style="min-height: 520px; max-width: 540px; margin: 0 auto;">
                    
                    <!-- Image 2: Mid-Left Card -->
                    <div class="collage-card card-left position-absolute overflow-hidden shadow" 
                         style="top: 80px; left: 0; width: 55%; height: 270px; border-radius: 20px; z-index: 1; border: 4px solid #ffffff; transition: transform 0.3s ease;">
                        <img src="{{ $img2 }}" alt="Why Choose Me 2" style="width: 100%; height: 100%; object-fit: cover;">
                    </div>

                    <!-- Image 1: Top-Right Card -->
                    <div class="collage-card card-top-right position-absolute overflow-hidden shadow" 
                         style="top: 0; right: 10px; width: 48%; height: 260px; border-radius: 20px; z-index: 2; border: 4px solid #ffffff; transition: transform 0.3s ease;">
                        <img src="{{ $img1 }}" alt="Why Choose Me 1" style="width: 100%; height: 100%; object-fit: cover;">
                    </div>

                    <!-- Image 3: Bottom-Right Card -->
                    <div class="collage-card card-bottom position-absolute overflow-hidden shadow-lg" 
                         style="top: 230px; right: 30px; width: 52%; height: 270px; border-radius: 20px; z-index: 3; border: 4px solid #ffffff; transition: transform 0.3s ease;">
                        <img src="{{ $img3 }}" alt="Why Choose Me 3" style="width: 100%; height: 100%; object-fit: cover;">
                    </div>

                </div>
            </div>

            <!-- Right Side: Feature Items List -->
            <div class="col-lg-6 col-md-12">
                <div class="why-choose-content ps-lg-4">
                    <div class="common-heading m-b-35">
                        <h2 class="m-b-10 fw-bold" style="color: #1a1b4b; font-size: 2.5rem; line-height: 1.25;">
                            {{ __($title) }}
                        </h2>
                    </div>

                    <div class="why-choose-features d-flex flex-column gap-4">
                        
                        <!-- Item 1 -->
                        <div class="feature-item d-flex gap-3 align-items-start">
                            <div class="feature-icon flex-shrink-0 d-flex align-items-center justify-content-center" 
                                 style="width: 52px; height: 52px; border-radius: 12px; background: rgba(16, 185, 129, 0.1); color: #10b981; font-size: 1.5rem;">
                                <i class="fas fa-user-graduate"></i>
                            </div>
                            <div class="feature-text">
                                <h4 class="fw-bold mb-1" style="color: #1a1b4b; font-size: 1.2rem;">{{ __($item1_title) }}</h4>
                                <p class="m-0" style="color: #64748b; font-size: 0.98rem; line-height: 1.6;">{{ __($item1_desc) }}</p>
                            </div>
                        </div>

                        <!-- Item 2 -->
                        <div class="feature-item d-flex gap-3 align-items-start">
                            <div class="feature-icon flex-shrink-0 d-flex align-items-center justify-content-center" 
                                 style="width: 52px; height: 52px; border-radius: 12px; background: rgba(16, 185, 129, 0.1); color: #10b981; font-size: 1.5rem;">
                                <i class="fas fa-book-open"></i>
                            </div>
                            <div class="feature-text">
                                <h4 class="fw-bold mb-1" style="color: #1a1b4b; font-size: 1.2rem;">{{ __($item2_title) }}</h4>
                                <p class="m-0" style="color: #64748b; font-size: 0.98rem; line-height: 1.6;">{{ __($item2_desc) }}</p>
                            </div>
                        </div>

                        <!-- Item 3 -->
                        <div class="feature-item d-flex gap-3 align-items-start">
                            <div class="feature-icon flex-shrink-0 d-flex align-items-center justify-content-center" 
                                 style="width: 52px; height: 52px; border-radius: 12px; background: rgba(16, 185, 129, 0.1); color: #10b981; font-size: 1.5rem;">
                                <i class="fas fa-infinity"></i>
                            </div>
                            <div class="feature-text">
                                <h4 class="fw-bold mb-1" style="color: #1a1b4b; font-size: 1.2rem;">{{ __($item3_title) }}</h4>
                                <p class="m-0" style="color: #64748b; font-size: 0.98rem; line-height: 1.6;">{{ __($item3_desc) }}</p>
                            </div>
                        </div>

                        <!-- Item 4 -->
                        <div class="feature-item d-flex gap-3 align-items-start">
                            <div class="feature-icon flex-shrink-0 d-flex align-items-center justify-content-center" 
                                 style="width: 52px; height: 52px; border-radius: 12px; background: rgba(16, 185, 129, 0.1); color: #10b981; font-size: 1.5rem;">
                                <i class="fas fa-headset"></i>
                            </div>
                            <div class="feature-text">
                                <h4 class="fw-bold mb-1" style="color: #1a1b4b; font-size: 1.2rem;">{{ __($item4_title) }}</h4>
                                <p class="m-0" style="color: #64748b; font-size: 0.98rem; line-height: 1.6;">{{ __($item4_desc) }}</p>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

        </div>
    </div>
</section>
@endif
