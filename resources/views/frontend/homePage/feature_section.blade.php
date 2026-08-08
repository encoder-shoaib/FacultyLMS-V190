@if(setting('feature_section_status') !== '0')
@php
    $lang = app()->getLocale();
    $f1_title = setting('feature_1_title', $lang) ?: 'Life Time Access';
    $f1_desc  = setting('feature_1_desc', $lang)  ?: 'Donec nec justo eget felis facilisis fermentum. Aliquam porttitor.';
    $f1_icon  = setting('feature_1_icon')          ?: 'fas fa-shield-alt';

    $f2_title = setting('feature_2_title', $lang) ?: 'Free Course Materials';
    $f2_desc  = setting('feature_2_desc', $lang)  ?: 'Donec nec justo eget felis facilisis fermentum. Aliquam porttitor.';
    $f2_icon  = setting('feature_2_icon')          ?: 'fas fa-book-open';

    $f3_title = setting('feature_3_title', $lang) ?: 'Dedicated Support';
    $f3_desc  = setting('feature_3_desc', $lang)  ?: 'Donec nec justo eget felis facilisis fermentum. Aliquam porttitor.';
    $f3_icon  = setting('feature_3_icon')          ?: 'fas fa-headset';
@endphp
<section class="feature-cards-section p-t-80 p-b-80" style="background-color: #ffffff;">
    <div class="container container-1278">
        <div class="row g-4 justify-content-center">
            <!-- Card 1 -->
            <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="0">
                <div class="feature-card bg-white p-4 p-lg-4 d-flex align-items-center gap-4 h-100" 
                     style="border-radius: 18px; transition: all 0.3s ease; border: 1px solid #F1F5F9; box-shadow: 0 10px 25px rgba(0, 0, 0, 0.03);" 
                     onmouseover="this.style.transform='translateY(-6px)'; this.style.boxShadow='0 20px 35px rgba(16, 185, 129, 0.12)'; this.style.borderColor='#10b981';" 
                     onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 10px 25px rgba(0,0,0,0.03)'; this.style.borderColor='#F1F5F9';">
                    
                    <div class="feature-icon-wrapper d-flex align-items-center justify-content-center flex-shrink-0" 
                         style="width: 68px; height: 68px; border-radius: 16px; background: rgba(16, 185, 129, 0.12); color: #10b981;">
                        @if(str_contains($f1_icon, 'fa'))
                            <i class="{{ $f1_icon }}" style="font-size: 28px;"></i>
                        @else
                            <svg width="34" height="34" viewBox="0 0 24 24" fill="none" stroke="#10b981" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/>
                                <rect x="9" y="11" width="6" height="4" rx="1"/>
                            </svg>
                        @endif
                    </div>
                    <div class="feature-content">
                        <h4 class="fw-bold mb-2" style="color: #1a1b4b; font-size: 19px;">{{ __($f1_title) }}</h4>
                        <p class="mb-0" style="color: #64748b; font-size: 14.5px; line-height: 1.6;">{{ __($f1_desc) }}</p>
                    </div>
                </div>
            </div>

            <!-- Card 2 -->
            <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="100">
                <div class="feature-card bg-white p-4 p-lg-4 d-flex align-items-center gap-4 h-100" 
                     style="border-radius: 18px; transition: all 0.3s ease; border: 1px solid #F1F5F9; box-shadow: 0 10px 25px rgba(0, 0, 0, 0.03);" 
                     onmouseover="this.style.transform='translateY(-6px)'; this.style.boxShadow='0 20px 35px rgba(16, 185, 129, 0.12)'; this.style.borderColor='#10b981';" 
                     onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 10px 25px rgba(0,0,0,0.03)'; this.style.borderColor='#F1F5F9';">
                    
                    <div class="feature-icon-wrapper d-flex align-items-center justify-content-center flex-shrink-0" 
                         style="width: 68px; height: 68px; border-radius: 16px; background: rgba(16, 185, 129, 0.12); color: #10b981;">
                        @if(str_contains($f2_icon, 'fa'))
                            <i class="{{ $f2_icon }}" style="font-size: 28px;"></i>
                        @else
                            <svg width="34" height="34" viewBox="0 0 24 24" fill="none" stroke="#10b981" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M2 3h6a4 4 0 0 1 4 4v14a3 3 0 0 0-3-3H2z"/>
                                <path d="M22 3h-6a4 4 0 0 0-4 4v14a3 3 0 0 1 3-3h7z"/>
                            </svg>
                        @endif
                    </div>
                    <div class="feature-content">
                        <h4 class="fw-bold mb-2" style="color: #1a1b4b; font-size: 19px;">{{ __($f2_title) }}</h4>
                        <p class="mb-0" style="color: #64748b; font-size: 14.5px; line-height: 1.6;">{{ __($f2_desc) }}</p>
                    </div>
                </div>
            </div>

            <!-- Card 3 -->
            <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="200">
                <div class="feature-card bg-white p-4 p-lg-4 d-flex align-items-center gap-4 h-100" 
                     style="border-radius: 18px; transition: all 0.3s ease; border: 1px solid #F1F5F9; box-shadow: 0 10px 25px rgba(0, 0, 0, 0.03);" 
                     onmouseover="this.style.transform='translateY(-6px)'; this.style.boxShadow='0 20px 35px rgba(16, 185, 129, 0.12)'; this.style.borderColor='#10b981';" 
                     onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 10px 25px rgba(0,0,0,0.03)'; this.style.borderColor='#F1F5F9';">
                    
                    <div class="feature-icon-wrapper d-flex align-items-center justify-content-center flex-shrink-0" 
                         style="width: 68px; height: 68px; border-radius: 16px; background: rgba(16, 185, 129, 0.12); color: #10b981;">
                        @if(str_contains($f3_icon, 'fa'))
                            <i class="{{ $f3_icon }}" style="font-size: 28px;"></i>
                        @else
                            <svg width="34" height="34" viewBox="0 0 24 24" fill="none" stroke="#10b981" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/>
                            </svg>
                        @endif
                    </div>
                    <div class="feature-content">
                        <h4 class="fw-bold mb-2" style="color: #1a1b4b; font-size: 19px;">{{ __($f3_title) }}</h4>
                        <p class="mb-0" style="color: #64748b; font-size: 14.5px; line-height: 1.6;">{{ __($f3_desc) }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endif
