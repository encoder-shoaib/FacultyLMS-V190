@extends('backend.layouts.master')
@section('title', __('success_video_section'))
@section('content')
    <section class="oftions">
        <div class="container-fluid">
            <div class="row">
                @include('backend.admin.website_setting.sidebar_component')
                <div class="col-xxl-9 col-lg-8 col-md-8">
                    <h3 class="section-title">{{ __('success_video_section') }}</h3>
                    <div class="bg-white redious-border p-20 p-sm-30">
                        <form>
                            <div class="row">
                                <div class="col-lg-12">
                                    <input type="hidden" name="r" value="{{ url()->current() }}" class="r">
                                    <div class="mb-4">
                                        <label for="lang" class="form-label">{{__('language') }}</label>
                                        <select id="lang"
                                                class="form-select form-select-lg mb-3 with_search" name="lang">
                                            <option value="">{{__('select_language') }}</option>
                                            @foreach($languages as $language)
                                                <option
                                                    value="{{ $language->locale }}" {{ $lang == $language->locale ? 'selected' : '' }}>{{ $language->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </form>

                        <form action="{{route('website.success_video_section.save')}}" method="POST" class="form" enctype="multipart/form-data">@csrf
                            <div class="row gx-20">
                                <input type="hidden" value="0" class="is_modal" name="is_modal">
                                <input type="hidden" value="{{ $lang }}" name="site_lang">

                                <!-- Subtitle -->
                                <div class="col-12 col-lg-6">
                                    <div class="mb-4">
                                        <label for="success_video_subtitle" class="form-label">{{ __('subtitle') }}</label>
                                        <input type="text" class="form-control rounded-2" id="success_video_subtitle"
                                               placeholder="{{ __('e.g. STUDENT SUCCESS') }}" name="success_video_subtitle" value="{{ setting('success_video_subtitle', $lang) ?: 'STUDENT SUCCESS' }}">
                                    </div>
                                </div>

                                <!-- Title -->
                                <div class="col-12 col-lg-6">
                                    <div class="mb-4">
                                        <label for="success_video_title" class="form-label">{{ __('title') }}</label>
                                        <input type="text" class="form-control rounded-2" id="success_video_title"
                                               placeholder="{{ __('enter_title') }}" name="success_video_title" value="{{ setting('success_video_title', $lang) ?: 'Success Story Of My Students' }}">
                                    </div>
                                </div>

                                <!-- Description -->
                                <div class="col-lg-12">
                                    <div class="mb-4">
                                        <label for="success_video_description" class="form-label">{{ __('description') }}</label>
                                        <textarea class="form-control" id="success_video_description" rows="3"
                                                  name="success_video_description" placeholder="{{ __('enter_description') }}">{{ setting('success_video_description', $lang) }}</textarea>
                                    </div>
                                </div>

                                <!-- Video Embed URL -->
                                <div class="col-12 col-lg-6">
                                    <div class="mb-4">
                                        <label for="success_video_url" class="form-label">{{ __('video_url') }}</label>
                                        <input type="text" class="form-control rounded-2" id="success_video_url"
                                               placeholder="{{ __('https://www.youtube.com/watch?v=...') }}" name="success_video_url" value="{{ setting('success_video_url', $lang) }}">
                                    </div>
                                </div>

                                <!-- Enroll Button Text -->
                                <div class="col-12 col-lg-6">
                                    <div class="mb-4">
                                        <label for="success_video_button_text" class="form-label">{{ __('button_text') }}</label>
                                        <input type="text" class="form-control rounded-2" id="success_video_button_text"
                                               placeholder="{{ __('e.g. ENROLL NOW') }}" name="success_video_button_text" value="{{ setting('success_video_button_text', $lang) ?: 'ENROLL NOW' }}">
                                    </div>
                                </div>

                                <!-- Banner Image Upload -->
                                <div class="col-lg-12 input_file_div mb-3">
                                    <div class="mb-3">
                                        <label for="success_video_image" class="form-label mb-1">{{ __('image') }} (800x600)</label>
                                        <label for="success_video_image" class="file-upload-text">
                                            <p></p>
                                            <span class="file-btn">{{ __('choose_file') }}</span>
                                        </label>
                                        <input class="d-none file_picker" type="file" name="success_video_image" id="success_video_image">
                                    </div>
                                    <div class="selected-files d-flex flex-wrap gap-20">
                                        <div class="selected-files-item">
                                            <img class="selected-img" src="{{ getFileLink('80x80', setting('success_video_image')) }}" alt="video banner image">
                                        </div>
                                    </div>
                                </div>

                                <!-- Status Switch -->
                                <div class="d-flex gap-12 sandbox_mode_div mb-4 col-12">
                                    <input type="hidden" name="success_video_status" value="{{ setting('success_video_status') === '0' ? 0 : 1 }}">
                                    <label class="form-label" for="success_video_status">{{ __('status') }}</label>
                                    <div class="setting-check">
                                        <input type="checkbox" value="1" id="success_video_status"
                                               class="sandbox_mode" {{ setting('success_video_status') === '0' ? '' : 'checked' }}>
                                        <label for="success_video_status"></label>
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
