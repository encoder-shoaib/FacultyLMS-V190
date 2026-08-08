@extends('backend.layouts.master')
@section('title', __('single_course_section'))
@section('content')
    <section class="oftions">
        <div class="container-fluid">
            <div class="row">
                @include('backend.admin.website_setting.sidebar_component')
                <div class="col-xxl-9 col-lg-8 col-md-8">
                    <h3 class="section-title">{{ __('single_course_section') }}</h3>
                    <div class="bg-white redious-border p-20 p-sm-30">
                        <form action="{{route('website.single_course_section.save')}}" method="POST" class="form" enctype="multipart/form-data">@csrf
                            <div class="row gx-20">
                                <input type="hidden" value="0" class="is_modal" name="is_modal">

                                <div class="col-lg-12">
                                    <div class="mb-4">
                                        <label for="single_course_tag" class="form-label">{{ __('tag_badge_text') }}</label>
                                        <input type="text" class="form-control rounded-2" id="single_course_tag"
                                               placeholder="FEATURED COURSE" name="single_course_tag" 
                                               value="{{ setting('single_course_tag') ?: 'FEATURED COURSE' }}">
                                    </div>
                                </div>

                                <div class="col-lg-12">
                                    <div class="mb-4">
                                        <label for="single_course_title" class="form-label">{{ __('title') }}</label>
                                        <input type="text" class="form-control rounded-2" id="single_course_title"
                                               placeholder="Enter single course title" name="single_course_title" 
                                               value="{{ setting('single_course_title') ?: 'Master Web Development & Modern Programming Skills' }}">
                                    </div>
                                </div>

                                <div class="col-lg-12">
                                    <div class="mb-4">
                                        <label for="single_course_description_1" class="form-label">{{ __('description') }} 1</label>
                                        <textarea class="form-control rounded-2" id="single_course_description_1" rows="3"
                                                  placeholder="Enter description paragraph 1" name="single_course_description_1">{{ setting('single_course_description_1') ?: 'Accelerate your career with our hands-on masterclass course designed to guide you through real-world projects, modern frameworks, and industry best practices.' }}</textarea>
                                    </div>
                                </div>

                                <div class="col-lg-12">
                                    <div class="mb-4">
                                        <label for="single_course_description_2" class="form-label">{{ __('description') }} 2</label>
                                        <textarea class="form-control rounded-2" id="single_course_description_2" rows="3"
                                                  placeholder="Enter description paragraph 2" name="single_course_description_2">{{ setting('single_course_description_2') ?: 'Gain full lifetime access, 1-on-1 mentorship, comprehensive learning materials, and a verified certificate of completion.' }}</textarea>
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="mb-4">
                                        <label for="single_course_btn_text" class="form-label">{{ __('button_text') }}</label>
                                        <input type="text" class="form-control rounded-2" id="single_course_btn_text"
                                               placeholder="ENROLL NOW" name="single_course_btn_text" 
                                               value="{{ setting('single_course_btn_text') ?: 'ENROLL NOW' }}">
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="mb-4">
                                        <label for="single_course_btn_url" class="form-label">{{ __('button_url') }}</label>
                                        <input type="text" class="form-control rounded-2" id="single_course_btn_url"
                                               placeholder="https://example.com/course" name="single_course_btn_url" 
                                               value="{{ setting('single_course_btn_url') }}">
                                    </div>
                                </div>

                                <div class="col-lg-12 input_file_div mb-4">
                                    <div class="mb-3">
                                        <label for="single_course_image" class="form-label mb-1">{{ __('course_image') }} (Right Side Image)</label>
                                        <label for="single_course_image" class="file-upload-text">
                                            <p></p>
                                            <span class="file-btn">{{ __('choose_file') }}</span>
                                        </label>
                                        <input class="d-none file_picker" type="file" name="single_course_image" id="single_course_image">
                                    </div>
                                    <div class="selected-files d-flex flex-wrap gap-20">
                                        <div class="selected-files-item">
                                            <img class="selected-img" src="{{ getFileLink('80x80', setting('single_course_image')) }}" alt="Single Course Image">
                                        </div>
                                    </div>
                                </div>

                                <div class="d-flex gap-12 sandbox_mode_div col-12 mb-4">
                                    <input type="hidden" name="single_course_status" value="{{ setting('single_course_status') === '0' ? 0 : 1 }}">
                                    <label class="form-label" for="single_course_status">{{ __('status') }}</label>
                                    <div class="setting-check">
                                        <input type="checkbox" value="1" id="single_course_status"
                                               class="sandbox_mode" {{ setting('single_course_status') === '0' ? '' : 'checked' }}>
                                        <label for="single_course_status"></label>
                                    </div>
                                </div>

                                <div class="d-flex justify-content-start align-items-center mt-30 col-12">
                                    <button type="submit" class="btn sg-btn-primary">{{ __('update') }}</button>
                                    @include('backend.common.loading-btn', ['class' => 'btn sg-btn-primary'])
                                </div>

                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @include('backend.common.gallery-modal')
@endsection
@push('js')
    <script src="{{ static_asset('admin/js/media.js') }}"></script>
@endpush
@push('css_asset')
    <link rel="stylesheet" href="{{ static_asset('admin/css/dropzone.min.css') }}">
@endpush
@push('js_asset')
    <script src="{{ static_asset('admin/js/dropzone.min.js') }}"></script>
@endpush
