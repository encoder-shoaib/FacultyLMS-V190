@extends('frontend.layouts.master')
@section('title', __('Privacy Policy'))

@section('content')
    <!--====== Page Header ======-->
    <section class="page-header-area p-t-80 p-b-80" style="background-color: #110B3A;">
        <div class="container container-1278">
            <div class="row align-items-center text-center">
                <div class="col-12">
                    <span class="sub-title text-uppercase fw-bold mb-2 d-inline-block" style="color: #10b981; letter-spacing: 1.5px; font-size: 14px;">
                        {{ __('DATA PROTECTION & PRIVACY') }}
                    </span>
                    <h1 class="title fw-bold text-white mb-3" style="font-size: 2.5rem;">
                        {{ __('Privacy Policy') }}
                    </h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb justify-content-center bg-transparent p-0 m-0">
                            <li class="breadcrumb-item"><a href="{{ url('/') }}" style="color: #94a3b8; text-decoration: none;">{{ __('Home') }}</a></li>
                            <li class="breadcrumb-item active text-white" aria-current="page">{{ __('Privacy Policy') }}</li>
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
                                <i class="fas fa-lock me-2" style="color: #10b981;"></i> 1. Information We Collect
                            </h3>
                            <p style="color: #475569; font-size: 15.5px; line-height: 1.8;">
                                We respect your personal privacy. When you register or purchase a course on FacultyLMS, we collect essential account details such as your name, email address, phone number, and transaction history.
                            </p>
                        </div>

                        <hr class="my-4" style="border-color: #f1f5f9;">

                        <div class="policy-section mb-4">
                            <h3 class="fw-bold mb-3" style="color: #1a1b4b; font-size: 22px;">
                                <i class="fas fa-user-shield me-2" style="color: #10b981;"></i> 2. How We Use Your Data
                            </h3>
                            <p style="color: #475569; font-size: 15.5px; line-height: 1.8;">
                                Your personal information is strictly used to process course enrollments, issue certificates, send course updates, and provide dedicated support. We never sell or share your data with unauthorized third parties.
                            </p>
                        </div>

                        <hr class="my-4" style="border-color: #f1f5f9;">

                        <div class="policy-section">
                            <h3 class="fw-bold mb-3" style="color: #1a1b4b; font-size: 22px;">
                                <i class="fas fa-cookie-bite me-2" style="color: #10b981;"></i> 3. Security & Cookies
                            </h3>
                            <p style="color: #475569; font-size: 15.5px; line-height: 1.8; margin-bottom: 0;">
                                We employ industry-standard SSL encryption and secure database servers to protect your user credentials. Cookies are used to remember your logged-in session and course progress.
                            </p>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
