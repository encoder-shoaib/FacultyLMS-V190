@extends('backend.layouts.master')
@section('title', __('why_choose_section'))
@section('content')
    <section class="oftions">
        <div class="container-fluid">
            <div class="row">
                @include('backend.admin.website_setting.sidebar_component')
                <div class="col-xxl-9 col-lg-8 col-md-8">
                    <h3 class="section-title">{{ __('why_choose_section') }}</h3>
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

                        <form action="{{route('website.why_choose_section.save')}}" method="POST" class="form" enctype="multipart/form-data">@csrf
                            <div class="row gx-20">
                                <input type="hidden" value="0" class="is_modal" name="is_modal">
                                <input type="hidden" value="{{ $lang }}" name="site_lang">

                                <!-- Badge Tag -->
                                <div class="col-12 col-lg-6">
                                    <div class="mb-4">
                                        <label for="why_choose_tag" class="form-label">{{ __('tag_badge_text') }}</label>
                                        <input type="text" class="form-control rounded-2" id="why_choose_tag"
                                               placeholder="{{ __('e.g. WHY CHOOSE ME') }}" name="why_choose_tag" value="{{ setting('why_choose_tag', $lang) ?: 'WHY CHOOSE ME' }}">
                                    </div>
                                </div>

                                <!-- Section Title -->
                                <div class="col-12 col-lg-6">
                                    <div class="mb-4">
                                        <label for="why_choose_title" class="form-label">{{ __('title') }}</label>
                                        <input type="text" class="form-control rounded-2" id="why_choose_title"
                                               placeholder="{{ __('enter_title') }}" name="why_choose_title" value="{{ setting('why_choose_title', $lang) ?: 'Why Choose Me?' }}">
                                    </div>
                                </div>

                                <hr class="my-3">

                                <!-- Item 1 -->
                                <div class="col-12 col-lg-4">
                                    <div class="mb-4">
                                        <label for="why_choose_item1_title" class="form-label">{{ __('item_1_title') }}</label>
                                        <input type="text" class="form-control rounded-2" id="why_choose_item1_title"
                                               name="why_choose_item1_title" value="{{ setting('why_choose_item1_title', $lang) ?: 'Highly Experienced' }}">
                                    </div>
                                </div>
                                <div class="col-12 col-lg-8">
                                    <div class="mb-4">
                                        <label for="why_choose_item1_desc" class="form-label">{{ __('item_1_desc') }}</label>
                                        <input type="text" class="form-control rounded-2" id="why_choose_item1_desc"
                                               name="why_choose_item1_desc" value="{{ setting('why_choose_item1_desc', $lang) ?: 'Donec nec justo eget felis facilisis fermentum. Aliquam porttitor mauris sit amet orci. Aenean dignissim.' }}">
                                    </div>
                                </div>

                                <!-- Item 2 -->
                                <div class="col-12 col-lg-4">
                                    <div class="mb-4">
                                        <label for="why_choose_item2_title" class="form-label">{{ __('item_2_title') }}</label>
                                        <input type="text" class="form-control rounded-2" id="why_choose_item2_title"
                                               name="why_choose_item2_title" value="{{ setting('why_choose_item2_title', $lang) ?: 'Question, Quiz & Course Materials' }}">
                                    </div>
                                </div>
                                <div class="col-12 col-lg-8">
                                    <div class="mb-4">
                                        <label for="why_choose_item2_desc" class="form-label">{{ __('item_2_desc') }}</label>
                                        <input type="text" class="form-control rounded-2" id="why_choose_item2_desc"
                                               name="why_choose_item2_desc" value="{{ setting('why_choose_item2_desc', $lang) ?: 'Donec nec justo eget felis facilisis fermentum. Aliquam porttitor mauris sit amet orci. Aenean dignissim.' }}">
                                    </div>
                                </div>

                                <!-- Item 3 -->
                                <div class="col-12 col-lg-4">
                                    <div class="mb-4">
                                        <label for="why_choose_item3_title" class="form-label">{{ __('item_3_title') }}</label>
                                        <input type="text" class="form-control rounded-2" id="why_choose_item3_title"
                                               name="why_choose_item3_title" value="{{ setting('why_choose_item3_title', $lang) ?: 'Lifetime Course Update & Access' }}">
                                    </div>
                                </div>
                                <div class="col-12 col-lg-8">
                                    <div class="mb-4">
                                        <label for="why_choose_item3_desc" class="form-label">{{ __('item_3_desc') }}</label>
                                        <input type="text" class="form-control rounded-2" id="why_choose_item3_desc"
                                               name="why_choose_item3_desc" value="{{ setting('why_choose_item3_desc', $lang) ?: 'Donec nec justo eget felis facilisis fermentum. Aliquam porttitor mauris sit amet orci. Aenean dignissim.' }}">
                                    </div>
                                </div>

                                <!-- Item 4 -->
                                <div class="col-12 col-lg-4">
                                    <div class="mb-4">
                                        <label for="why_choose_item4_title" class="form-label">{{ __('item_4_title') }}</label>
                                        <input type="text" class="form-control rounded-2" id="why_choose_item4_title"
                                               name="why_choose_item4_title" value="{{ setting('why_choose_item4_title', $lang) ?: 'Dedicated Support' }}">
                                    </div>
                                </div>
                                <div class="col-12 col-lg-8">
                                    <div class="mb-4">
                                        <label for="why_choose_item4_desc" class="form-label">{{ __('item_4_desc') }}</label>
                                        <input type="text" class="form-control rounded-2" id="why_choose_item4_desc"
                                               name="why_choose_item4_desc" value="{{ setting('why_choose_item4_desc', $lang) ?: 'Donec nec justo eget felis facilisis fermentum. Aliquam porttitor mauris sit amet orci. Aenean dignissim.' }}">
                                    </div>
                                </div>

                                <hr class="my-3">
                                <h5>{{ __('images') }} (3 {{ __('collage_images') }})</h5>

                                <!-- Image 1 (Top Right Vertical) -->
                                <div class="col-lg-4 input_file_div mb-3">
                                    <div class="mb-3">
                                        <label for="why_choose_image_1" class="form-label mb-1">{{ __('image') }} 1 (Top-Right Vertical)</label>
                                        <label for="why_choose_image_1" class="file-upload-text">
                                            <p></p>
                                            <span class="file-btn">{{ __('choose_file') }}</span>
                                        </label>
                                        <input class="d-none file_picker" type="file" name="why_choose_image_1" id="why_choose_image_1">
                                    </div>
                                    <div class="selected-files d-flex flex-wrap gap-20">
                                        <div class="selected-files-item">
                                            <img class="selected-img" src="{{ getFileLink('80x80', setting('why_choose_image_1')) }}" alt="image 1">
                                        </div>
                                    </div>
                                </div>

                                <!-- Image 2 (Middle Left) -->
                                <div class="col-lg-4 input_file_div mb-3">
                                    <div class="mb-3">
                                        <label for="why_choose_image_2" class="form-label mb-1">{{ __('image') }} 2 (Mid-Left Card)</label>
                                        <label for="why_choose_image_2" class="file-upload-text">
                                            <p></p>
                                            <span class="file-btn">{{ __('choose_file') }}</span>
                                        </label>
                                        <input class="d-none file_picker" type="file" name="why_choose_image_2" id="why_choose_image_2">
                                    </div>
                                    <div class="selected-files d-flex flex-wrap gap-20">
                                        <div class="selected-files-item">
                                            <img class="selected-img" src="{{ getFileLink('80x80', setting('why_choose_image_2')) }}" alt="image 2">
                                        </div>
                                    </div>
                                </div>

                                <!-- Image 3 (Bottom Right Large) -->
                                <div class="col-lg-4 input_file_div mb-3">
                                    <div class="mb-3">
                                        <label for="why_choose_image_3" class="form-label mb-1">{{ __('image') }} 3 (Bottom-Right Large)</label>
                                        <label for="why_choose_image_3" class="file-upload-text">
                                            <p></p>
                                            <span class="file-btn">{{ __('choose_file') }}</span>
                                        </label>
                                        <input class="d-none file_picker" type="file" name="why_choose_image_3" id="why_choose_image_3">
                                    </div>
                                    <div class="selected-files d-flex flex-wrap gap-20">
                                        <div class="selected-files-item">
                                            <img class="selected-img" src="{{ getFileLink('80x80', setting('why_choose_image_3')) }}" alt="image 3">
                                        </div>
                                    </div>
                                </div>

                                <!-- Status Switch -->
                                <div class="d-flex gap-12 sandbox_mode_div mb-4 col-12 mt-3">
                                    <input type="hidden" name="why_choose_status" value="{{ setting('why_choose_status') === '0' ? 0 : 1 }}">
                                    <label class="form-label" for="why_choose_status">{{ __('status') }}</label>
                                    <div class="setting-check">
                                        <input type="checkbox" value="1" id="why_choose_status"
                                               class="sandbox_mode" {{ setting('why_choose_status') === '0' ? '' : 'checked' }}>
                                        <label for="why_choose_status"></label>
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
