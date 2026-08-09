@extends('frontend.layouts.master')
@section('title', $course->title)
@section('content')

@push('css')
    <link rel="stylesheet" href="{{ static_asset('frontend/css/masterclass.css') }}">
@endpush

@php
    $mcSettings = $course->masterclass_settings ?? [];
    $eyebrowTitle = !empty($mcSettings['eyebrow_title']) ? $mcSettings['eyebrow_title'] : ($category ? $category->lang_title : 'E-commerce শুরু করার hidden path');
    $classScheduleTitle = !empty($mcSettings['class_schedule_title']) ? $mcSettings['class_schedule_title'] : '২ দিনব্যাপী e-commerce live masterclass';
    $classScheduleTime = !empty($mcSettings['class_schedule_time']) ? $mcSettings['class_schedule_time'] : '৬ আগস্ট তারিখ রাত ৮ টায় শুরু';
    $videoCaption = !empty($mcSettings['video_caption']) ? $mcSettings['video_caption'] : 'বিস্তারিত জানতে ভিডিওটি দেখুন';
    $goldBadgeTop = !empty($mcSettings['gold_badge_top']) ? $mcSettings['gold_badge_top'] : 'এখনই সিট বুক করুন';
    $scheduleBadge = !empty($mcSettings['schedule_badge']) ? $mcSettings['schedule_badge'] : 'LIVE ZOOM MASTERCLASS';
    $dualCtaLeft = !empty($mcSettings['dual_cta_left']) ? $mcSettings['dual_cta_left'] : 'রেজিস্ট্রেশন করুন এখনই';
    
    $totalCapacity = $course->capacity > 0 ? $course->capacity : 500;
    $totalEnrolled = $course->total_enrolled > 0 ? $course->total_enrolled : 428;
    $remainingSeats = !empty($mcSettings['remaining_seats']) ? $mcSettings['remaining_seats'] : max(0, $totalCapacity - $totalEnrolled);
    $progressPercent = min(100, round(($totalEnrolled / max(1, $totalCapacity)) * 100, 1));
    $dualCtaSeats = !empty($mcSettings['dual_cta_seats']) ? $mcSettings['dual_cta_seats'] : 'আর মাত্র ' . $remainingSeats . ' সিট বাকি';

    $benefitsTitle = !empty($mcSettings['benefits_title']) ? $mcSettings['benefits_title'] : 'এই মাস্টারক্লাস কার জন্য?';
    $orderFormTitle = !empty($mcSettings['order_form_title']) ? $mcSettings['order_form_title'] : 'মাস্টারক্লাসে জয়েন করতে নিচের<br><span class="text-primary">ফর্মটি পূরণ করুন</span>';
    $orderFormSubtitle = !empty($mcSettings['order_form_subtitle']) ? $mcSettings['order_form_subtitle'] : 'Give valid information';
    $faqTitle = !empty($mcSettings['faq_title']) ? $mcSettings['faq_title'] : 'কিছু সাধারণ প্রশ্নের উত্তর';

    $zoomTitle = !empty($mcSettings['zoom_title']) ? $mcSettings['zoom_title'] : 'Zoom লাইভ 104';
    $zoomSubtitle = !empty($mcSettings['zoom_subtitle']) ? $mcSettings['zoom_subtitle'] : 'অনলাইন ইন্টারেক্টিভ সেশন';
    $goldOfferTitle = !empty($mcSettings['gold_offer_title']) ? $mcSettings['gold_offer_title'] : 'আজকের স্পেশাল অফার';
    $primaryCtaText = !empty($mcSettings['primary_cta_text']) ? $mcSettings['primary_cta_text'] : 'রেজিস্ট্রেশন করুন এখনই';
    $scheduleValue = !empty($mcSettings['schedule_value']) ? $mcSettings['schedule_value'] : (!empty($course->duration) ? $course->duration : '2h 40min');
    $levelLabel = !empty($mcSettings['level_label']) ? $mcSettings['level_label'] : __('level');
    $levelValue = !empty($mcSettings['level_value']) ? $mcSettings['level_value'] : ($level ? $level->lang_title : 'beginner');
    $goldCtaText = !empty($mcSettings['gold_cta_text']) ? $mcSettings['gold_cta_text'] : 'এখনই জয়েন করুন';
    $goldSeatsText = !empty($mcSettings['gold_seats_text']) ? $mcSettings['gold_seats_text'] : 'আর মাত্র ' . $remainingSeats . ' সিট বাকি';

    $hideSpecialGift = !empty($mcSettings['hide_special_gift']);
    $hideExplainer = !empty($mcSettings['hide_explainer']);
    $hideBreakdown = !empty($mcSettings['hide_breakdown']);
    $hideReviews = !empty($mcSettings['hide_reviews']);
    $hideRelated = !empty($mcSettings['hide_related_courses']);

    $giftBadge = !empty($mcSettings['gift_badge']) ? $mcSettings['gift_badge'] : '🎁 যারা join করবেন তাদের জন্য special gift';
    $giftTitle = !empty($mcSettings['gift_title']) ? $mcSettings['gift_title'] : '৳১০,০০০ টাকার Ecom Dropshipping Mastery Course — সম্পূর্ণ FREE করার সুযোগ';
    $giftValue = !empty($mcSettings['gift_value']) ? $mcSettings['gift_value'] : '৳১০,০০০';
    $giftDescription = !empty($mcSettings['gift_description']) ? $mcSettings['gift_description'] : 'এই master class-এ যারা join করবেন, তারা আমার ৳১০,০০০ টাকার Ecom Dropshipping Mastery Course টা free তে করার সুযোগ পাবেন। মাস্টারক্লাসে এই বিষয়ে বিস্তারিত আলোচনা।';
    $giftQuote = !empty($mcSettings['gift_quote']) ? $mcSettings['gift_quote'] : '"এই কোর্সে আমি ই-কমার্স বিজনেস, ডিজিটাল মার্কেটিং এর বিভিন্ন বিষয় যেমন Facebook Ads, Google Ads নিয়ে বিস্তারিত শিখিয়েছি। এছাড়াও কিভাবে একটা বিজনেসকে Scale করতে তা নিয়ে ক্লাস আছে।"';
    $giftFooterNote = !empty($mcSettings['gift_footer_note']) ? $mcSettings['gift_footer_note'] : 'যারা একদম নতুন আছেন তারাও এই কোর্স থেকে বেনিফিটেড হতে পারবে।';
    $giftCtaText = !empty($mcSettings['gift_cta_text']) ? $mcSettings['gift_cta_text'] : 'সিট কনফার্ম করুন →';
    $giftSeatsText = !empty($mcSettings['gift_seats_text']) ? $mcSettings['gift_seats_text'] : 'বাকি আছে মাত্র ' . $remainingSeats . ' টা seat';

    $explainerTitle = !empty($mcSettings['explainer_title']) ? $mcSettings['explainer_title'] : 'একটা প্রশ্ন আপনার মাথায় আসতে পারে — এত কিছু, মাত্র ৯৯ টাকায় কেন??';
    $explainerText = !empty($mcSettings['explainer_text']) ? $mcSettings['explainer_text'] : null;
    $breakdownSubheading = !empty($mcSettings['breakdown_subheading']) ? $mcSettings['breakdown_subheading'] : null;
    $breakdownItemsRaw = !empty($mcSettings['breakdown_items']) ? $mcSettings['breakdown_items'] : null;
    $breakdownTodayTitle = !empty($mcSettings['breakdown_today_title']) ? $mcSettings['breakdown_today_title'] : 'আজকের মূল্য (token)';
    $originalPriceLabel = !empty($mcSettings['original_price_label']) ? $mcSettings['original_price_label'] : 'মূল প্রাইস';
    $scheduleLabel = !empty($mcSettings['schedule_label']) ? $mcSettings['schedule_label'] : 'সময় / সময়সূচী';

    $nameLabel = !empty($mcSettings['name_label']) ? $mcSettings['name_label'] : 'Your Full Name';
    $namePlaceholder = !empty($mcSettings['name_placeholder']) ? $mcSettings['name_placeholder'] : 'আপনার সম্পূর্ণ নাম';
    $phoneLabel = !empty($mcSettings['phone_label']) ? $mcSettings['phone_label'] : 'Mobile Number';
    $phonePlaceholder = !empty($mcSettings['phone_placeholder']) ? $mcSettings['phone_placeholder'] : '01XXXXXXXXX';
    $emailLabel = !empty($mcSettings['email_label']) ? $mcSettings['email_label'] : 'Email address';
    $emailPlaceholder = !empty($mcSettings['email_placeholder']) ? $mcSettings['email_placeholder'] : 'আপনার ইমেইল এড্রেস';
    $orderSummaryTitle = !empty($mcSettings['order_summary_title']) ? $mcSettings['order_summary_title'] : 'Your order';
    $privacyNotice = !empty($mcSettings['privacy_notice']) ? $mcSettings['privacy_notice'] : 'Your personal data will be used to process your order, support your experience throughout this website, and for other purposes described in our privacy policy.';
    $payNowBtnText = !empty($mcSettings['pay_now_btn_text']) ? $mcSettings['pay_now_btn_text'] : 'PAY NOW';

    $breakdownRows = [];
    if (!empty($breakdownItemsRaw)) {
        $lines = array_filter(array_map('trim', explode("\n", $breakdownItemsRaw)));
        foreach ($lines as $line) {
            $parts = explode('|', $line);
            $breakdownRows[] = [
                'title' => trim($parts[0] ?? ''),
                'val' => trim($parts[1] ?? '')
            ];
        }
    }
    if (empty($breakdownRows)) {
        $breakdownRows = [
            ['title' => '🎓 ২ দিনের live masterclass — সম্পূর্ণ roadmap সহ', 'val' => '৳৩,০০০'],
            ['title' => '🎁 Ecom Dropshipping Mastery Course free পাওয়ার সুযোগ', 'val' => '৳১০,০০০']
        ];
    }
