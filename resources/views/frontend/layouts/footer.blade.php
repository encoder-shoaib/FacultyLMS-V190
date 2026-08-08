<!--====== Start Floating Newsletter Section ======-->
<div class="footer-newsletter-wrapper" style="position: relative; z-index: 10; margin-bottom: -65px;">
    <div class="container container-1278">
        <div class="newsletter-card shadow-lg" 
             style="background-color: {{ setting('promo_banner_bg_color') ?: '#fcd34d' }}; border-radius: 20px; padding: 35px 40px;">
            <div class="row align-items-center g-4">
                <!-- Column 1: Newsletter Title & Description -->
                <div class="col-lg-4 col-md-12">
                    <h3 class="fw-bold mb-2" style="color: #1a1b4b; font-size: 24px; line-height: 1.2;">
                        {{ setting('newsletter_title', app()->getLocale()) ?: __('Subscribe Newsletter') }}
                    </h3>
                    <p class="mb-0" style="color: #4b5563; font-size: 14px; line-height: 1.5;">
                        {{ setting('newsletter_description', app()->getLocale()) ?: (setting('newsletter_description') ?: __('Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.')) }}
                    </p>
                </div>

                <!-- Column 2: Email Form with Pill Input & Round Submit Button -->
                <div class="col-lg-5 col-md-7">
                    <form action="{{ route('subscribe') }}" method="POST" class="footer-subscription-form ajax_form">
                        @csrf
                        <div class="d-flex align-items-center bg-white p-1 shadow-sm" style="border-radius: 50px;">
                            <input type="email" name="email" class="form-control border-0 shadow-none px-4" 
                                   placeholder="{{ __('your_email') ?: 'Email' }}" required 
                                   style="background: transparent; font-size: 15px; color: #333;">
                            <button type="submit" class="btn border-0 d-flex align-items-center justify-content-center flex-shrink-0" 
                                    style="width: 46px; height: 46px; border-radius: 50%; background-color: #111111; color: #ffffff; transition: transform 0.2s ease;">
                                <i class="fas fa-paper-plane" style="font-size: 16px;"></i>
                            </button>
                        </div>
                    </form>
                </div>

                <!-- Column 3: Admission Now Countdown Timer -->
                <div class="col-lg-3 col-md-5 text-center text-lg-end">
                    <div class="mb-2 fw-bold text-dark text-center text-lg-center" style="font-size: 1.05rem;">{{ __('Admission Now') }}</div>
                    <div class="mini-countdown d-flex justify-content-center justify-content-lg-center gap-2" id="promoCountdownFooter" data-target="{{ setting('promo_banner_countdown') ?: date('Y-m-d H:i:s', strtotime('+5 days')) }}">
                        <div class="bg-white rounded p-2 text-center shadow-sm" style="width: 52px;">
                            <h4 class="days m-0 fw-bold" style="color: #ea580c; font-size: 1.1rem;">00</h4>
                            <span class="small text-secondary fw-semibold" style="font-size: 10px;">DAYS</span>
                        </div>
                        <div class="bg-white rounded p-2 text-center shadow-sm" style="width: 52px;">
                            <h4 class="hours m-0 fw-bold" style="color: #ea580c; font-size: 1.1rem;">00</h4>
                            <span class="small text-secondary fw-semibold" style="font-size: 10px;">HRS</span>
                        </div>
                        <div class="bg-white rounded p-2 text-center shadow-sm" style="width: 52px;">
                            <h4 class="minutes m-0 fw-bold" style="color: #ea580c; font-size: 1.1rem;">00</h4>
                            <span class="small text-secondary fw-semibold" style="font-size: 10px;">MIN</span>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

