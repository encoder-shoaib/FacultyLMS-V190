@extends('backend.layouts.master')
@section('title', __('webinar_section'))
@section('content')
    <section class="options">
        <div class="container-fluid">
            <div class="row">
                @include('backend.admin.website_setting.sidebar_component')
                <div class="col-xxl-9 col-lg-8 col-md-8">
                    <h3 class="section-title">{{ __('webinar_section') }}</h3>
                    <div class="bg-white redious-border p-20 p-sm-30">
                        <form>
                            <div class="row">
                                <div class="col-lg-12">
                                    <input type="hidden" name="r" value="{{ url()->current() }}" class="r">
                                    <div class="mb-4">
                                        <label for="lang" class="form-label">{{ __('language') }}</label>
                                        <select id="lang"
                                                class="form-select form-select-lg mb-3 with_search" name="lang">
                                            <option value="">{{ __('select_language') }}</option>
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
                        <form action="{{ route('website.webinar_section.save') }}" method="POST" class="form" enctype="multipart/form-data">@csrf
                            <div class="row gx-20">
                                <input type="hidden" value="0" class="is_modal" name="is_modal">
                                <input type="hidden" value="{{ $lang }}" name="site_lang">

                                <!-- Subtitle / Badge -->
                                <div class="col-12 col-lg-6">
                                    <div class="mb-4">
                                        <label for="webinar_subtitle" class="form-label">{{ __('webinar_subtitle') }}</label>
                                        <input type="text" class="form-control rounded-2" id="webinar_subtitle"
                                               placeholder="e.g. LIVE WEBINAR" name="webinar_subtitle" value="{{ setting('webinar_subtitle', $lang) ?: 'LIVE WEBINAR' }}">
                                    </div>
                                </div>

                                <!-- Title -->
                                <div class="col-12 col-lg-6">
                                    <div class="mb-4">
                                        <label for="webinar_title" class="form-label">{{ __('webinar_title') }}</label>
                                        <input type="text" class="form-control rounded-2" id="webinar_title"
                                               placeholder="e.g. Join My Upcoming Webinars" name="webinar_title" value="{{ setting('webinar_title', $lang) ?: 'Join My Upcoming Webinars' }}">
                                    </div>
                                </div>

                                <!-- Description Paragraph 1 -->
                                <div class="col-lg-12">
                                    <div class="mb-4">
                                        <label for="webinar_description_1" class="form-label">{{ __('webinar_description_1') }}</label>
                                        <textarea class="form-control" id="webinar_description_1" rows="3"
                                                  name="webinar_description_1" placeholder="{{ __('enter_description') }}">{{ setting('webinar_description_1', $lang) ?: 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Donec odio. Quisque volutpat mattis eros. Nullam malesuada erat ut turpis. Suspendisse urna nibh, viverra non.' }}</textarea>
                                    </div>
                                </div>

                                <!-- Description Paragraph 2 -->
                                <div class="col-lg-12">
                                    <div class="mb-4">
                                        <label for="webinar_description_2" class="form-label">{{ __('webinar_description_2') }}</label>
                                        <textarea class="form-control" id="webinar_description_2" rows="3"
                                                  name="webinar_description_2" placeholder="{{ __('enter_description') }}">{{ setting('webinar_description_2', $lang) ?: 'Donec nec justo eget felis facilisis fermentum. Aliquam porttitor mauris sit amet orci. Aenean dignissim pellentesque felis.' }}</textarea>
                                    </div>
                                </div>

                                <!-- Button Text -->
                                <div class="col-12 col-lg-6">
                                    <div class="mb-4">
                                        <label for="webinar_btn_text" class="form-label">{{ __('webinar_btn_text') }}</label>
                                        <input type="text" class="form-control rounded-2" id="webinar_btn_text"
                                               placeholder="e.g. REGISTER NOW" name="webinar_btn_text" value="{{ setting('webinar_btn_text', $lang) ?: 'REGISTER NOW' }}">
                                    </div>
                                </div>

                                <!-- Button Link -->
                                <div class="col-12 col-lg-6">
                                    <div class="mb-4">
                                        <label for="webinar_btn_link" class="form-label">{{ __('webinar_btn_link') }}</label>
                                        <input type="text" class="form-control rounded-2" id="webinar_btn_link"
                                               placeholder="e.g. /student/sign-up" name="webinar_btn_link" value="{{ setting('webinar_btn_link', $lang) ?: route('student.sign_up') }}">
                                    </div>
                                </div>

                                <!-- Webinar Image -->
                                @include('backend.common.media-input', [
                                    'title' => __('image'),
                                    'name'  => 'webinar_image',
                                    'label' => __('image'),
                                    'size'  => '(828x490)',
                                    'image' => is_array(setting('webinar_image')) ? (setting('webinar_image')['id'] ?? '') : setting('webinar_image'),
                                    'col'   => 'col-12 mb-4'
                                ])

                                <!-- Section Status -->
                                <div class="d-flex gap-12 sandbox_mode_div mb-4">
                                    <input type="hidden" name="webinar_status" value="{{ setting('webinar_status') === '0' ? 0 : 1 }}">
                                    <label class="form-label" for="webinar_status">{{ __('status') }}</label>
                                    <div class="setting-check">
                                        <input type="checkbox" value="1" id="webinar_status"
                                               class="sandbox_mode" {{ setting('webinar_status') === '0' ? '' : 'checked' }}>
                                        <label for="webinar_status"></label>
                                    </div>
                                </div>

                                <!-- Submit Button -->
                                <div class="d-flex justify-content-start align-items-center mt-30">
                                    <button type="submit" class="btn sg-btn-primary">{{ __('save') }}</button>
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
    <!--====== media.js ======-->
    <script src="{{ static_asset('admin/js/dropzone.min.js') }}"></script>
@endpush
