@extends('backend.layouts.master')
@section('title', __('ad_banner_section'))
@section('content')
    <section class="oftions">
        <div class="container-fluid">
            <div class="row">
                @include('backend.admin.website_setting.sidebar_component')
                <div class="col-xxl-9 col-lg-8 col-md-8">
                    <h3 class="section-title">{{ __('ad_banner_section') }}</h3>
                    <div class="bg-white redious-border p-20 p-sm-30">
                        <form action="{{route('website.ad_banner_section.save')}}" method="POST" class="form" enctype="multipart/form-data">@csrf
                            <div class="row gx-20">
                                <input type="hidden" value="0" class="is_modal" name="is_modal">

                                <!-- Banner 1 Settings -->
                                <div class="col-12 mb-4">
                                    <div class="card p-3 p-md-4 border rounded-3 bg-light">
                                        <h5 class="fw-bold mb-3 text-primary"><i class="las la-image"></i> {{ __('ad_banner') }} 1</h5>
                                        
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="mb-4">
                                                    <label for="home_ad_banner_link_1" class="form-label">{{ __('ad_banner_link_url') }} 1</label>
                                                    <input type="text" class="form-control rounded-2" id="home_ad_banner_link_1"
                                                           placeholder="https://example.com/promotion1" name="home_ad_banner_link_1" 
                                                           value="{{ setting('home_ad_banner_link_1') ?: setting('home_ad_banner_link') }}">
                                                </div>
                                            </div>

                                            <div class="col-lg-12 input_file_div mb-3">
                                                <div class="mb-3">
                                                    <label for="home_ad_banner_image_1" class="form-label mb-1">{{ __('banner_image') }} 1 (1200x300)</label>
                                                    <label for="home_ad_banner_image_1" class="file-upload-text">
                                                        <p></p>
                                                        <span class="file-btn">{{ __('choose_file') }}</span>
                                                    </label>
                                                    <input class="d-none file_picker" type="file" name="home_ad_banner_image_1" id="home_ad_banner_image_1">
                                                </div>
                                                <div class="selected-files d-flex flex-wrap gap-20">
                                                    <div class="selected-files-item">
                                                        @php
                                                            $banner1Img = setting('home_ad_banner_image_1') ?: setting('home_ad_banner_image');
                                                        @endphp
                                                        <img class="selected-img" src="{{ getFileLink('80x80', $banner1Img) }}" alt="Banner 1">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="d-flex gap-12 sandbox_mode_div col-12">
                                                <input type="hidden" name="home_ad_banner_status_1" value="{{ setting('home_ad_banner_status_1') === '0' ? 0 : 1 }}">
                                                <label class="form-label" for="home_ad_banner_status_1">{{ __('status') }} 1</label>
                                                <div class="setting-check">
                                                    <input type="checkbox" value="1" id="home_ad_banner_status_1"
                                                           class="sandbox_mode" {{ setting('home_ad_banner_status_1') === '0' ? '' : 'checked' }}>
                                                    <label for="home_ad_banner_status_1"></label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Banner 2 Settings -->
                                <div class="col-12 mb-4">
                                    <div class="card p-3 p-md-4 border rounded-3 bg-light">
                                        <h5 class="fw-bold mb-3 text-success"><i class="las la-image"></i> {{ __('ad_banner') }} 2</h5>
                                        
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="mb-4">
                                                    <label for="home_ad_banner_link_2" class="form-label">{{ __('ad_banner_link_url') }} 2</label>
                                                    <input type="text" class="form-control rounded-2" id="home_ad_banner_link_2"
                                                           placeholder="https://example.com/promotion2" name="home_ad_banner_link_2" 
                                                           value="{{ setting('home_ad_banner_link_2') }}">
                                                </div>
                                            </div>

                                            <div class="col-lg-12 input_file_div mb-3">
                                                <div class="mb-3">
                                                    <label for="home_ad_banner_image_2" class="form-label mb-1">{{ __('banner_image') }} 2 (1200x300)</label>
                                                    <label for="home_ad_banner_image_2" class="file-upload-text">
                                                        <p></p>
                                                        <span class="file-btn">{{ __('choose_file') }}</span>
                                                    </label>
                                                    <input class="d-none file_picker" type="file" name="home_ad_banner_image_2" id="home_ad_banner_image_2">
                                                </div>
                                                <div class="selected-files d-flex flex-wrap gap-20">
                                                    <div class="selected-files-item">
                                                        <img class="selected-img" src="{{ getFileLink('80x80', setting('home_ad_banner_image_2')) }}" alt="Banner 2">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="d-flex gap-12 sandbox_mode_div col-12">
                                                <input type="hidden" name="home_ad_banner_status_2" value="{{ setting('home_ad_banner_status_2') === '0' ? 0 : 1 }}">
                                                <label class="form-label" for="home_ad_banner_status_2">{{ __('status') }} 2</label>
                                                <div class="setting-check">
                                                    <input type="checkbox" value="1" id="home_ad_banner_status_2"
                                                           class="sandbox_mode" {{ setting('home_ad_banner_status_2') === '0' ? '' : 'checked' }}>
                                                    <label for="home_ad_banner_status_2"></label>
                                                </div>
                                            </div>
                                        </div>
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
