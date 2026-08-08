@extends('backend.layouts.master')
@section('title', __('feature_section'))
@section('content')
    <section class="options">
        <div class="container-fluid">
            <div class="row">
                @include('backend.admin.website_setting.sidebar_component')
                <div class="col-xxl-9 col-lg-8 col-md-8">
                    <h3 class="section-title">{{ __('feature_section') }}</h3>
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
                        <form action="{{ route('website.feature_section.save') }}" method="POST" class="form" enctype="multipart/form-data">@csrf
                            <div class="row gx-20">
                                <input type="hidden" value="0" class="is_modal" name="is_modal">
                                <input type="hidden" value="{{ $lang }}" name="site_lang">

                                <!-- Enable / Disable Section Status -->
                                <div class="d-flex gap-12 sandbox_mode_div mb-4">
                                    <input type="hidden" name="feature_section_status" value="{{ setting('feature_section_status') === '0' ? 0 : 1 }}">
                                    <label class="form-label" for="feature_section_status">{{ __('status') }} (Show Section)</label>
                                    <div class="setting-check">
                                        <input type="checkbox" value="1" id="feature_section_status"
                                               class="sandbox_mode" {{ setting('feature_section_status') === '0' ? '' : 'checked' }}>
                                        <label for="feature_section_status"></label>
                                    </div>
                                </div>

                                <hr class="my-4">

                                <!-- Card 1 Settings -->
                                <h5 class="fw-bold mb-3 text-primary"><i class="las la-certificate me-2"></i>Card 1 (Life Time Access)</h5>
                                <div class="col-12 col-lg-6">
                                    <div class="mb-4">
                                        <label for="feature_1_title" class="form-label">Card 1 Title</label>
                                        <input type="text" class="form-control rounded-2" id="feature_1_title"
                                               name="feature_1_title" value="{{ setting('feature_1_title', $lang) ?: 'Life Time Access' }}">
                                    </div>
                                </div>
                                <div class="col-12 col-lg-6">
                                    <div class="mb-4">
                                        <label for="feature_1_icon" class="form-label">Card 1 Icon Class (e.g. fas fa-shield-alt)</label>
                                        <input type="text" class="form-control rounded-2" id="feature_1_icon"
                                               name="feature_1_icon" value="{{ setting('feature_1_icon') ?: 'fas fa-shield-alt' }}">
                                    </div>
                                </div>
                                <div class="col-12 mb-4">
                                    <label for="feature_1_desc" class="form-label">Card 1 Description</label>
                                    <textarea class="form-control" id="feature_1_desc" name="feature_1_desc" rows="2">{{ setting('feature_1_desc', $lang) ?: 'Donec nec justo eget felis facilisis fermentum. Aliquam porttitor.' }}</textarea>
                                </div>

                                <hr class="my-4">

                                <!-- Card 2 Settings -->
                                <h5 class="fw-bold mb-3 text-primary"><i class="las la-book me-2"></i>Card 2 (Free Course Materials)</h5>
                                <div class="col-12 col-lg-6">
                                    <div class="mb-4">
                                        <label for="feature_2_title" class="form-label">Card 2 Title</label>
                                        <input type="text" class="form-control rounded-2" id="feature_2_title"
                                               name="feature_2_title" value="{{ setting('feature_2_title', $lang) ?: 'Free Course Materials' }}">
                                    </div>
                                </div>
                                <div class="col-12 col-lg-6">
                                    <div class="mb-4">
                                        <label for="feature_2_icon" class="form-label">Card 2 Icon Class (e.g. fas fa-book-open)</label>
                                        <input type="text" class="form-control rounded-2" id="feature_2_icon"
                                               name="feature_2_icon" value="{{ setting('feature_2_icon') ?: 'fas fa-book-open' }}">
                                    </div>
                                </div>
                                <div class="col-12 mb-4">
                                    <label for="feature_2_desc" class="form-label">Card 2 Description</label>
                                    <textarea class="form-control" id="feature_2_desc" name="feature_2_desc" rows="2">{{ setting('feature_2_desc', $lang) ?: 'Donec nec justo eget felis facilisis fermentum. Aliquam porttitor.' }}</textarea>
                                </div>

                                <hr class="my-4">

                                <!-- Card 3 Settings -->
                                <h5 class="fw-bold mb-3 text-primary"><i class="las la-headset me-2"></i>Card 3 (Dedicated Support)</h5>
                                <div class="col-12 col-lg-6">
                                    <div class="mb-4">
                                        <label for="feature_3_title" class="form-label">Card 3 Title</label>
                                        <input type="text" class="form-control rounded-2" id="feature_3_title"
                                               name="feature_3_title" value="{{ setting('feature_3_title', $lang) ?: 'Dedicated Support' }}">
                                    </div>
                                </div>
                                <div class="col-12 col-lg-6">
                                    <div class="mb-4">
                                        <label for="feature_3_icon" class="form-label">Card 3 Icon Class (e.g. fas fa-headset)</label>
                                        <input type="text" class="form-control rounded-2" id="feature_3_icon"
                                               name="feature_3_icon" value="{{ setting('feature_3_icon') ?: 'fas fa-headset' }}">
                                    </div>
                                </div>
                                <div class="col-12 mb-4">
                                    <label for="feature_3_desc" class="form-label">Card 3 Description</label>
                                    <textarea class="form-control" id="feature_3_desc" name="feature_3_desc" rows="2">{{ setting('feature_3_desc', $lang) ?: 'Donec nec justo eget felis facilisis fermentum. Aliquam porttitor.' }}</textarea>
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
@endsection