<!--====== Start Main Dark Footer Area ======-->
<footer class="footer-area footer-area-v2" style="background-color: #110B3A; color: #ffffff; padding-top: 120px; padding-bottom: 30px; position: relative;">
    <div class="footer-widget">
        <div class="container container-1278">
            <div class="row g-4 justify-content-between">
                
                <!-- Column 1: Logo & Logo Description -->
                <div class="col-lg-4 col-md-6">
                    <div class="footer-widget-item pe-lg-3">
                        <a href="{{ url('/') }}" class="brand-logo d-inline-block mb-3">
                            @php
                                $src = setting('light_logo') && @is_file_exists(setting('light_logo')['original_image']) ? get_media(setting('light_logo')['original_image']) : get_media('images/default/logo/logo-green-white.png');
                            @endphp
                            <img style="max-width: 150px;" src="{{ $src }}" alt="logo">
                        </a>
                        <p style="color: #94a3b8; font-size: 14.5px; line-height: 1.7; margin-bottom: 20px;">
                            {{ setting('footer_logo_description', app()->getLocale()) ?: (setting('footer_logo_description') ?: 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. In id erat eget nisl eleifend tristique in eu ipsum. Aliquam condimentum dictum magna in molestie.') }}
                        </p>
                    </div>
                </div>

                <!-- Column 2: Useful Links (Matching Header Navigation) -->
                @php
                    $useful_menu = headerFooterMenu('footer_useful_link_menu', app()->getLocale()) ?: (headerFooterMenu('footer_useful_link_menu') ?: setting('footer_useful_link_menu'));
                @endphp
                <div class="col-lg-2 col-md-3 col-6">
                    <div class="footer-widget-item">
                        <h5 class="widget-title fw-bold mb-4" style="color: #ffffff; font-size: 20px;">
                            {{ setting('useful_link_title', app()->getLocale()) ?: __('Useful Links') }}
                        </h5>
                        <ul class="list-unstyled mb-0" style="font-size: 14.5px;">
                            @if (is_array($useful_menu) && count($useful_menu) > 0)
                                @foreach ($useful_menu as $usefulLink)
                                    <li class="mb-2">
                                        <a href="{{ $usefulLink['url'] }}" style="color: #e2e8f0; text-decoration: none; transition: color 0.2s;" onmouseover="this.style.color='#10b981'" onmouseout="this.style.color='#e2e8f0'">
                                            <i class="fas fa-circle me-2" style="font-size: 7px; color: #10b981; vertical-align: middle;"></i>
                                            {{ $usefulLink['label'] }}
                                        </a>
                                    </li>
                                @endforeach
                            @else
                                <li class="mb-2"><a href="{{ url('/') }}" style="color: #e2e8f0; text-decoration: none; transition: color 0.2s;" onmouseover="this.style.color='#10b981'" onmouseout="this.style.color='#e2e8f0'"><i class="fas fa-circle me-2" style="font-size: 7px; color: #10b981; vertical-align: middle;"></i>{{ __('Home') }}</a></li>
                                <li class="mb-2"><a href="{{ route('courses') }}" style="color: #e2e8f0; text-decoration: none; transition: color 0.2s;" onmouseover="this.style.color='#10b981'" onmouseout="this.style.color='#e2e8f0'"><i class="fas fa-circle me-2" style="font-size: 7px; color: #10b981; vertical-align: middle;"></i>{{ __('Courses') }}</a></li>
                                <li class="mb-2"><a href="{{ route('submit.testimonial') }}" style="color: #e2e8f0; text-decoration: none; transition: color 0.2s;" onmouseover="this.style.color='#10b981'" onmouseout="this.style.color='#e2e8f0'"><i class="fas fa-circle me-2" style="font-size: 7px; color: #10b981; vertical-align: middle;"></i>{{ __('Success Story') }}</a></li>
                                <li class="mb-2"><a href="{{ route('contact') }}" style="color: #e2e8f0; text-decoration: none; transition: color 0.2s;" onmouseover="this.style.color='#10b981'" onmouseout="this.style.color='#e2e8f0'"><i class="fas fa-circle me-2" style="font-size: 7px; color: #10b981; vertical-align: middle;"></i>{{ __('Contact') }}</a></li>
                            @endif
                        </ul>
                    </div>
                </div>

                <!-- Column 3: Resource Links (Support - 3 Pages) -->
                @php
                    $resource_menu = headerFooterMenu('footer_resource_link_menu', app()->getLocale()) ?: (headerFooterMenu('footer_resource_link_menu') ?: setting('footer_resource_link_menu'));
                @endphp
                <div class="col-lg-2 col-md-3 col-6">
                    <div class="footer-widget-item">
                        <h5 class="widget-title fw-bold mb-4" style="color: #ffffff; font-size: 20px;">
                            {{ setting('resource_link_title', app()->getLocale()) ?: __('Resources') }}
                        </h5>
                        <ul class="list-unstyled mb-0" style="font-size: 14.5px;">
                            <li class="mb-2">
                                <a href="{{ url('privacy-policy') }}" style="color: #e2e8f0; text-decoration: none; transition: color 0.2s;" onmouseover="this.style.color='#10b981'" onmouseout="this.style.color='#e2e8f0'">
                                    <i class="fas fa-circle me-2" style="font-size: 7px; color: #10b981; vertical-align: middle;"></i>
                                    {{ __('Privacy Policy') }}
                                </a>
                            </li>
                            <li class="mb-2">
                                <a href="{{ url('terms-and-conditions') }}" style="color: #e2e8f0; text-decoration: none; transition: color 0.2s;" onmouseover="this.style.color='#10b981'" onmouseout="this.style.color='#e2e8f0'">
                                    <i class="fas fa-circle me-2" style="font-size: 7px; color: #10b981; vertical-align: middle;"></i>
                                    {{ __('Terms & Condition') }}
                                </a>
                            </li>
                            <li class="mb-2">
                                <a href="{{ url('refund-policy') }}" style="color: #e2e8f0; text-decoration: none; transition: color 0.2s;" onmouseover="this.style.color='#10b981'" onmouseout="this.style.color='#e2e8f0'">
                                    <i class="fas fa-circle me-2" style="font-size: 7px; color: #10b981; vertical-align: middle;"></i>
                                    {{ __('Refund Policy') }}
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>

                <!-- Column 4: Get In Touch / Contact Information -->
                <div class="col-lg-4 col-md-6">
                    <div class="footer-widget-item ps-lg-3">
                        <h5 class="widget-title fw-bold mb-4" style="color: #ffffff; font-size: 20px;">{{ __('Get In Touch') }}</h5>
                        
                        <p style="color: #94a3b8; font-size: 14.5px; line-height: 1.6; margin-bottom: 20px;">
                            {{ setting('footer_get_in_touch_desc', app()->getLocale()) ?: (setting('footer_get_in_touch_desc') ?: 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.') }}
                        </p>
                        
                        <div class="contact-info-list" style="font-size: 14.5px; color: #e2e8f0;">
                            <div class="d-flex align-items-center mb-2">
                                <i class="fas fa-map-marker-alt me-2" style="color: #10b981; font-size: 16px; width: 20px;"></i>
                                <span>{{ setting('contact_address', app()->getLocale()) ?: (setting('contact_address') ?: (setting('address') ?: '99 Roving St., Big City')) }}</span>
                            </div>

                            <div class="d-flex align-items-center mb-2">
                                <i class="fas fa-envelope me-2" style="color: #10b981; font-size: 16px; width: 20px;"></i>
                                <span>{{ setting('contact_email') ?: (setting('email') ?: 'Hello@Awesomesite.Com') }}</span>
                            </div>

                            <div class="d-flex align-items-center">
                                <i class="fas fa-phone-alt me-2" style="color: #10b981; font-size: 16px; width: 20px;"></i>
                                <span>{{ setting('contact_phone') ?: (setting('phone') ?: '+123-234-1234') }}</span>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>

        <!--====== Bottom Bar: Social Links & Copyright ======-->
        <div class="footer-bottom mt-5" style="border-top: 1px solid rgba(255, 255, 255, 0.1); padding-top: 25px;">
            <div class="container container-1278">
                <div class="row align-items-center justify-content-between g-3">
                    
                    <!-- Left: Follow Us Social Links -->
                    <div class="col-md-6 col-12 text-center text-md-start">
                        <div class="d-flex align-items-center justify-content-center justify-content-md-start gap-3">
                            <span class="fw-bold" style="color: #ffffff; font-size: 16px;">{{ __('Follow Us :') }}</span>
                            <div class="social-links-list d-flex gap-2">
                                <a href="{{ setting('facebook_link') ?: '#' }}" target="_blank" class="d-flex align-items-center justify-content-center text-white rounded-circle" style="width: 34px; height: 34px; background: rgba(255,255,255,0.1); text-decoration: none;"><i class="fab fa-facebook-f" style="font-size: 14px;"></i></a>
                                <a href="{{ setting('twitter_link') ?: '#' }}" target="_blank" class="d-flex align-items-center justify-content-center text-white rounded-circle" style="width: 34px; height: 34px; background: rgba(255,255,255,0.1); text-decoration: none;"><i class="fab fa-twitter" style="font-size: 14px;"></i></a>
                                <a href="{{ setting('youtube_link') ?: '#' }}" target="_blank" class="d-flex align-items-center justify-content-center text-white rounded-circle" style="width: 34px; height: 34px; background: rgba(255,255,255,0.1); text-decoration: none;"><i class="fab fa-youtube" style="font-size: 14px;"></i></a>
                                <a href="{{ setting('instagram_link') ?: '#' }}" target="_blank" class="d-flex align-items-center justify-content-center text-white rounded-circle" style="width: 34px; height: 34px; background: rgba(255,255,255,0.1); text-decoration: none;"><i class="fab fa-instagram" style="font-size: 14px;"></i></a>
                            </div>
                        </div>
                    </div>

                    <!-- Right: Copyright Text -->
                    <div class="col-md-6 col-12 text-center text-md-end ms-auto">
                        <span style="color: #94a3b8; font-size: 14px;">
                            {{ setting('copyright_title', app()->getLocale()) ?: (setting('copyright_title') ?: 'Copyright @ 2022 All Rights Reserved to SpaGreen') }}
                        </span>
                    </div>

                </div>
            </div>
        </div>
    </div>
</footer>
<!--====== End Footer Area ======-->

<!--====== Start Scroll To Top ======-->
<a href="#" class="back-to-top" id="fixed-scroll-top">
    <i class="far fa-angle-up"></i>
</a>