@endphp

<div class="masterclass-page-wrapper">

    {{-- =========================================================
         1. HERO HEADER SECTION (100% Admin Panel Sync)
         Fields from Admin: $course->title, $course->short_description, $course->category
    ========================================================== --}}
    <section class="mc-hero-header">
        <div class="mc-container">
            <span class="mc-eyebrow-badge">{{ $eyebrowTitle }}</span>

            {{-- Main Title --}}
            <h1 class="mc-main-title">{{ $course->title }}</h1>

            {{-- Short Description --}}
            <p class="mc-sub-title">{{ !empty($course->short_description) ? $course->short_description : 'E-commerce বিজনেস সফলভাবে পরিচালনা করার জন্য ২ দিনব্যাপী জুম লাইভ মাস্টারক্লাস। সকল গাইডলাইন ও প্র্যাকটিক্যাল গাইড পাওয়ার জন্য আজই জয়েন করুন।' }}</p>

            {{-- 2. CENTERED INTRO VIDEO / MEDIA (From Admin Video Tab) --}}
            <div class="mc-video-box">
                @include('frontend.components.video', [
                    'source' => $course->video_source, 
                    'video'  => $course->video, 
                    'class'  => 'course-intro-video', 
                    'image'  => $course->image, 
                    'size'   => '780x440'
                ])
            </div>

            <p class="small text-muted mb-4">
                <i class="fas fa-arrow-up me-1"></i> {{ $videoCaption }} <i class="fas fa-arrow-up ms-1"></i>
            </p>

            {{-- 3. PRIMARY ENROLL / CTA BUTTON --}}
            @if(!auth()->check() || auth()->user()->user_type == 'student')
                <div class="cart_area text-center mb-3">
                    @if($is_enrolled)
                        <a href="{{ route('my-course', $course->slug) }}" class="template-btn">
                            {{ __('go_to_course') }} <i class="fal fa-long-arrow-right ms-2"></i>
                        </a>
                    @else
                        <a href="javascript:void(0)" class="template-btn added_to_cart {{ $is_added_to_cart ? '' : 'd-none' }}">
                            {{ __('added_to_cart') }} <i class="fas fa-check-circle ms-1"></i>
                        </a>
                        <a href="javascript:void(0)" 
                           class="template-btn add_to_cart {{ $is_added_to_cart ? 'd-none' : '' }}" 
                           data-id="{{ $course->id }}" 
                           data-type="course" 
                           data-quantity="1" 
                           data-route="{{ route('add.cart') }}">
                            {{ $primaryCtaText }} <i class="fas fa-bolt ms-1"></i>
                        </a>
                    @endif
                </div>
                
                @include('components.frontend_loading_btn', ['class' => 'template-btn d-none'])

                <div class="mc-seats-counter">
                    <span class="mc-pulse-dot"><span class="ping"></span><span class="dot"></span></span>
                    <span>আর মাত্র <strong class="text-danger fw-bold">{{ $remainingSeats }} সিট বাকি</strong></span>
                </div>
            @endif
        </div>
    </section>

    {{-- =========================================================
         MAIN STACKED BODY
    ========================================================== --}}
    <section class="py-4">
        <div class="mc-container">

            {{-- =========================================================
                 4. GOLD BORDER MASTERCLASS INFO CARD (100% Admin Sync)
                 Fields: $course->duration, $level->lang_title, $language->name, $course->price, $course->discount_amount
            ========================================================== --}}
            <span class="mc-gold-badge-top">
                {{ $goldBadgeTop }}
            </span>
            <div class="mc-gold-info-card">
                <div class="mc-gold-item-row">
                    <div class="mc-gold-icon-circle"><i class="fas fa-video"></i></div>
                    <div>
                        <p class="m-0 fw-bold fs-5 text-dark">{{ $zoomTitle }}</p>
                        <small class="text-muted">{{ $zoomSubtitle }}</small>
                    </div>
                </div>

                <div class="mc-gold-item-row">
                    <div class="mc-gold-icon-circle"><i class="fas fa-clock"></i></div>
                    <div>
                        <p class="m-0 text-muted small">{{ $scheduleLabel }}</p>
                        <p class="m-0 fw-bold fs-5 text-dark">{{ $scheduleValue }}</p>
                    </div>
                </div>

                <div class="mc-gold-item-row">
                    <div class="mc-gold-icon-circle"><i class="fas fa-layer-group"></i></div>
                    <div>
                        <p class="m-0 text-muted small">{{ $levelLabel }}</p>
                        <p class="m-0 fw-bold fs-6 text-dark">{{ $levelValue }}</p>
                    </div>
                </div>

                {{-- Price Display --}}
                <div class="mc-gold-price-highlight">
                    <span class="fw-bold fs-5 text-dark d-flex align-items-center gap-2">
                        <span style="width: 12px; height: 12px; border-radius: 50%; background: #fdcc0d; display: inline-block;"></span>
                        {{ $goldOfferTitle }}
                    </span>
                    <span class="fw-bold fs-4 text-success">
                        @if($course->is_free == 1 || $course->price == 0)
                            {{ __('free') }}
                        @elseif($course->is_discountable == 1)
                            {{ get_price($course->discount_amount, userCurrency()) }}
                        @else
                            {{ get_price($course->price, userCurrency()) }}
                        @endif
                    </span>
                </div>

                @if($course->is_discountable == 1 && $course->price > 0)
                    <div class="mc-gold-price-old">
                        <span class="d-flex align-items-center gap-2">
                            <span style="width: 10px; height: 10px; border-radius: 50%; border: 2px solid #cbd5e0; display: inline-block;"></span>
                            {{ $originalPriceLabel }}
                        </span>
                        <span class="fw-bold text-decoration-line-through">
                            {{ get_price($course->price, userCurrency()) }}
                        </span>
                    </div>
                @endif

                {{-- Dual CTA Button --}}
                @if(!auth()->check() || auth()->user()->user_type == 'student')
                    @if(!$is_enrolled)
                        <div class="text-center mt-4">
                            <a href="#register" class="template-btn">
                                {{ $goldCtaText }} - 
                                @if($course->is_discountable == 1)
                                    {{ get_price($course->discount_amount, userCurrency()) }}
                                @else
                                    {{ get_price($course->price, userCurrency()) }}
                                @endif
                                <i class="fas fa-arrow-right ms-2"></i>
                            </a>
                            <div class="mc-seats-counter mt-3">
                                <span class="mc-pulse-dot"><span class="ping"></span><span class="dot"></span></span>
                                <span>{{ $goldSeatsText }}</span>
                            </div>
                        </div>
                    @endif
                @endif
            </div>

            {{-- =========================================================
                 5. BENEFITS GRID ("এই মাস্টারক্লাস কার জন্য?")
                 Field: $course->what_will_learn (From Admin Course Edit)
            ========================================================== --}}
            <div class="mc-benefits-card-wrapper">
                <h2 class="fw-bold fs-3 text-dark mb-2">{{ $benefitsTitle }}</h2>
                <span class="d-block mx-auto mb-4" style="width: 70px; height: 3px; background: #fdcc0d; border-radius: 10px;"></span>

                <div class="row g-3 justify-content-center">
                    @php
                        $benefits = [];
                        if(!empty($mcSettings['benefits_list']) && is_array($mcSettings['benefits_list'])) {
                            $benefits = array_values(array_filter(array_map('trim', $mcSettings['benefits_list'])));
                        }
                        if(empty($benefits) && !empty($mcSettings['benefits_items'])) {
                            $lines = array_filter(array_map('trim', explode("\n", $mcSettings['benefits_items'])));
                            $benefits = array_values($lines);
                        }
                        if(empty($benefits) && !empty($course->what_will_learn)) {
                            $lines = array_filter(array_map('trim', explode("\n", strip_tags($course->what_will_learn))));
                            $benefits = array_values($lines);
                        }
                        if(count($benefits) < 1) {
                            $benefits = [
                                'অনলাইন বিজনেস করতে চান কিন্তু কনফিউজড',
                                'পুঁজি কম নিয়ে বিজনেস শুরু করতে চাচ্ছেন',
                                'ই-কমার্স বিজনেস শুরু করার ভয় আছে',
                                'লস না করে সঠিকভাবে শুরু করতে চান',
                            ];
                        }
                    @endphp

                    @foreach($benefits as $benefit)
                        <div class="col-6 col-md-3">
                            <div class="mc-benefit-single-card">
                                <div class="check-circle"><i class="fas fa-check"></i></div>
                                <p>{{ $benefit }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            {{-- =========================================================
                 6. SPECIAL GIFT BANNER CARD
            ========================================================== --}}
            @if(!$hideSpecialGift)
                <div class="mc-special-gift-card">
                    <span class="mc-gift-pill">
                        {{ $giftBadge }}
                    </span>

                    <h2 class="fw-bold fs-3 text-dark mb-3">
                        {{ $giftTitle }}
                    </h2>

                    <div class="d-flex align-items-center gap-3 mb-3">
                        <span class="fs-5 text-muted text-decoration-line-through">{{ $giftValue }}</span>
                        <span class="badge bg-danger fs-6 px-3 py-2 rounded-pill">FREE</span>
                    </div>

                    <p class="text-secondary leading-relaxed fs-6">
                        {{ $giftDescription }}
                    </p>

                    <div class="mc-callout-quote">
                        {{ $giftQuote }}
                    </div>

                    <p class="small text-muted mb-4">
                        {{ $giftFooterNote }}
                    </p>

                    <div class="text-center">
                        <a href="#register" class="template-btn">
                            {{ $giftCtaText }}
                        </a>
                        <div class="mc-seats-counter mt-3">
                            <span class="mc-pulse-dot"><span class="ping"></span><span class="dot"></span></span>
                            <span>বাকি আছে মাত্র <strong class="text-warning fw-bold">{{ $remainingSeats }}</strong> টা seat</span>
                        </div>
                    </div>
                </div>
            @endif

            {{-- =========================================================
                 7. LIVE ZOOM EXPLAINER & SEATS PROGRESS
            ========================================================== --}}
            <div class="text-center mb-4">
                <span class="badge bg-primary px-3 py-2 rounded-pill fs-7 tracking-wider">LIVE ZOOM MASTERCLASS</span>
                <h2 class="fw-bold fs-3 text-dark mt-3">{{ $classScheduleTitle }}</h2>
                <p class="text-secondary">
                    {{ $classScheduleTime }}। Seat সীমিত — বাকি আছে মাত্র <strong class="text-warning fw-bold">{{ $remainingSeats }}</strong> টা।
                </p>
            </div>

            {{-- Progress Bar --}}
            <div class="mc-progress-box">
                <p class="fw-bold m-0 text-dark">
                    {{ $totalCapacity }} seat-এর মধ্যে <span class="text-primary">{{ $totalEnrolled }}</span>টা বুক হয়ে গেছে — বাকি মাত্র <strong class="text-danger">{{ $remainingSeats }}টা</strong>
                </p>
                <div class="mc-progress-bar-bg">
                    <div class="mc-progress-bar-fill" style="width: {{ $progressPercent }}%;"></div>
                </div>
                <div class="d-flex justify-content-between small text-muted">
                    <span>বুক হয়েছে {{ $totalEnrolled }}</span>
                    <span>মোট {{ $totalCapacity }} seat</span>
                </div>
            </div>

            {{-- Blue Explainer Box --}}
            @if(!$hideExplainer)
                <div class="mc-blue-explainer">
                    <h3 class="fw-bold fs-5 text-dark mb-3">{{ $explainerTitle }}</h3>
                    @if($explainerText)
                        {!! $explainerText !!}
                    @else
                        <p>টু বি অনেস্ট, আমি এই masterclass-টা সম্পূর্ণ free করাতে চেয়েছিলাম।</p>
                        <p>কিন্তু problem হচ্ছে — আমার free session-গুলোতে দেখা যায় কয়েক হাজার মানুষ register করে বা join করে। যেহেতু এই session-টা Zoom-এ live হবে, তাই আমি চাইলেও এখানে বেশি মানুষ নিতে পারব না। Seat limit থাকবে।</p>
                        <p>তাই আমি এখানে ছোট্ট একটা token amount রেখেছি — শুধু audience filter করার জন্য। যেন এই masterclass-এ তারাই join করে, যারা সত্যিই e-commerce business শুরু করার ব্যাপারে serious এবং step-by-step process-টা মনোযোগ দিয়ে শিখতে ready।</p>
                        <p>যদি এই masterclass-এর actual value অনুযায়ী charge করা হতো, তাহলে এর price কয়েক হাজার টাকা হওয়া উচিত ছিল। কিন্তু আমার goal এখানে টাকা নেওয়া না।</p>
                        <p class="fw-bold text-primary m-0">goal হচ্ছে serious মানুষগুলোকে একটা clear guideline দেওয়া।।</p>
                    @endif
                </div>
            @endif

            {{-- Breakdown Table --}}
            @if(!$hideBreakdown)
                <div class="mc-breakdown-card">
                    <h4 class="fw-bold fs-5 text-dark mb-4">এই 
                        @if($course->is_discountable == 1)
                            {{ get_price($course->discount_amount, userCurrency()) }}
                        @else
                            {{ get_price($course->price, userCurrency()) }}
                        @endif
                        টাকায় আপনি পাচ্ছেন:
                    </h4>
                    <div class="table-responsive">
                        <table class="table align-middle">
                            <tbody>
                                @foreach($breakdownRows as $row)
                                    <tr>
                                        <td>{{ $row['title'] }}</td>
                                        <td class="text-end fw-bold">{{ $row['val'] }}</td>
                                    </tr>
                                @endforeach
                                <tr class="table-success border-top border-2">
                                    <td class="fw-bold text-success">{{ $breakdownTodayTitle }}</td>
                                    <td class="text-end fw-black fs-4 text-success">
                                        @if($course->is_discountable == 1)
                                            {{ get_price($course->discount_amount, userCurrency()) }}
                                        @else
                                            {{ get_price($course->price, userCurrency()) }}
                                        @endif
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            @endif

            {{-- =========================================================
                 8. COURSE FULL DESCRIPTION (100% Admin WYSIWYG Editor Sync)
                 Field: $course->description (Admin Edit Rich Text Editor)
            ========================================================== --}}
            <div class="mc-content-card">
                <h4 class="fw-bold fs-4 text-dark mb-3 pb-2 border-bottom">{{ __('about_this_course') }}</h4>
                <div class="description-body text-secondary leading-relaxed fs-6">
                    @if(!empty($course->description))
                        {!! $course->description !!}
                    @else
                        <p>এই লাইভ মাস্টারক্লাসে আমরা ই-কমার্স বিজনেস শুরু থেকে স্কেল আপ করার সব দরকারি ট্রিকস ও স্ট্র্যাটেজি নিয়ে বিস্তারিত আলোচনা করবো। ক্লাসে সরাসরি প্রশ্নোত্তর পর্ব থাকবে।</p>
                    @endif
                </div>
            </div>

            {{-- =========================================================
                 9. COURSE SYLLABUS / CURRICULUM ACCORDION (100% Admin Sync)
                 Fields: $sections, $lessons (Admin Curriculum Builder)
            ========================================================== --}}
            @if(setting('hide_curriculum_from_course_details') != '1' && count($sections) > 0)
                <div class="mc-content-card">
                    <h4 class="fw-bold fs-4 text-dark mb-4 pb-2 border-bottom">{{ __('course_syllabus') }}</h4>
                    
                    @if($hasEnrolled)
                        <div class="bg-light p-3 rounded-3 mb-4 border">
                            <div class="d-flex justify-content-between align-items-center mb-1">
                                <span class="fw-bold small text-dark">{{ __('your_progress') }}</span>
                                <span class="fw-bold small text-success">{{ $hasEnrolled->complete_count }}% {{ __('done') }}</span>
                            </div>
                            <div class="progress" style="height: 8px;">
                                <div class="progress-bar bg-success" role="progressbar" style="width: {{ $hasEnrolled->complete_count }}%;"></div>
                            </div>
                        </div>
                    @endif

                    <div class="accordion mc-faq-accordion accordion-flush" id="curriculumAccordion">
                        @foreach($sections as $key => $section)
                            <div class="accordion-item">
                                <div class="accordion-header" id="course-curriculum-heading{{ $key }}">
                                    <div class="accordion-button {{ $key == 0 && (count($lessons->where('section_id', $section->id)) > 0 || count($section->quizzes) > 0) ? '' : 'collapsed' }}"
                                         role="button" 
                                         data-bs-toggle="collapse" 
                                         data-bs-target="#course-curriculum-collapse{{ $key }}"
                                         {{ $key == 0 && (count($lessons->where('section_id', $section->id)) > 0 || count($section->quizzes) > 0) ? 'aria-expanded="true"' : 'aria-expanded="false"' }}
                                         aria-controls="course-curriculum-collapse{{ $key }}">
                                        <i class="fal fa-book-open me-2 text-warning"></i> {{ $section->title }}
                                    </div>
                                </div>
                                <div id="course-curriculum-collapse{{ $key }}"
                                     class="accordion-collapse collapse {{ $key == 0 && (count($lessons->where('section_id', $section->id)) > 0 || count($section->quizzes) > 0) ? 'show' : '' }}"
                                     aria-labelledby="course-curriculum-heading{{ $key }}" 
                                     data-bs-parent="#curriculumAccordion">
                                    <div class="accordion-body">
                                        @if(count($lessons) > 0)
                                            <div class="course-playlist">
                                                <ul class="list-unstyled mb-0">
                                                    @foreach($lessons->where('section_id', $section->id) as $k => $lesson)
                                                        <li class="py-2 border-bottom">
                                                            <a href="#" 
                                                               class="d-flex align-items-center justify-content-between text-dark text-decoration-none {{ $lesson->is_free == 1 ? 'player-src' : '' }}"
                                                               @if($lesson->is_free == 1)
                                                                   data-poster="{{ $lesson->image ? getFileLink('402x238', $lesson->image) : ($course->image ? getFileLink('402x248', $course->image) : '') }}"
                                                                   data-type="{{ $lesson->lesson_type }}" 
                                                                   data-source="{{ $lesson->source }}"
                                                                   data-video="{{ getVideoId($lesson->source, $lesson->source_data) }}"
                                                               @endif>
                                                                <div class="d-flex align-items-center gap-2">
                                                                    @if($lesson->lesson_type == 'video')
                                                                        <i class="fal fa-play-circle text-primary"></i>
                                                                    @elseif($lesson->lesson_type == 'audio')
                                                                        <i class="fal fa-microphone text-primary"></i>
                                                                    @else
                                                                        <i class="fal fa-file-alt text-primary"></i>
                                                                    @endif
                                                                    
                                                                    <span class="fw-medium text-dark">{{ $lesson->title }}</span>
                                                                    
                                                                    @if($lesson->is_free == 1)
                                                                        <span class="badge bg-success ms-2">{{ __('free') }}</span>
                                                                    @endif
                                                                </div>
                                                                <span class="small text-muted">{{ $lesson->duration }}</span>
                                                            </a>
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif

            {{-- =========================================================
                 10. REGISTRATION ORDER FORM SECTION (`#register`)
            ========================================================== --}}
            @if(!auth()->check() || auth()->user()->user_type == 'student')
                @if(!$is_enrolled)
                    <div id="register" class="mc-form-wrapper user-form">
                        <h2 class="text-center fw-bold fs-3 text-dark mb-2">
                            {!! $orderFormTitle !!}
                        </h2>
                        
                        <p class="text-center text-muted small mb-4">{{ $orderFormSubtitle }}</p>

                        <form action="{{ route('add.cart') }}" method="post">
                            @csrf
                            <input type="hidden" name="id" value="{{ $course->id }}">
                            <input type="hidden" name="type" value="course">
                            <input type="hidden" name="quantity" value="1">

                            <div class="mb-3">
                                <label class="form-label fw-semibold text-dark mb-1">{{ $nameLabel }} <span class="text-danger">*</span></label>
                                <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" placeholder="{{ $namePlaceholder }}" required>
                                @error('name')
                                    <span class="invalid-feedback d-block text-danger small mt-1" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-semibold text-dark mb-1">{{ $phoneLabel }} <span class="text-danger">*</span></label>
                                <input type="tel" name="phone" class="form-control @error('phone') is-invalid @enderror" value="{{ old('phone') }}" placeholder="{{ $phonePlaceholder }}" required>
                                @error('phone')
                                    <span class="invalid-feedback d-block text-danger small mt-1" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-semibold text-dark mb-1">{{ $emailLabel }} <span class="text-danger">*</span></label>
                                <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" placeholder="{{ $emailPlaceholder }}" required>
                                @error('email')
                                    <span class="invalid-feedback d-block text-danger small mt-1" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="mc-breakdown-card border-0 bg-white p-3 mb-4">
                                <p class="fw-bold text-dark mb-2">{{ $orderSummaryTitle }}</p>
                                <div class="d-flex justify-content-between align-items-center p-3 bg-light rounded-3">
                                    <span class="fw-bold text-dark">{{ $course->title }}</span>
                                    <span class="fw-bold text-success fs-5">
                                        @if($course->is_discountable == 1)
                                            {{ get_price($course->discount_amount, userCurrency()) }}
                                        @else
                                            {{ get_price($course->price, userCurrency()) }}
                                        @endif
                                    </span>
                                </div>
                            </div>

                            <p class="small text-muted mb-4">
                                {{ $privacyNotice }}
                            </p>

                            <button type="submit" class="template-btn w-100">
                                {{ $payNowBtnText }} <i class="fas fa-lock ms-2"></i>
                            </button>
                        </form>
                    </div>
                @endif
            @endif

            {{-- =========================================================
                 11. FAQ ACCORDION SECTION (100% Admin Sync)
                 Field: $faqs (From Admin Course Edit -> FAQ tab)
            ========================================================== --}}
            @php
                $displayFaqs = [];

                // 1. Primary: Official Course FAQs ($faqs table)
                if (!empty($faqs) && count($faqs) > 0) {
                    foreach ($faqs as $f) {
                        $displayFaqs[] = (object)[
                            'question' => $f->question,
                            'answer'   => $f->answer
                        ];
                    }
                }

                // 2. Secondary: mcSettings custom faq_list array
                if (empty($displayFaqs) && !empty($mcSettings['faq_list']) && is_array($mcSettings['faq_list'])) {
                    foreach ($mcSettings['faq_list'] as $item) {
                        if (!empty($item['question']) || !empty($item['answer'])) {
                            $displayFaqs[] = (object)[
                                'question' => $item['question'] ?? '',
                                'answer'   => $item['answer'] ?? ''
                            ];
                        }
                    }
                }

                // 3. Tertiary: mcSettings faq_items pipe-separated text
                if (empty($displayFaqs) && !empty($mcSettings['faq_items'])) {
                    $lines = array_filter(array_map('trim', explode("\n", $mcSettings['faq_items'])));
                    foreach ($lines as $line) {
                        $parts = explode('|', $line);
                        if (isset($parts[0]) && isset($parts[1])) {
                            $displayFaqs[] = (object)[
                                'question' => trim($parts[0]),
                                'answer'   => trim($parts[1])
                            ];
                        }
                    }
                }
            @endphp

            @if(setting('hide_faq_from_course_details') != '1' && count($displayFaqs) > 0)
                <div class="mb-5">
                    <h2 class="text-center fw-bold fs-3 text-dark mb-2">{{ $faqTitle }}</h2>
                    <span class="d-block mx-auto mb-4" style="width: 70px; height: 3px; background: #fdcc0d; border-radius: 10px;"></span>

                    <div class="accordion mc-faq-accordion accordion-flush mt-4" id="faqAccordion">
                        @foreach($displayFaqs as $key => $faq)
                            <div class="accordion-item">
                                <div class="accordion-header" id="course-faq-heading{{ $key }}">
                                    <div class="accordion-button {{ $key == 0 ? '' : 'collapsed' }}" 
                                         role="button" 
                                         data-bs-toggle="collapse" 
                                         data-bs-target="#course-faq-collapse{{ $key }}"
                                         aria-expanded="{{ $key == 0 ? 'true' : 'false' }}" 
                                         aria-controls="course-faq-collapse{{ $key }}">
                                        {{ $faq->question }}
                                    </div>
                                </div>
                                <div id="course-faq-collapse{{ $key }}" 
                                     class="accordion-collapse collapse {{ $key == 0 ? 'show' : '' }}" 
                                     aria-labelledby="course-faq-heading{{ $key }}" 
                                     data-bs-parent="#faqAccordion">
                                    <div class="accordion-body">
                                        {!! $faq->answer !!}
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    {{-- Bottom Dual CTA --}}
                    @if(!auth()->check() || auth()->user()->user_type == 'student')
                        @if(!$is_enrolled)
                            <div class="text-center mt-5">
                                <a href="#register" class="template-btn">
                                    {{ $dualCtaLeft }} - 
                                    @if($course->is_discountable == 1)
                                        {{ get_price($course->discount_amount, userCurrency()) }}
                                    @else
                                        {{ get_price($course->price, userCurrency()) }}
                                    @endif
                                    <i class="fas fa-arrow-right ms-2"></i>
                                </a>
                                <div class="mc-seats-counter mt-3">
                                    <span class="mc-pulse-dot"><span class="ping"></span><span class="dot"></span></span>
                                    <span>{{ $dualCtaSeats }}</span>
                                </div>
                            </div>
                        @endif
                    @endif
                </div>
            @endif

            {{-- =========================================================
                 12. REVIEWS SECTION
            ========================================================== --}}
            @if(setting('hide_review_from_course_details') != '1' && !$hideReviews && $course->total_rating > 0)
                <div class="mc-content-card">
                    <h4 class="fw-bold fs-4 text-dark mb-4 pb-2 border-bottom">{{ __('reviews') }}</h4>
                    
                    <div class="mc-review-summary">
                        <div class="mc-rating-big text-center">
                            <div class="num fs-1 fw-bold text-dark">{{ round($course->total_rating, 1) }}</div>
                            <div class="mc-rating-stars fs-6 my-1 text-warning">
                                @for($i = 1; $i <= 5; $i++)
                                    <i class="{{ $i <= round($course->total_rating) ? 'fas' : 'fal' }} fa-star"></i>
                                @endfor
                            </div>
                            <small class="text-muted">{{ __('out_of_5') }}</small>
                        </div>
                        
                        <div class="mc-rating-bars flex-grow-1">
                            @foreach([5 => 'five_star', 4 => 'four_star', 3 => 'three_star', 2 => 'two_star', 1 => 'one_star'] as $starCount => $starKey)
                                <div class="d-flex align-items-center gap-2 mb-1 fs-7">
                                    <span class="stars text-warning me-1">
                                        @for($s = 1; $s <= 5; $s++)
                                            <i class="{{ $s <= $starCount ? 'fas' : 'fal' }} fa-star"></i>
                                        @endfor
                                    </span>
                                    <div class="progress flex-grow-1" style="height: 8px;">
                                        <div class="progress-bar bg-warning" style="width: {{ $ratings[$starKey] }}%;"></div>
                                    </div>
                                    <span class="pct text-muted ms-1">{{ $ratings[$starKey] }}%</span>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    @if(setting('disable_write_review') != '1' && $can_review)
                        <div class="mc-review-form pt-4 border-top" id="comment-respond">
                            <h5 class="fw-bold mb-3 text-dark">{{ __('Write_a_review') }}</h5>
                            <div class="rating-review rating_comment mb-3 all-rating"></div>
                            <span class="live-rating"></span>
                            
                            <form action="{{ route('store.comment') }}" method="post">
                                @csrf
                                <div class="mb-3">
                                    <textarea name="comment" class="form-control rounded-3" rows="4" placeholder="{{ __('write_your_review') ?? 'Write your review...' }}"></textarea>
                                    <input type="hidden" name="id" value="{{ $course->id }}">
                                    <input type="hidden" name="slug" value="{{ $course->slug }}">
                                    <input type="hidden" name="type" value="course">
                                    <input type="hidden" name="rating" class="give_rating">
                                </div>
                                <button type="submit" class="template-btn">
                                    {{ __('post_review') }}
                                </button>
                            </form>
                        </div>
                    @endif

                    @if(count($reviews) > 0)
                        <ul class="comments-list mt-4 list-unstyled">
                            @foreach($reviews as $review)
                                @include('frontend.review_component')
                            @endforeach
                        </ul>
                        
                        @if($reviews->nextPageUrl())
                            <div class="less-more mt-4 text-center">
                                <button class="template-btn bordered-btn less-more-btn" 
                                        data-page="{{ $reviews->currentPage() }}" 
                                        data-url="{{ route('load.reviews') }}">
                                    {{ __('see_more') }}
                                </button>
                                @include('components.frontend_loading_btn', ['class' => 'template-btn'])
                            </div>
                        @endif
                    @endif
                </div>
            @endif

        </div>
    </section>

</div>

<input type="hidden" class="text_copied" value="{{ __('text_copied') }}">
<input type="hidden" class="text_copied_fail" value="{{ __('text_copied_fail') }}">

{{-- =========================================================
     13. RELATED COURSES SECTION
========================================================== --}}
@if(setting('disable_related_course_from_course_details') != '1' && !$hideRelated && count($related_courses) > 0)
    <section class="bg-light py-5 border-top">
        <div class="container container-1278">
            <div class="row justify-content-center mb-4">
                <div class="col-lg-6 text-center">
                    <h3 class="fw-extrabold text-dark">{{ __('related_course') }}</h3>
                    <p class="text-muted">{{ __('Lorem Ipsum is not the simply random text') }}</p>
                </div>
            </div>
            
            <div class="course-items-wrap">
                <div class="row course-items-v3 course-slider" dir="{{ systemLanguage() ? systemLanguage()->text_direction : 'ltr' }}">
                    @foreach($related_courses as $key => $course)
                        @include('frontend.course.component', ['col' => 'col-lg-4'])
                    @endforeach
                </div>
                
                @if(!$related_courses->nextPageUrl())
                    <div class="text-center mt-4">
                        <a class="template-btn bordered-btn" href="{{ route('courses', ['category_ids' => $course->category_id]) }}">
                            {{ __('see_more') }}
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </section>
@endif

@endsection

@push('css')
    <link rel="stylesheet" href="{{ static_asset('frontend/css/star-rating-svg.css') }}">
@endpush

@push('js')
    <script src="{{ static_asset('frontend/js/jquery.star-rating-svg.js') }}"></script>
    <script>
        $(document).ready(function () {
            initiateRating();
            let player = new Plyr('.yt_player');
            
            $(".rating_comment").starRating({
                totalStars: 5,
                starShape: 'rounded',
                activeColor: 'salmon',
                starSize: 20,
                emptyColor: 'lightgray',
                hoverColor: '#fdcc0d',
                initialRating: 1,
                strokeWidth: 0,
                useGradient: false,
                disableAfterRate: false,
                minRating: 1,
                useFullStars: true,
                onHover: function (currentIndex, currentRating, $el) {
                    $('.live-rating').text(currentIndex);
                },
                onLeave: function (currentIndex, currentRating, $el) {
                    $('.live-rating').text(currentRating);
                },
                callback: function (currentRating, $el) {
                    $('.give_rating').val(currentRating);
                }
            });

            $(document).on('click', '.less-more-btn', function () {
                let that = this;
                let page = parseInt($(this).data('page')) + 1;
                let url = $(this).data('url');
                let selector = $(this).closest('.less-more');
                $(that).addClass('d-none');
                $(selector).find('.loading_button').removeClass('d-none');
                $.ajax({
                    url: url,
                    type: "GET",
                    data: {
                        page: page,
                        id: '{{ $id }}',
                        type: 'course'
                    },
                    success: function (data) {
                        if (data.success) {
                            $('.comments-list').append(data.html);
                        } else {
                            toastr.error(data.error);
                        }
                        $(that).data('page', page);
                        initiateRating();
                        if (data.next_page_url) {
                            selector.find('.loading_button').addClass('d-none');
                            $(that).removeClass('d-none');
                        } else {
                            selector.find('.loading_button').addClass('d-none');
                            $(that).addClass('d-none');
                        }
                    }
                });
            });

            $(document).on("click", ".copy_text", function () {
                let text = $(this).data("text");
                let success_txt = $(".text_copied").val();
                let error_txt = $(".text_copied_fail").val();
                navigator.clipboard
                    .writeText(text)
                    .then(() => {
                        toastr["success"](success_txt);
                    })
                    .catch((err) => {
                        toastr["error"](error_txt + ": ", err);
                    });
            });

            $(document).on('click', '.player-src', function () {
                let provider = $(this).data("source");
                let video = $(this).data("video");
                let type = $(this).data("type");
                let poster = $(this).data("poster");

                if (provider == 'upload' || provider == 'mp4') {
                    player.source = {
                        type: type,
                        title: 'Example title',
                        sources: [
                            {
                                src: video,
                                type: 'video/mp4',
                                size: 720,
                            }
                        ],
                        poster: poster,
                    };
                } else {
                    player.source = {
                        type: type,
                        poster: poster,
                        sources: [
                            {
                                src: video,
                                provider: provider,
                            },
                        ],
                    };
                }
                player.on('ready', (event) => {
                    player.play();
                });
            });
        });

        function initiateRating() {
            $(".review_list").starRating({
                starShape: 'rounded',
                starSize: 20,
                readOnly: true,
                activeColor: '#fdcc0d',
                useGradient: false
            });
        }
    </script>
@endpush
