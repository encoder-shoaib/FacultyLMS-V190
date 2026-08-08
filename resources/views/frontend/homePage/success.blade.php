<!--====== Start Success Story Section ======-->
@php
    if(!isset($success_stories)) {
        $success_stories = \App\Models\SuccessStory::active()->get();
    }
@endphp
<style>
    .custom-testimonial-card {
        background: #ffffff;
        border-radius: 18px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.04);
        height: 100%;
        display: flex;
        flex-direction: column;
        overflow: hidden;
        border: 1px solid #F1F5F9;
        transition: all 0.3s ease;
    }
    .custom-testimonial-card:hover {
        border-color: #10b981;
        box-shadow: 0 15px 35px rgba(16, 185, 129, 0.1);
        transform: translateY(-5px);
    }
    .custom-testimonial-card .card-top-image {
        width: 100%;
        height: 220px;
        object-fit: cover;
    }
    .custom-testimonial-card .card-body {
        padding: 26px;
        display: flex;
        flex-direction: column;
        flex-grow: 1;
    }
    .custom-testimonial-card p {
        color: #64748b;
        font-size: 15px;
        line-height: 1.7;
        margin-bottom: 22px;
        display: -webkit-box;
        -webkit-line-clamp: 3;
        -webkit-box-orient: vertical;
        overflow: hidden;
        text-overflow: ellipsis;
    }
    .custom-testimonial-author {
        display: flex;
        align-items: center;
        margin-top: auto;
    }
    .custom-testimonial-author > img {
        width: 54px;
        height: 54px;
        border-radius: 50%;
        margin-right: 14px;
        object-fit: cover;
        border: 2px solid #10b981;
        padding: 2px;
    }
    .author-details {
        display: flex;
        flex-direction: column;
    }
    .author-details h6 {
        margin: 0 0 2px 0;
        font-size: 16px;
        font-weight: 700;
        color: #1a1b4b; 
    }
    .author-details span {
        font-size: 13px;
        color: #64748b;
        margin-bottom: 4px;
        font-weight: 500;
    }
    .author-details .stars {
        color: #f59e0b;
        font-size: 13px;
    }
</style>

<section class="success-story-section p-t-80 p-b-80 position-relative" style="background-color: #ffffff;">
    <div class="container container-1278">
        <div class="row align-items-center g-5">
            
            <!-- Testimonial Cards Column -->
            <div class="col-lg-7 order-2 order-lg-1">
                @if(count($success_stories) > 0)
                <div class="row g-4" data-direction="{{ systemLanguage() ? systemLanguage()->text_direction : 'ltr' }}">
                    @foreach($success_stories as $success)
                    <div class="col-md-6">
                        <div class="custom-testimonial-card" data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
                            <img class="card-top-image" src="{{ getFileLink('473x337', $success->image) }}" alt="Success Story Preview">
                            <div class="card-body">
                                <p>"{{ $success->description }}"</p>
                                <div class="custom-testimonial-author">
                                    <img src="{{ getFileLink('40x40', $success->image) }}" alt="{{ $success->title }}">
                                    <div class="author-details">
                                        <h6>{{ $success->title }}</h6>
                                        <span>{{ $success->position ?? __('Student') }}</span>
                                        <div class="stars">
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                @else
                    @include('frontend.not_found', $data=['title'=> 'success stories'])
                @endif
            </div>

            <!-- Content & Heading Column -->
            <div class="col-lg-5 order-1 order-lg-2 ps-lg-4 mb-4 mb-lg-0">
                <div class="common-heading" data-aos="fade-left" dir="{{ systemLanguage() ? systemLanguage()->text_direction : 'ltr' }}">
                    <span class="sub-title text-uppercase fw-bold m-b-15 d-inline-block" style="color: #10b981; letter-spacing: 1.5px; font-size: 14px;">
                        {{ __('SUCCESS STORIES') }}
                    </span>
                    <h2 class="m-b-20" style="color: #1a1b4b; font-size: 38px; line-height: 1.25;">
                        {{ isset($section->contents['title']) && !empty($section->contents['title']) ? $section->contents['title'] : __('What Says My Students About The Platform') }}
                    </h2>
                    <p class="m-b-25" style="color: #64748b; font-size: 16px; line-height: 1.7;">
                        {{ isset($section->contents['sub_title']) && !empty($section->contents['sub_title']) ? $section->contents['sub_title'] : __('Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Phasellus hendrerit. Pellentesque aliquet nibh nec urna. In nisi neque, aliquet vel, dapibus id, mattis vel, nisi.') }}
                    </p>
                    <a href="{{ url('success') }}" class="template-btn">
                        {{ __('View All Success Stories') }}
                    </a>
                </div>
            </div>

        </div>
    </div>
</section>
<!--====== End Success Story Section ======-->
