<div class="col-xxl-3 col-lg-4 col-md-4">
    <h3 class="section-title"{{ __('theme_option') }}></h3>
    <div class="bg-white redious-border py-3 py-sm-30 mb-30">
        <div class="email-tamplate-sidenav">
            <ul class="default-sidenav">
                @if(hasPermission('website.themes'))
                    <li>
                        <a href="{{ route('website.themes') }}"
                           class="{{ request()->routeIs('website.themes') ? 'active' : '' }}">
                            <span class="icon"><i class="las la-feather"></i></span>
                            <span>{{ __('website_themes') }}</span>
                        </a>
                    </li>
                @endif
                @if(hasPermission('theme.options'))
                    <li>
                        <a href="{{ route('theme.options') }}"
                           class="{{ request()->routeIs('theme.options') ? 'active' : '' }}">
                            <span class="icon"><i class="las la-palette"></i></span>
                            <span>{{ __('theme_options') }}</span>
                        </a>
                    </li>
                @endif
                @if(hasPermission('header.logo'))
                    <li>
                        <a href="{{ route('header.logo') }}"
                           class="{{ request()->routeIs('header.logo') || request()->routeIs('header.topbar') || request()->routeIs('header.menu') ? 'active' : '' }}">
                            <span class="icon"><i class="las la-heading"></i></span>
                            <span>{{ __('header_content') }}</span>
                        </a>
                    </li>
                @endif
                @if(hasPermission('hero.section'))
                    <li>
                        <a href="{{ route('hero.section') }}"
                           class="{{ request()->routeIs('hero.section') ? 'active' : '' }}">
                            <span class="icon"><i class="las la-hand-point-up"></i></span>
                            <span>{{ __('hero_section') }}</span>
                        </a>
                    </li>
                @endif
                @if(hasPermission('footer.social-links'))

                    <li>
                        <a href="{{ route('footer.content') }}"
                           class="@if(request()->routeIs('footer.content') || request()->routeIs('footer.social-links') || request()->routeIs('footer.newsletter-settings') || request()->routeIs('footer.useful-links') || request()->routeIs('footer.resource-links') || request()->routeIs('footer.quick-links') || request()->routeIs('footer.apps-links') || request()->routeIs('footer.payment-banner-settings') || request()->routeIs('footer.copyright')) active @endif">
                            <span class="icon"><i class="las la-memory"></i></span>
                            <span>{{ __('footer_content') }}</span>
                        </a>
                    </li>
                @endif
                @if(hasPermission('website.cta'))

                    <li>
                        <a href="{{ route('website.cta') }}"
                           class="{{ request()->routeIs('website.cta') ? 'active' : '' }}">
                            <span class="icon"><i class="las la-memory"></i></span>
                            <span>{{ __('cta_content') }}</span>
                        </a>
                    </li>
                @endif
                @if(hasPermission('website.popup'))
                    <li>
                        <a href="{{ route('website.popup') }}"
                           class="{{ request()->routeIs('website.popup') ? 'active' : '' }}">
                            <span class="icon"><i class="las la-sticky-note"></i></span>
                            <span>{{ __('website_popup') }}</span>
                        </a>
                    </li>
                @endif
                @if(hasPermission('website.seo'))
                    <li>
                        <a href="{{ route('website.seo') }}"
                           class="{{ request()->routeIs('website.seo') ? 'active' : '' }}">
                            <span class="icon"><i class="las la-bullhorn"></i></span>
                            <span>{{ __('website_seo') }}</span>
                        </a>
                    </li>
                @endif
                @if(hasPermission('custom.js'))
                    <li>
                        <a href="{{ route('custom.js') }}"
                           class="{{ request()->routeIs('custom.js') ? 'active' : '' }}">
                            <span class="icon"><i class="lab la-js-square"></i></span>
                            <span>{{ __('custom_js') }}</span>
                        </a>
                    </li>
                @endif
                @if(hasPermission('website.instructor_content'))
                    <li>
                        <a href="{{ route('website.instructor_content') }}"
                           class="{{ request()->routeIs('website.instructor_content') ? 'active' : '' }}">
                            <span class="icon"><i class="lab la-js-square"></i></span>
                            <span>{{ __('instructor_content') }}</span>
                        </a>
                    </li>
                @endif
                @if(hasPermission('website.webinar_section'))
                    <li>
                        <a href="{{ route('website.webinar_section') }}"
                           class="{{ request()->routeIs('website.webinar_section') ? 'active' : '' }}">
                            <span class="icon"><i class="las la-video"></i></span>
                            <span>{{ __('webinar_section') }}</span>
                        </a>
                    </li>
                @endif
                @if(hasPermission('website.feature_section'))
                    <li>
                        <a href="{{ route('website.feature_section') }}"
                           class="{{ request()->routeIs('website.feature_section') ? 'active' : '' }}">
                            <span class="icon"><i class="las la-th-large"></i></span>
                            <span>{{ __('feature_section') }}</span>
                        </a>
                    </li>
                @endif
                <li>
                    <a href="{{ route('website.about_section') }}"
                       class="{{ request()->routeIs('website.about_section') ? 'active' : '' }}">
                        <span class="icon"><i class="las la-user-tie"></i></span>
                        <span>{{ __('about_me_section') }}</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('website.why_choose_section') }}"
                       class="{{ request()->routeIs('website.why_choose_section') ? 'active' : '' }}">
                        <span class="icon"><i class="las la-check-circle"></i></span>
                        <span>{{ __('why_choose_section') }}</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('website.success_video_section') }}"
                       class="{{ request()->routeIs('website.success_video_section') ? 'active' : '' }}">
                        <span class="icon"><i class="las la-play-circle"></i></span>
                        <span>{{ __('success_video_section') }}</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('website.ad_banner_section') }}"
                       class="{{ request()->routeIs('website.ad_banner_section') ? 'active' : '' }}">
                        <span class="icon"><i class="las la-ad"></i></span>
                        <span>{{ __('ad_banner_section') }}</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('website.single_course_section') }}"
                       class="{{ request()->routeIs('website.single_course_section') ? 'active' : '' }}">
                        <span class="icon"><i class="las la-graduation-cap"></i></span>
                        <span>{{ __('single_course_section') }}</span>
                    </a>
                </li>
                @if(hasPermission('custom.css'))
                    <li>
                        <a href="{{ route('custom.css') }}"
                           class="{{ request()->routeIs('custom.css') ? 'active' : '' }}">
                            <span class="icon"><i class="lab la-css3-alt"></i></span>
                            <span>{{ __('custom_css') }}</span>
                        </a>
                    </li>
                @endif
                @if(hasPermission('gdpr'))
                    <li>
                        <a href="{{ route('gdpr') }}" class="{{ request()->routeIs('gdpr') ? 'active' : '' }}">
                            <span class="icon"><i class="las la-shield-alt"></i></span>
                            <span>{{ __('gdpr') }}</span>
                        </a>
                    </li>
                @endif
                @if(hasPermission('google.setup'))
                    <li>
                        <a href="{{ route('google.setup') }}"
                           class="{{ request()->routeIs('google.setup') ? 'active' : '' }}">
                            <span class="icon"><i class="lab la-google"></i></span>
                            <span>{{ __('google_setup') }}</span>
                        </a>
                    </li>
                @endif
                @if(hasPermission('fb.pixel'))
                    <li>
                        <a href="{{ route('fb.pixel') }}" class="{{ request()->routeIs('fb.pixel') ? 'active' : '' }}">
                            <span class="icon"><i class="lab la-facebook-square"></i></span>
                            <span>{{ __('fb_pixel') }}</span>
                        </a>
                    </li>
                @endif
            </ul>
        </div>
    </div>
</div>
