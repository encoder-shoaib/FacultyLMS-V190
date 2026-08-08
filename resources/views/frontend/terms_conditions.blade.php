@extends('frontend.layouts.master')
@section('title', __('Terms & Conditions'))

@section('content')
    <!--====== Page Header ======-->
    <section class="page-header-area p-t-80 p-b-80" style="background-color: #110B3A;">
        <div class="container container-1278">
            <div class="row align-items-center text-center">
                <div class="col-12">
                    <span class="sub-title text-uppercase fw-bold mb-2 d-inline-block" style="color: #10b981; letter-spacing: 1.5px; font-size: 14px;">
                        {{ __('TERMS OF SERVICE') }}
                    </span>
                    <h1 class="title fw-bold text-white mb-3" style="font-size: 2.5rem;">
                        {{ __('Terms & Conditions') }}
                    </h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb justify-content-center bg-transparent p-0 m-0">
                            <li class="breadcrumb-item"><a href="{{ url('/') }}" style="color: #94a3b8; text-decoration: none;">{{ __('Home') }}</a></li>
                            <li class="breadcrumb-item active text-white" aria-current="page">{{ __('Terms & Conditions') }}</li>
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
                                <i class="fas fa-file-contract me-2" style="color: #10b981;"></i> 1. Acceptance of Terms
                            </h3>
                            <p style="color: #475569; font-size: 15.5px; line-height: 1.8;">
                                By accessing or purchasing courses on FacultyLMS, you agree to comply with and be bound by these Terms and Conditions.
                            </p>
                        </div>

                        <hr class="my-4" style="border-color: #f1f5f9;">

                        <div class="policy-section mb-4">
                            <h3 class="fw-bold mb-3" style="color: #1a1b4b; font-size: 22px;">
                                <i class="fas fa-graduation-cap me-2" style="color: #10b981;"></i> 2. Course Access & Intellectual Property
                            </h3>
                            <p style="color: #475569; font-size: 15.5px; line-height: 1.8;">
                                Purchased courses provide personal, non-transferable access. Sharing account access, re-uploading course materials, or reselling content is strictly prohibited.
                            </p>
                        </div>

                        <hr class="my-4" style="border-color: #f1f5f9;">

                        <div class="policy-section">
                            <h3 class="fw-bold mb-3" style="color: #1a1b4b; font-size: 22px;">
                                <i class="fas fa-user-clock me-2" style="color: #10b981;"></i> 3. Account Termination
                            </h3>
                            <p style="color: #475569; font-size: 15.5px; line-height: 1.8; margin-bottom: 0;">
                                We reserve the right to suspend or terminate accounts that engage in fraudulent activities, copyright infringement, or violation of community guidelines.
                            </p>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
