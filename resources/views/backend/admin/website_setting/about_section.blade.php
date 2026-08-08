@extends('backend.layouts.master')
@section('title', __('about_me_section'))
@section('content')
    <section class="oftions">
        <div class="container-fluid">
            <div class="row">
                @include('backend.admin.website_setting.sidebar_component')
                <div class="col-xxl-9 col-lg-8 col-md-8">
                    <h3 class="section-title">{{ __('about_me_section') }}</h3>
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
                                        <div class="nk-block-des text-danger">
                                            <p class="lang_error error">{{ $errors->first('lang') }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                        <form action="{{route('website.about_section.save')}}" method="POST" class="form" enctype="multipart/form-data">@csrf
                            <div class="row gx-20">
                                <input type="hidden" value="0" class="is_modal" name="is_modal">
                                <input type="hidden" value="{{ $lang }}" name="site_lang">

                                <!-- Badge Tag -->
                                <div class="col-12 col-lg-12">
                                    <div class="mb-4">
                                        <label for="about_me_tag" class="form-label">{{ __('tag_badge_text') }}</label>
                                        <input type="text" class="form-control rounded-2" id="about_me_tag"
                                               placeholder="{{ __('e.g. ABOUT ME') }}" name="about_me_tag" value="{{ setting('about_me_tag', $lang) ?: 'ABOUT ME' }}">
                                    </div>
                                </div>

                                <!-- Title -->
                                <div class="col-12 col-lg-12">
                                    <div class="mb-4">
                                        <label for="about_me_title" class="form-label">{{ __('title') }}</label>
                                        <input type="text" class="form-control rounded-2" id="about_me_title"
                                               placeholder="{{ __('enter_title') }}" name="about_me_title" value="{{ setting('about_me_title', $lang) ?: 'I\'m Teaching Online For About 5+ Years On Programming' }}">
                                    </div>
                                </div>

                                <!-- Description 1 -->
                                <div class="col-lg-12">
                                    <div class="mb-4">
                                        <label for="about_me_description" class="form-label">{{ __('description') }} 1</label>
                                        <textarea class="form-control" id="about_me_description" rows="3"
                                                  name="about_me_description" placeholder="{{ __('enter_description') }}">{{ setting('about_me_description', $lang) ?: 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Donec odio. Quisque volutpat mattis eros. Nullam malesuada erat ut turpis. Suspendisse urna nibh, viverra non.' }}</textarea>
                                    </div>
                                </div>

                                <!-- Description 2 -->
                                <div class="col-lg-12">
                                    <div class="mb-4">
                                        <label for="about_me_description_2" class="form-label">{{ __('description') }} 2</label>
                                        <textarea class="form-control" id="about_me_description_2" rows="3"
                                                  name="about_me_description_2" placeholder="{{ __('enter_description') }} 2">{{ setting('about_me_description_2', $lang) ?: 'Donec nec justo eget felis facilisis fermentum. Aliquam porttitor mauris sit amet orci. Aenean dignissim pellentesque felis.' }}</textarea>
                                    </div>
                                </div>

                                <!-- Button Text -->
                                <div class="col-6 col-lg-6">
                                    <div class="mb-4">
                                        <label for="about_me_btn_text" class="form-label">{{ __('button_text') }}</label>
                                        <input type="text" class="form-control rounded-2" id="about_me_btn_text"
                                               placeholder="{{ __('e.g. LEARN MORE') }}" name="about_me_btn_text" value="{{ setting('about_me_btn_text', $lang) ?: 'LEARN MORE' }}">
                                    </div>
                                </div>

                                <!-- Button Link -->
                                <div class="col-6 col-lg-6">
                                    <div class="mb-4">
                                        <label for="about_me_btn_url" class="form-label">{{ __('button_url') }}</label>
                                        <input type="text" class="form-control rounded-2" id="about_me_btn_url"
                                               placeholder="{{ __('e.g. # or /courses') }}" name="about_me_btn_url" value="{{ setting('about_me_btn_url', $lang) ?: '#' }}">
                                    </div>
                                </div>

                                <!-- Image Upload -->
                                <div class="col-lg-12 input_file_div mb-3">
                                    <div class="mb-3">
                                        <label for="about_me_image" class="form-label mb-1">{{ __('image') }} (600x600)</label>
                                        <label for="about_me_image" class="file-upload-text">
                                            <p></p>
                                            <span class="file-btn">{{ __('choose_file') }}</span>
                                        </label>
                                        <input class="d-none file_picker" type="file" name="about_me_image" id="about_me_image">
                                    </div>
                                    <div class="selected-files d-flex flex-wrap gap-20">
                                        <div class="selected-files-item">
                                            <img class="selected-img" src="{{ getFileLink('80x80', setting('about_me_image')) }}" alt="about me image">
                                        </div>
                                    </div>
                                </div>

                                <!-- Status Switch -->
                                <div class="d-flex gap-12 sandbox_mode_div mb-4">
                                    <input type="hidden" name="about_me_status" value="{{ setting('about_me_status') === '0' ? 0 : 1 }}">
                                    <label class="form-label" for="about_me_status">{{ __('status') }}</label>
                                    <div class="setting-check">
                                        <input type="checkbox" value="1" id="about_me_status"
                                               class="sandbox_mode" {{ setting('about_me_status') === '0' ? '' : 'checked' }}>
                                        <label for="about_me_status"></label>
                                    </div>
                                </div>

                                <div class="d-flex justify-content-start align-items-center mt-30">
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
