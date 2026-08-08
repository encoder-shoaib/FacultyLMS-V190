@extends('frontend.layouts.master')
@section('title', $story->title)
@section('content')
    <section class="course-details-area p-b-50">
        <!-- Full width theme color header -->
        <div class="course-details-header-wrapper p-t-60 p-b-95 p-t-md-40 p-b-md-50">
            <div class="container container-1278">
                <div class="row">
                    <div class="col-lg-8">
                        <div class="course-details-header color-white">
                            <h2 class="title">{{ $story->title }}</h2>
                            <ul class="course-details-info m-t-20">
                                <li>
                                    <i class="fal fa-briefcase"></i> 
                                    {{ $story->position ?? __('Student') }}
                                </li>
                                @if($story->rating)
                                    <li class="rating">
                                        <i class="fas fa-star"></i>
                                        <span>{{ number_format($story->rating, 1) }}</span>
                                    </li>
                                @endif
                                <li>
                                    <i class="fal fa-calendar-alt"></i> 
                                    {{ \Carbon\Carbon::parse($story->created_at)->format('M d, Y') }}
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="course-details-overview-wrapper">
            <div class="container container-1278">
                <div class="row">
                    <!-- Left side: Main Media & Story -->
                    <div class="col-lg-8 p-b-md-40 order-2 order-lg-1">
                        <div class="course-details-overview p-t-50 p-t-lg-5">
                            <div class="course-details-overview-content">
                                <div class="post-thumbnail m-b-30">
                                    @if($story->video)
                                        <video src="{{ asset($story->video) }}" controls style="width: 100%; border-radius: 6px;"></video>
                                    @else
                                        <img src="{{ getFileLink('original_image', $story->image) }}" alt="{{ $story->title }}" style="width: 100%; border-radius: 6px;">
                                    @endif
                                </div>
                                
                                <h4>{{__('Story Details')}}</h4>
                                <div class="border-soft-white px-4 py-4 rounded-3" style="white-space: pre-line; font-size: 15px; line-height: 1.8; color: var(--color-body);">
                                    {{ $story->description }}
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Right side: Sidebar (Floating over header) -->
                    <div class="col-lg-4 order-1 order-lg-2">
                        <div class="course-details-sidebar sidebar-offset m-t-md-30">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="course-details-info">
                                        <div class="course-video text-center p-t-30 p-b-20" style="background-color: #f8f9fa;">
                                            <img src="{{ getFileLink('40x40', $story->image) }}" alt="{{ $story->title }}" class="rounded-circle" style="width: 100px; height: 100px; object-fit: cover; border: 4px solid #fff; box-shadow: 0 4px 15px rgba(0,0,0,0.1);">
                                        </div>
                                        <div class="single-course-info text-center p-30">
                                            <h4 class="title m-b-5" style="font-size: 18px;">{{ $story->title }}</h4>
                                            <p class="color-gray m-b-20" style="font-size: 14px;">{{ $story->position ?? __('Student') }}</p>
                                            
                                            <ul class="course-sidebar-list text-start m-t-20">
                                                <li class="d-flex justify-content-between align-items-center m-b-15 pb-2" style="border-bottom: 1px solid #eee;">
                                                    <span style="font-size: 14px;"><i class="fal fa-star m-r-10" style="color: var(--theme-clr);"></i>{{__('Rating')}}</span>
                                                    <strong style="font-size: 14px;">{{ $story->rating ? number_format($story->rating, 1) : 'N/A' }}</strong>
                                                </li>
                                                <li class="d-flex justify-content-between align-items-center m-b-15 pb-2" style="border-bottom: 1px solid #eee;">
                                                    <span style="font-size: 14px;"><i class="fal fa-calendar-alt m-r-10" style="color: var(--theme-clr);"></i>{{__('Date')}}</span>
                                                    <strong style="font-size: 14px;">{{ \Carbon\Carbon::parse($story->created_at)->format('M d, Y') }}</strong>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
