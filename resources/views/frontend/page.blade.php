@extends('frontend.layouts.master')
@section('title', __($page_info->title))
@section('content')
    <section class="course-details-area p-b-50">
        <!-- Full width theme color header -->
        <div class="course-details-header-wrapper p-t-60 p-b-95 p-t-md-40 p-b-md-50">
            <div class="container container-1278">
                <div class="row">
                    <div class="col-lg-12 text-center">
                        <div class="course-details-header color-white">
                            <h1 class="title fw-bold text-white mb-3" style="font-size: 2.2rem;">{{ __($page_info->title) }}</h1>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="course-details-overview-wrapper">
            <div class="container container-1278">
                <div class="row justify-content-center">
                    <div class="col-lg-10 p-b-md-40">
                        <div class="course-details-overview p-t-50 p-t-lg-5">
                            <div class="course-details-overview-content dynamic-page-content" style="background-color: #fff; padding: 40px; border-radius: 8px; box-shadow: 0 4px 15px rgba(0,0,0,0.05); margin-top: -60px; position: relative; z-index: 2;">
                                {!! __($page_info->content) !!}
                            </div>
                            
                            <style>
                                .dynamic-page-content h1, 
                                .dynamic-page-content h2, 
                                .dynamic-page-content h3, 
                                .dynamic-page-content h4, 
                                .dynamic-page-content h5, 
                                .dynamic-page-content h6 {
                                    color: #1a1b4b;
                                    font-weight: 700;
                                    margin-top: 1.5rem;
                                    margin-bottom: 1rem;
                                }
                                .dynamic-page-content h1 { font-size: 28px; }
                                .dynamic-page-content h2 { font-size: 24px; }
                                .dynamic-page-content h3 { font-size: 20px; }
                                .dynamic-page-content h4 { font-size: 18px; }
                                .dynamic-page-content p {
                                    color: #475569;
                                    font-size: 15.5px;
                                    line-height: 1.8;
                                    margin-bottom: 1rem;
                                }
                                .dynamic-page-content ul, .dynamic-page-content ol {
                                    color: #475569;
                                    font-size: 15px;
                                    line-height: 1.8;
                                    margin-bottom: 1rem;
                                    padding-left: 1.5rem;
                                }
                                .dynamic-page-content li {
                                    margin-bottom: 0.5rem;
                                }
                                .dynamic-page-content a {
                                    color: #10b981;
                                    text-decoration: none;
                                }
                                .dynamic-page-content a:hover {
                                    text-decoration: underline;
                                }
                            </style>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
