@if(setting('webinar_status') !== '0')
@php
    $lang = app()->getLocale();
    $subtitle = setting('webinar_subtitle', $lang) ?: 'LIVE WEBINAR';
    $title = setting('webinar_title', $lang) ?: 'Join My Upcoming Webinars';
    $desc1 = setting('webinar_description_1', $lang) ?: 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Donec odio. Quisque volutpat mattis eros. Nullam malesuada erat ut turpis. Suspendisse urna nibh, viverra non.';
    $desc2 = setting('webinar_description_2', $lang) ?: 'Donec nec justo eget felis facilisis fermentum. Aliquam porttitor mauris sit amet orci. Aenean dignissim pellentesque felis.';
    $btnText = setting('webinar_btn_text', $lang) ?: 'REGISTER NOW';
    $btnLink = setting('webinar_btn_link', $lang) ?: route('student.sign_up');
    
    $webinarMediaSetting = setting('webinar_image');
    $webinarImageUrl = '';
    if ($webinarMediaSetting) {
        $webinarImageUrl = getFileLink('original_image', $webinarMediaSetting);
    }
@endphp
<section class="webinar-section p-t-80 p-b-80 position-relative" style="background-color: #F9FAFB;">
    <div class="container container-1278">
        <div class="row align-items-center g-5">
            <!-- Left Side: Live Webinar Video Frame / Card -->
            <div class="col-lg-6 col-md-12" data-aos="fade-right">
                <div class="webinar-frame-wrapper position-relative overflow-hidden shadow-lg" 
                     style="border-radius: 20px; background: #110B3A; border: 4px solid #ffffff;">
                    @if($webinarImageUrl && !str_contains($webinarImageUrl, 'default'))
                        <div class="webinar-custom-image overflow-hidden" style="min-height: 400px; max-height: 450px;">
                            <img src="{{ $webinarImageUrl }}" alt="{{ $title }}" class="img-fluid w-100" style="object-fit: cover; width: 100%; height: 100%; min-height: 400px; display: block; border-radius: 16px;">
                        </div>
                    @else
                        <!-- Default Webinar Grid Preview -->
                        <div class="webinar-grid-preview" style="background: #110B3A; padding: 12px; display: grid; grid-template-columns: repeat(4, 1fr); gap: 8px;">
                            <img src="https://images.unsplash.com/photo-1573496359142-b8d87734a5a2?q=80&w=400&auto=format&fit=crop" style="width: 100%; height: 125px; object-fit: cover; border-radius: 10px;" alt="Participant 1">
                            <img src="https://images.unsplash.com/photo-1580489944761-15a19d654956?q=80&w=400&auto=format&fit=crop" style="width: 100%; height: 125px; object-fit: cover; border-radius: 10px;" alt="Participant 2">
                            <img src="https://images.unsplash.com/photo-1560250097-0b93528c311a?q=80&w=400&auto=format&fit=crop" style="width: 100%; height: 125px; object-fit: cover; border-radius: 10px;" alt="Participant 3">
                            <img src="https://images.unsplash.com/photo-1519085360753-af0119f7cbe7?q=80&w=400&auto=format&fit=crop" style="width: 100%; height: 125px; object-fit: cover; border-radius: 10px;" alt="Participant 4">
                            <img src="https://images.unsplash.com/photo-1534528741775-53994a69daeb?q=80&w=400&auto=format&fit=crop" style="width: 100%; height: 125px; object-fit: cover; border-radius: 10px;" alt="Participant 5">
                            <img src="https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?q=80&w=400&auto=format&fit=crop" style="width: 100%; height: 125px; object-fit: cover; border-radius: 10px;" alt="Participant 6">
                            <img src="https://images.unsplash.com/photo-1517841905240-472988babdf9?q=80&w=400&auto=format&fit=crop" style="width: 100%; height: 125px; object-fit: cover; border-radius: 10px;" alt="Participant 7">
                            <img src="https://images.unsplash.com/photo-1500648767791-00dcc994a43e?q=80&w=400&auto=format&fit=crop" style="width: 100%; height: 125px; object-fit: cover; border-radius: 10px;" alt="Participant 8">
                        </div>
                        <!-- Controls bar only for default preview -->
                        <div class="webinar-controls-bar d-flex justify-content-center align-items-center gap-4 py-3" style="background: #1A1B4B; border-top: 1px solid rgba(255,255,255,0.1);">
                            <span class="control-btn fs-5" style="color: #10b981; cursor: pointer;"><i class="fas fa-microphone"></i></span>
                            <span class="control-btn fs-5" style="color: #10b981; cursor: pointer;"><i class="fas fa-volume-up"></i></span>
                            <span class="control-btn fs-5" style="color: #10b981; cursor: pointer;"><i class="fas fa-video"></i></span>
                            <span class="control-btn bg-danger text-white rounded-circle d-flex align-items-center justify-content-center" style="width: 34px; height: 34px; cursor: pointer;"><i class="fas fa-phone-slash" style="font-size: 13px; transform: rotate(135deg);"></i></span>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Right Side: Content & Action Button -->
            <div class="col-lg-6 col-md-12" data-aos="fade-left">
                <div class="webinar-content ps-lg-4">
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
                            <a href="{{ $btnLink }}" class="template-btn">
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
