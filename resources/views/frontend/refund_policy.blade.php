@extends('frontend.layouts.master')
@section('title', __('Refund & Cancellation Policy'))

@section('content')
    <!--====== Page Header ======-->
    <section class="page-header-area p-t-80 p-b-80" style="background-color: #110B3A;">
        <div class="container container-1278">
            <div class="row align-items-center text-center">
                <div class="col-12">
                    <span class="sub-title text-uppercase fw-bold mb-2 d-inline-block" style="color: #10b981; letter-spacing: 1.5px; font-size: 14px;">
                        {{ __('CUSTOMER SATISFACTION GUARANTEE') }}
                    </span>
                    <h1 class="title fw-bold text-white mb-3" style="font-size: 2.5rem;">
                        {{ __('Refund & Cancellation Policy') }}
                    </h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb justify-content-center bg-transparent p-0 m-0">
                            <li class="breadcrumb-item"><a href="{{ url('/') }}" style="color: #94a3b8; text-decoration: none;">{{ __('Home') }}</a></li>
                            <li class="breadcrumb-item active text-white" aria-current="page">{{ __('Refund Policy') }}</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </section>

    <!--====== Main Content ======-->
    <section class="policy-content-area p-t-80 p-b-80 bg-light">
        <div class="container container-1278">
            <div class="row justify-content-center">
                <div class="col-lg-10">
                    <div class="card border-0 shadow-lg rounded-4 p-4 p-md-5 bg-white">
                        
                        <div class="policy-section mb-4">
                            <h3 class="fw-bold mb-3" style="color: #1a1b4b; font-size: 22px;">
                                <i class="fas fa-shield-alt me-2" style="color: #10b981;"></i> 1. 30-Day Money-Back Guarantee
                            </h3>
                            <p style="color: #475569; font-size: 15.5px; line-height: 1.8;">
                                At FacultyLMS, customer satisfaction is our highest priority. If you are not completely satisfied with your course purchase, you are eligible for a full refund within 30 calendar days from the date of purchase, provided the conditions below are met.
                            </p>
                        </div>

                        <hr class="my-4" style="border-color: #f1f5f9;">

                        <div class="policy-section mb-4">
                            <h3 class="fw-bold mb-3" style="color: #1a1b4b; font-size: 22px;">
                                <i class="fas fa-check-circle me-2" style="color: #10b981;"></i> 2. Refund Eligibility Criteria
                            </h3>
                            <p style="color: #475569; font-size: 15.5px; line-height: 1.8;">
                                To qualify for a full refund:
                            </p>
                            <ul class="list-unstyled ps-3" style="color: #475569; font-size: 15px; line-height: 2;">
                                <li><i class="fas fa-circle me-2" style="font-size: 7px; color: #10b981; vertical-align: middle;"></i> The refund request must be submitted within 30 days of purchasing the course.</li>
                                <li><i class="fas fa-circle me-2" style="font-size: 7px; color: #10b981; vertical-align: middle;"></i> You must not have watched/completed more than 30% of the total course video content.</li>
                                <li><i class="fas fa-circle me-2" style="font-size: 7px; color: #10b981; vertical-align: middle;"></i> You must not have downloaded major course resources, certificates, or proprietary source code files.</li>
                            </ul>
                        </div>

                        <hr class="my-4" style="border-color: #f1f5f9;">

                        <div class="policy-section mb-4">
                            <h3 class="fw-bold mb-3" style="color: #1a1b4b; font-size: 22px;">
                                <i class="fas fa-times-circle me-2" style="color: #ef4444;"></i> 3. Non-Refundable Scenarios
                            </h3>
                            <p style="color: #475569; font-size: 15.5px; line-height: 1.8;">
                                Refunds will not be granted under the following circumstances:
                            </p>
                            <ul class="list-unstyled ps-3" style="color: #475569; font-size: 15px; line-height: 2;">
                                <li><i class="fas fa-times me-2" style="font-size: 12px; color: #ef4444;"></i> Requests submitted after the 30-day guarantee period has expired.</li>
                                <li><i class="fas fa-times me-2" style="font-size: 12px; color: #ef4444;"></i> Course completed in full or course certificate already generated/downloaded.</li>
                                <li><i class="fas fa-times me-2" style="font-size: 12px; color: #ef4444;"></i> Multiple refund requests for the same course by the same account.</li>
                            </ul>
                        </div>

                        <hr class="my-4" style="border-color: #f1f5f9;">

                        <div class="policy-section mb-4">
                            <h3 class="fw-bold mb-3" style="color: #1a1b4b; font-size: 22px;">
                                <i class="fas fa-envelope-open-text me-2" style="color: #10b981;"></i> 4. How to Request a Refund
                            </h3>
                            <p style="color: #475569; font-size: 15.5px; line-height: 1.8;">
                                Requesting a refund is quick and simple:
                            </p>
                            <ol class="ps-3" style="color: #475569; font-size: 15px; line-height: 2;">
                                <li>Log in to your account and go to your **Purchase History** or **Support Ticket** section.</li>
                                <li>Select the course you wish to refund and click **Request Refund**.</li>
                                <li>Alternatively, send an email to <strong style="color: #10b981;">{{ setting('contact_email') ?: 'support@facultylms.com' }}</strong> with your order ID.</li>
                            </ol>
                        </div>

                        <hr class="my-4" style="border-color: #f1f5f9;">

                        <div class="policy-section">
                            <h3 class="fw-bold mb-3" style="color: #1a1b4b; font-size: 22px;">
                                <i class="fas fa-clock me-2" style="color: #10b981;"></i> 5. Refund Processing Time
                            </h3>
                            <p style="color: #475569; font-size: 15.5px; line-height: 1.8; margin-bottom: 0;">
                                Once approved, your refund will be processed back to your original payment method (Credit Card, Mobile Banking, bKash, SSLCommerz, Stripe, PayPal) within <strong>3 to 7 business days</strong>.
                            </p>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
