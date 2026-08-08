<!--====== Start FAQ Section ======-->
@if(isset($course) && count($course->faqs) > 0)
<style>
    .custom-faq-accordion .accordion-item {
        border: 1px solid #E5E7EB;
        border-radius: 14px !important;
        margin-bottom: 16px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.02);
        overflow: hidden;
        transition: all 0.3s ease;
        background: #ffffff;
    }
    .custom-faq-accordion .accordion-item:hover {
        border-color: #10b981;
        box-shadow: 0 8px 20px rgba(16, 185, 129, 0.08);
    }
    .custom-faq-accordion .accordion-button {
        background-color: #ffffff;
        color: #1a1b4b;
        font-weight: 700;
        font-size: 17px;
        padding: 22px 26px;
        box-shadow: none !important;
        border: none;
        display: flex;
        align-items: center;
        justify-content: space-between;
    }
    .custom-faq-accordion .accordion-button:not(.collapsed) {
        color: #10b981;
        background-color: #ffffff;
    }
    .custom-faq-accordion .accordion-button::after {
        display: none;
    }
    .custom-faq-accordion .faq-toggle-icon {
        width: 32px;
        height: 32px;
        border-radius: 50%;
        background-color: #F3F4F6;
        color: #1a1b4b;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 18px;
        font-weight: 400;
        transition: all 0.3s ease;
        flex-shrink: 0;
        margin-left: 15px;
    }
    .custom-faq-accordion .accordion-button:not(.collapsed) .faq-toggle-icon {
        background-color: #10b981;
        color: #ffffff;
        transform: rotate(45deg);
    }
    .custom-faq-accordion .accordion-body {
        background-color: #ffffff;
        color: #64748b;
        font-size: 15px;
        line-height: 1.75;
        padding: 0 26px 24px 26px;
        border-top: none;
    }
    .faq-image-card {
        position: relative;
        border-radius: 20px;
        overflow: hidden;
        box-shadow: 0 20px 45px rgba(0, 0, 0, 0.08);
        border: 6px solid #ffffff;
    }
    .faq-image-card img {
        width: 100%;
        height: 100%;
        min-height: 480px;
        max-height: 540px;
        object-fit: cover;
        display: block;
        border-radius: 14px;
    }
    .faq-badge-floating {
        position: absolute;
        bottom: 25px;
        left: 25px;
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(10px);
        padding: 16px 24px;
        border-radius: 16px;
        box-shadow: 0 10px 30px rgba(0,0,0,0.12);
        display: flex;
        align-items: center;
        gap: 15px;
    }
</style>

<section class="faq-section p-t-80 p-b-80 position-relative" style="background-color: #F9FAFB;">
    <div class="container container-1278">
        <div class="row align-items-center g-5">
            
            <!-- Left Column: FAQ Accordion -->
            <div class="col-lg-6 col-md-12">
                <div class="faq-content-wrap">
                    <div class="common-heading m-b-30">
                        <span class="sub-title text-uppercase fw-bold m-b-12 d-inline-block" style="color: #10b981; letter-spacing: 1.5px; font-size: 14px;">
                            {{ __('POPULAR QUESTIONS') }}
                        </span>
                        <h2 class="fw-bold m-b-0" style="color: #1a1b4b; font-size: 38px; line-height: 1.25;">
                            {{ __('Frequently Asked Questions') }}
                        </h2>
                    </div>
                    
                    <div class="accordion custom-faq-accordion" id="courseFaqAccordion">
                        @foreach($course->faqs as $key => $faq)
                        <div class="accordion-item" data-aos="fade-up" data-aos-delay="{{ $loop->index * 80 }}">
                            <h2 class="accordion-header" id="headingFaq{{ $key }}">
                                <button class="accordion-button {{ $loop->first ? '' : 'collapsed' }}" 
                                        type="button" 
                                        data-bs-toggle="collapse" 
                                        data-bs-target="#collapseFaq{{ $key }}" 
                                        aria-expanded="{{ $loop->first ? 'true' : 'false' }}" 
                                        aria-controls="collapseFaq{{ $key }}">
                                    <span>{{ $faq->question }}</span>
                                    <span class="faq-toggle-icon">+</span>
                                </button>
                            </h2>
                            <div id="collapseFaq{{ $key }}" 
                                 class="accordion-collapse collapse {{ $loop->first ? 'show' : '' }}" 
                                 aria-labelledby="headingFaq{{ $key }}" 
                                 data-bs-parent="#courseFaqAccordion">
                                <div class="accordion-body">
                                    {!! $faq->answer !!}
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <!-- Right Column: Image Card -->
            <div class="col-lg-6 col-md-12 ps-lg-5" data-aos="fade-left" data-aos-delay="200">
                @php
                    $faqImgUrl = '';
                    if (!empty($course->faq_image)) {
                        $faqImgUrl = getFileLink('original_image', $course->faq_image);
                    }
                    if (!$faqImgUrl || str_contains($faqImgUrl, 'default')) {
                        $faqImgUrl = static_asset('frontend/img/section/faq_illustration.png');
                    }
                @endphp

                <div class="faq-image-card">
                    <img src="{{ $faqImgUrl }}" alt="Frequently Asked Questions">
                    
                    <div class="faq-badge-floating d-none d-sm-flex">
                        <div class="faq-badge-icon d-flex align-items-center justify-content-center" 
                             style="width: 46px; height: 46px; border-radius: 12px; background: rgba(16, 185, 129, 0.15); color: #10b981; font-size: 1.3rem;">
                            <i class="fas fa-question-circle"></i>
                        </div>
                        <div>
                            <h5 class="fw-bold mb-0" style="color: #1a1b4b; font-size: 1rem;">Any Doubts or Questions?</h5>
                            <span class="text-secondary" style="font-size: 0.85rem;">We are here to support your learning journey</span>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>
@endif
<!--====== End FAQ Section ======-->
