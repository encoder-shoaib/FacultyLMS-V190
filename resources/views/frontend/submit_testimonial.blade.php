@extends('frontend.layouts.master')
@section('title', __('Success'))
@section('content')
<section class="support-section p-t-35 p-t-sm-30 p-b-md-50 p-b-80">
    <div class="container container-1278">

        @if(isset($successStories) && $successStories->count() > 0)
        <div class="row">

            <!-- Header -->
            <div class="col-12 header">
                <div class="course-shorter justify-content-between course-shorter-v2 color-secondary m-b-40 m-b-sm-30">
                    <ul class="grid-list">
                        <li class="d-none d-md-inline-block style_type {{ $style == 'grid' ? 'active' : '' }}"><a href="{{ request()->fullUrlWithQuery(['style' => 'grid']) }}"><i class="fas fa-th"></i></a></li>
                        <li class="d-none d-md-inline-block style_type {{ $style == 'list' ? 'active' : '' }}"><a href="{{ request()->fullUrlWithQuery(['style' => 'list']) }}"><i class="fas fa-th-list"></i></a></li>
                        <li class="sort-text d-none d-md-inline-block">{{__('showing') }} {{ $total_results }} {{__('of')  }} {{ $total_success_stories }} {{__('results') }}</li>
                    </ul>
                    <div class="sort-right">
                        <div class="course-dropdown d-none d-sm-block">
                            <select class="course-sort" name="sorting" onchange="document.getElementById('success-filter-form').submit()" form="success-filter-form">
                                <option value="latest" {{ $sorting == 'latest' ? 'selected':'' }}>{{__('latest') }}</option>
                                <option value="top_rated" {{ $sorting == 'top_rated' ? 'selected':'' }} >{{__('top_rated') }}</option>
                                <option value="oldest" {{ $sorting == 'oldest' ? 'selected':'' }} >{{__('oldest') }}</option>
                            </select>
                        </div>
                        <form method="get" action="{{ url()->current() }}" id="success-filter-form" class="search-form">
                            <input type="hidden" name="style" value="{{ $style }}">
                            <input type="text" placeholder="{{__('search') }}" name="q" value="{{ $q ?? '' }}" class="keyword">
                            <button type="submit" class="search-btn"><i class="bx bx-search"></i></button>
                        </form>
                    </div>
                </div>
            </div>
            <!-- End Header -->
        </div>

        <div class="row {{ $style == 'list' ? 'course-items-v3 list-view m-b-50' : 'course-items-v3 grid-view course-list m-b-50' }}">
            @foreach($successStories as $story)
                @if($style == 'list')
                    <div class="col-md-12 col-sm-6 m-b-30" data-aos="fade-up" data-aos-delay="{{ $loop->iteration * 100 }}">
                        <div class="course-item" style="display: flex; flex-direction: column; background-color: #fff; border-radius: 6px; overflow: hidden;">
                            <a href="{{ route('success.details', $story->slug) }}" class="course-item-thumb" style="display: block; margin-bottom: 0; line-height: 0; height: 248px; overflow: hidden;">
                                @if($story->video)
                                    <video src="{{ asset($story->video) }}" controls style="width: 100%; height: 248px; object-fit: cover; border-top-left-radius: 6px; border-bottom-left-radius: 6px;"></video>
                                @else
                                    <img src="{{ getFileLink('473x337', $story->image) }}" alt="{{ $story->title }}" style="width: 100%; height: 248px; object-fit: cover; border-top-left-radius: 6px; border-bottom-left-radius: 6px;">
                                @endif
                            </a>
                            <div class="course-item-body" style="padding: 15px 20px; flex-grow: 1; display: flex; flex-direction: column; justify-content: flex-start;">
                                <div class="course-item-info mb-3" style="display: block; font-size: 14px; line-height: 1.6; color: #333;">
                                    "{{ Str::limit($story->description, 200) }}"
                                </div>
                                <div class="d-flex align-items-center mt-2">
                                    <div class="author-img m-r-10" style="flex-shrink: 0;">
                                        <img src="{{ getFileLink('40x40', $story->image) }}" alt="{{ $story->title }}" class="rounded-circle" style="width: 55px; height: 55px; object-fit: cover; border: 2px solid #e0e0e0; padding: 2px;">
                                    </div>
                                    <div class="author-details" style="min-width: 0; flex: 1;">
                                        <h5 class="m-b-0" style="font-size: 15px; font-weight: 600; line-height: 1.2; color: var(--theme-clr);">
                                            {{ $story->title }}
                                        </h5>
                                        <div class="color-gray" style="font-size: 14px; margin-bottom: 3px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">{{ $story->position ?? __('Student') }}</div>
                                        @if($story->rating)
                                            <div class="rating-review">
                                                @for($i = 1; $i <= 5; $i++)
                                                    <i class="fa{{ $i <= $story->rating ? 's' : 'l' }} fa-star" style="color: #ff9800; font-size: 15px;"></i>
                                                @endfor
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @else
                    <div class="col-lg-3 col-md-4 col-sm-6 m-b-30" data-aos="fade-up" data-aos-delay="{{ $loop->iteration * 100 }}">
                        <div class="course-item" style="height: 100%; display: flex; flex-direction: column; background-color: #fff; border-radius: 6px; overflow: hidden;">
                            <a href="{{ route('success.details', $story->slug) }}" class="course-item-thumb" style="display: block; margin-bottom: 0; line-height: 0; height: 200px; overflow: hidden;">
                                @if($story->video)
                                    <video src="{{ asset($story->video) }}" controls style="width: 100%; height: 200px; object-fit: cover; border-top-left-radius: 6px; border-top-right-radius: 6px;"></video>
                                @else
                                    <img src="{{ getFileLink('473x337', $story->image) }}" alt="{{ $story->title }}" style="width: 100%; height: 200px; object-fit: cover;">
                                @endif
                            </a>
                            <div class="course-item-body p-0 m-0" style="flex-grow: 1; background-color: #fff; display: flex; flex-direction: column; justify-content: flex-start;">
                                <div class="course-item-body-inner" style="padding: 15px; margin-bottom: auto;">
                                    <div class="course-item-info mb-2" style="display: block; font-size: 13px; line-height: 1.5;">
                                        "{{ Str::limit($story->description, 130) }}"
                                    </div>
                                    <div class="d-flex align-items-center mt-2">
                                        <div class="author-img m-r-10" style="flex-shrink: 0;">
                                            <img src="{{ getFileLink('40x40', $story->image) }}" alt="{{ $story->title }}" class="rounded-circle" style="width: 45px; height: 45px; object-fit: cover; border: 2px solid #e0e0e0; padding: 2px;">
                                        </div>
                                        <div class="author-details" style="min-width: 0; flex: 1;">
                                            <h5 class="m-b-0" style="font-size: 14px; font-weight: 600; line-height: 1.2; color: var(--theme-clr);">
                                                {{ $story->title }}
                                            </h5>
                                            <div class="color-gray mt-1" style="font-size: 12px; margin-bottom: 2px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">{{ $story->position ?? __('Student') }}</div>
                                            @if($story->rating)
                                                <div class="rating-review">
                                                    @for($i = 1; $i <= 5; $i++)
                                                        <i class="fa{{ $i <= $story->rating ? 's' : 'l' }} fa-star" style="color: #ff9800; font-size: 13px;"></i>
                                                    @endfor
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            @endforeach
        </div>
        <hr class="m-b-50">
        @endif

        <div class="row justify-content-center">
            <div class="col-lg-8 col-md-10">
                
                <div class="section-title-v3 color-dark m-b-20" style="display: flex; align-items: baseline; justify-content: space-between; border-bottom: 1px solid #eee; padding-bottom: 10px;">
                    <h5 style="font-weight: 600; font-size: 18px; margin: 0; color: #333;">{{ __('Your Experience Matters') }}</h5>
                    <p class="m-0" style="font-size: 14px; color: #666;">{{ __('Share your success story with us.') }}</p>
                </div>

                @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                <div class="ticket-replies m-t-30">
                    <form action="{{ route('store.testimonial') }}" method="POST" enctype="multipart/form-data" class="user-form p-0 row">
                        @csrf
                        
                        <!-- Profile Photo -->
                        <div class="col-12 m-b-30">
                            <div class="d-flex align-items-center">
                                <div class="profile-avatar d-flex align-items-center justify-content-center" style="width: 55px; height: 55px; background-color: #f0f0f0; border-radius: 50%; margin-right: 15px; font-size: 18px; color: #888;">
                                    <i class="fas fa-camera-retro"></i>
                                </div>
                                <div class="profile-btn-wrap">
                                    <label class="btn btn-outline-secondary btn-sm mb-1" style="cursor: pointer; font-size: 13px; font-weight: 500; padding: 5px 12px;">
                                        <i class="fas fa-cloud-upload-alt m-r-5"></i> {{ __('PROFILE PHOTO') }}
                                        <input type="file" name="profile_photo" style="display: none;" accept="image/*">
                                    </label>
                                    <div class="fz-12 color-gray">{{ __('Optional, but recommended') }}</div>
                                </div>
                            </div>
                        </div>

                        <!-- Media Upload -->
                        <div class="col-12 m-b-20">
                            <label for="file" style="font-size: 14px; font-weight: 500; color: #444; margin-bottom: 8px;">{{ __('Add a photo or video to your testimonial') }}</label>
                            <div class="upload-media-box" style="border: 1px dashed #ccc; border-radius: 4px; padding: 20px; text-align: center; position: relative; background: #fafafa; cursor: pointer;">
                                <input type="file" name="file" id="file" accept="image/*,video/*" style="opacity: 0; position: absolute; top: 0; left: 0; width: 100%; height: 100%; cursor: pointer;">
                                <div class="upload-content d-flex align-items-center justify-content-center color-gray fw-500" style="font-size: 13px;">
                                    <i class="fas fa-video m-r-10 fz-16"></i> <span id="file-name">{{ __('UPLOAD PHOTO/VIDEO') }}</span>
                                </div>
                            </div>
                            @error('file')
                                <p class="text-danger error" style="font-size: 13px; margin-top: 5px;">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Name & Position -->
                        <div class="col-md-6 m-b-20">
                            <label for="name" style="font-size: 14px; font-weight: 500; color: #444; margin-bottom: 8px;">{{ __('Your Name') }}</label>
                            <input type="text" class="form-control" name="name" id="name" required>
                            @error('name')
                                <p class="text-danger error" style="font-size: 13px; margin-top: 5px;">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="col-md-6 m-b-20">
                            <label for="position" style="font-size: 14px; font-weight: 500; color: #444; margin-bottom: 8px;">{{ __('Position/Title') }}</label>
                            <input type="text" class="form-control" name="position" id="position">
                            @error('position')
                                <p class="text-danger error" style="font-size: 13px; margin-top: 5px;">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Testimonial Text -->
                        <div class="col-12 m-b-20">
                            <label for="description" style="font-size: 14px; font-weight: 500; color: #444; margin-bottom: 8px;">{{ __('Your Testimonial') }}</label>
                            <textarea class="form-control" name="description" id="description" rows="4" required></textarea>
                            @error('description')
                                <p class="text-danger error" style="font-size: 13px; margin-top: 5px;">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Rating -->
                        <div class="col-12 m-b-30">
                            <label style="font-size: 14px; font-weight: 500; color: #444; margin-bottom: 8px;">{{ __('Your Rating') }}</label>
                            <div class="rating-stars" style="color: #ff9800; font-size: 18px; cursor: pointer;">
                                <i class="fas fa-star" data-value="1"></i>
                                <i class="fas fa-star" data-value="2"></i>
                                <i class="fas fa-star" data-value="3"></i>
                                <i class="fas fa-star" data-value="4"></i>
                                <i class="fas fa-star" data-value="5"></i>
                            </div>
                            <input type="hidden" name="rating" id="rating-value" value="5">
                        </div>

                        <!-- Submit -->
                        <div class="col-md-12 m-t-10">
                            <button class="template-btn" type="submit">{{ __('Submit Testimonial') }}</button>
                        </div>
                    </form>
                </div>
                
            </div>
        </div>
    </div>
</section>
@endsection

@push('js')
<script>
    $(document).ready(function() {
        // File preview for media
        $('#file').on('change', function(e) {
            if(e.target.files.length > 0) {
                $('#file-name').text(e.target.files[0].name);
            } else {
                $('#file-name').text('{{ __("UPLOAD PHOTO/VIDEO") }}');
            }
        });

        // Star rating
        $('.rating-stars i').on('click', function() {
            const value = parseInt($(this).data('value'));
            $('#rating-value').val(value);
            
            $('.rating-stars i').each(function() {
                const sValue = parseInt($(this).data('value'));
                if (sValue <= value) {
                    $(this).removeClass('fal far').addClass('fas');
                } else {
                    $(this).removeClass('fas').addClass('fal'); // using fal as per theme
                }
            });
        });
    });
</script>
@endpush
