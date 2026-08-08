@extends('backend.layouts.master')
@section('title', __('add_new_course'))
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h3 class="section-title">{{ __('add_new_course') }}</h3>
                @php
                    $step_1_error = false;
                    $step_2_error = false;
                    $step_3_error = false;
                    $step_1_errors = ['title', 'category_id', 'subject_id', 'organization_id', 'language_id', 'level_id', 'instructor_ids', 'duration'];
                    $step_3_errors = ['price', 'discount_type', 'discount', 'discount_period', 'renew_after'];

                    foreach ($step_1_errors as $step1) {
                        if ($errors->has($step1)) {
                            $step_1_error = true;
                            break;
                        }
                    }

                    if ($errors->has('video')) {
                        $step_2_error = true;
                    }

                    foreach ($step_3_errors as $step3) {
                        if ($errors->has($step3)) {
                            $step_3_error = true;
                            break;
                        }
                    }
                @endphp
                <div class="default-tab-list bg-white redious-border p-20 p-sm-30">
                    <ul class="nav justify-content-center pb-40 mb-0" id="pills-tab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <a class="nav-link {{ $step_2_error || $step_3_error ? '' : 'active' }} {{ $step_1_error ? 'text-danger' : '' }}"
                                id="basicInformation" data-bs-toggle="pill" data-bs-target="#basicCourseInformation"
                                role="tab" aria-controls="basicCourseInformation" aria-selected="true">
                                <span
                                    class="default-tab-count {{ $step_1_error ? 'bg-danger text-white' : '' }}">{{ __('1') }}</span>{{ __('basic_information') }}</a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link {{ $step_2_error ? 'active text-danger' : '' }}" id="mediaImages"
                                data-bs-toggle="pill" data-bs-target="#courseMediaImages" role="tab"
                                aria-controls="courseMediaImages" aria-selected="false">
                                <span
                                    class="default-tab-count {{ $step_2_error ? 'bg-danger text-white' : '' }}">{{ __('2') }}</span>{{ __('media_images') }}</a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link {{ $step_3_error && !$step_2_error ? 'active text-danger' : '' }}"
                                id="pricing" data-bs-toggle="pill" data-bs-target="#coursePricing" role="tab"
                                aria-controls="coursePricing" aria-selected="false">
                                <span
                                    class="default-tab-count {{ $step_3_error && !$step_2_error ? 'bg-danger text-white' : '' }}">{{ __('3') }}</span>{{ __('pricing') }}</a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link" id="seo" data-bs-toggle="pill" data-bs-target="#courseSEO"
                                role="tab" aria-controls="courseSEO" aria-selected="false">
                                <span class="default-tab-count">{{ __('4') }}</span>{{ __('seo') }}</a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link" id="masterclass" data-bs-toggle="pill" data-bs-target="#courseMasterclass"
                                role="tab" aria-controls="courseMasterclass" aria-selected="false">
                                <span class="default-tab-count">{{ __('5') }}</span>{{ __('Masterclass Landing') }}</a>
                        </li>
                    </ul>
                    <!-- End Add New Course tab menu -->

                    <form action="{{ route('courses.store') }}" method="POST" enctype="multipart/form-data">@csrf
                        <div class="tab-content" id="mgCourse-tabContent">
                            <div class="tab-pane fade {{ $step_2_error || $step_3_error ? '' : 'show active' }}"
                                id="basicCourseInformation" role="tabpanel" aria-labelledby="basicInformation"
                                tabindex="0">
                                <div class="row gx-20">
                                    <div class="col-lg-6">
                                        <div class="mb-4">
                                            <label for="courseTitle" class="form-label">{{ __('course_title') }}</label>
                                            <input type="text" value="{{ old('title') }}"
                                                class="form-control rounded-2 ai_content_name" id="courseTitle"
                                                name="title" placeholder="{{ __('enter_course_title') }}">
                                            <div class="nk-block-des text-danger">
                                                <p class="error">{{ $errors->first('title') }}</p>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- End Course Title -->

                                    <div class="col-lg-6">
                                        <div class="mb-4">
                                            <div class="select-type-v2">
                                                <label for="select_category"
                                                    class="form-label">{{ __('select_category') }}</label>
                                                <select id="select_category" name="category_id"
                                                    data-route="{{ route('ajax.categories') }}"
                                                    placeholder="{{ __('select_category') }}"
                                                    class="multiple-select-1 form-select-lg rounded-0 mb-3"
                                                    aria-label=".form-select-lg example">
                                                    @if ($category)
                                                        <option value="{{ $category->id }}" selected>
                                                            {{ $category->title }}</option>
                                                    @endif
                                                </select>
                                                <div class="nk-block-des text-danger">
                                                    <p class="error">{{ $errors->first('category_id') }}</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- End Course Category -->

                                    <div class="col-lg-6">
                                        <div class="mb-4">
                                            <div class="select-type-v2">
                                                <label for="courseType" class="form-label">{{ __('course_type') }}</label>
                                                <select id="courseType" name="course_type"
                                                    class="form-select form-select-lg mb-3 without_search"
                                                    aria-label=".form-select-lg">
                                                    <option value="course"
                                                        {{ old('course_type') == 'course' ? 'selected' : '' }}>
                                                        {{ __('course') }}</option>
                                                    <option value="live_class"
                                                        {{ old('course_type') == 'live_class' ? 'selected' : '' }}>
                                                        {{ __('live_class') }}</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- End Course Type -->

                                    <div class="col-lg-6">
                                        <div class="mb-4">
                                            <div class="select-type-v2">
                                                <label for="language_id" class="form-label">{{ __('language') }}</label>
                                                <select id="language_id"
                                                    class="form-select form-select-lg mb-3 with_search"
                                                    name="language_id">
                                                    <option value="">{{ __('select_language') }}</option>
                                                    @foreach ($languages as $language)
                                                        <option value="{{ $language->id }}"
                                                            {{ old('language_id') == $language->id ? 'selected' : '' }}>
                                                            {{ $language->name }}</option>
                                                    @endforeach
                                                </select>
                                                <div class="nk-block-des text-danger">
                                                    <p class="error">{{ $errors->first('language_id') }}</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- End Language -->

                                    <div class="col-lg-6">
                                        <div class="mb-4">
                                            <div class="select-type-v2">
                                                <label for="select_subject"
                                                    class="form-label">{{ __('select_subject') }}</label>
                                                <select id="select_subject" name="subject_id"
                                                    placeholder="{{ __('select_subject') }}"
                                                    data-route="{{ route('ajax.subjects') }}"
                                                    class="multiple-select-1 form-select-lg rounded-0 mb-3"
                                                    aria-label=".form-select-lg example">
                                                    @if ($subject)
                                                        <option value="{{ $subject->id }}" selected>
                                                            {{ $subject->title }}</option>
                                                    @endif
                                                </select>
                                                <div class="nk-block-des text-danger">
                                                    <p class="error">{{ $errors->first('subject_id') }}</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- End Subject -->

                                    <div class="col-lg-6">
                                        <div class="mb-4">
                                            <div class="select-type-v2">
                                                <label for="courseLevel"
                                                    class="form-label">{{ __('course_level') }}</label>
                                                <select id="courseLevel"
                                                    class="form-select form-select-lg mb-3 with_search" name="level_id"
                                                    aria-label=".form-select-lg">
                                                    <option value="">{{ __('select_level') }}</option>
                                                    @foreach ($levels as $level)
                                                        <option value="{{ $level->id }}"
                                                            {{ old('level_id') == $level->id ? 'selected' : '' }}>
                                                            {{ $level->title }}</option>
                                                    @endforeach
                                                </select>
                                                <div class="nk-block-des text-danger">
                                                    <p class="error">{{ $errors->first('level_id') }}</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- End Level -->

                                    <div class="col-lg-6">
                                        <div class="mb-4">
                                            <div class="select-type-v2">
                                                <label for="ins_by_org"
                                                    class="form-label">{{ __('select_organization') }}</label>
                                                <select id="ins_by_org" name="organization_id"
                                                    data-route="{{ route('ajax.organizations') }}"
                                                    class="form-select-lg rounded-0 mb-3 with_search"
                                                    aria-label=".form-select-lg example"
                                                    data-url="{{ route('ajax.instructors') }}">
                                                    <option value="">{{ __('select_organization') }}</option>
                                                    @if ($organization)
                                                        <option value="{{ $organization->id }}" selected>
                                                            {{ $organization->org_name }}</option>
                                                    @endif
                                                </select>
                                                <div class="nk-block-des text-danger">
                                                    <p class="error">{{ $errors->first('organization_id') }}</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- End Organisation -->

                                    <div class="col-lg-6">
                                        <div class="mb-4">
                                            <div class="select-type-v2">
                                                <label for="instructor_ids"
                                                    class="form-label">{{ __('instructor') }}</label>
                                                <select id="instructor_ids" name="instructor_ids[]" multiple
                                                    class="form-select form-select-lg mb-3 without_search"
                                                    aria-label=".form-select-lg">
                                                    @foreach ($instructors as $instructor)
                                                        <option value="{{ $instructor->id }}"
                                                            {{ old('instructor_ids') && in_array($instructor->id, old('instructor_ids')) ? 'selected' : '' }}>
                                                            {{ $instructor->name }}</option>
                                                    @endforeach
                                                </select>
                                                <div class="nk-block-des text-danger">
                                                    <p class="error">{{ $errors->first('instructor_ids') }}</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- End Instructor -->

                                    <div class="col-lg-6">
                                        <div class="mb-4">
                                            <label for="courseDuration"
                                                class="form-label">{{ __('course_duration') }}</label>
                                            <input type="text" class="form-control rounded-2" id="courseDuration"
                                                name="duration" placeholder="{{ __('72_hours') }}"
                                                value="{{ old('duration') }}">
                                            <div class="nk-block-des text-danger">
                                                <p class="error">{{ $errors->first('duration') }}</p>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- End Course Duration -->
                                    <div class="col-lg-6">
                                        <div class="multi-select-v2 mb-4">
                                            <label for="tag" class="form-label">{{ __('course_tag') }}</label>
                                            <select id="tag" multiple
                                                class="form-select form-select-lg mb-3 with_search" name="tags[]"
                                                aria-label=".form-select-lg" placeholder="{{ __('select_tags') }}">
                                                @foreach ($tags as $tag)
                                                    <option value="{{ $tag->id }}"
                                                        {{ old('tags') && in_array($tag->id, old('tags')) ? 'selected' : '' }}>
                                                        {{ $tag->title }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <!-- End Course Tag -->

                                    <div class="col-lg-12">
                                        <div class="mb-4">
                                            <div class="d-flex justify-content-between">
                                                <label for="shortDescription"
                                                    class="form-label">{{ __('short_description') }}</label>
                                                @include('backend.common.ai_btn', [
                                                    'name' => 'ai_short_description',
                                                    'length' => '200',
                                                    'topic' => 'ai_content_name',
                                                    'use_case' => 'short description for course',
                                                ])
                                            </div>
                                            <textarea class="form-control ai_short_description" name="short_description" id="shortDescription"
                                                placeholder="{{ __('enter_short_description') }}">{{ old('short_description') }}</textarea>
                                        </div>
                                    </div>
                                    <!-- End Short Description -->

                                    <div class="col-lg-12">
                                        <div class="editor-wrapper">
                                            <div class="d-flex justify-content-between">
                                                <label class="form-label mb-1">{{ __('description') }}</label>
                                                @include('backend.common.ai_btn', [
                                                    'name' => 'ai_description',
                                                    'length' => '259',
                                                    'topic' => 'ai_content_name',
                                                    'use_case' => 'long description  for course',
                                                    'long_description' => 1,
                                                ])
                                            </div>
                                            <textarea id="product-update-editor" class="ai_description" name="description">{!! old('description') !!}</textarea>
                                        </div>

                                        <div class="custom-checkbox mt-12">
                                            <label>
                                                <input type="checkbox" value="1" name="is_private"
                                                    {{ old('is_private') == 1 ? 'checked' : '' }}>
                                                <span>{{ __('private_course') }}</span>
                                            </label>
                                        </div>
                                    </div>
                                    <!-- End Description -->

                                    <div class="col-lg-12">
                                        <div class="d-flex justify-content-end align-items-center mt-30">
                                            <a href="#" type="button" class="btn sg-btn-primary btn_action"
                                                data-bs-toggle="tab"
                                                data-bs-target="#mediaImages">{{ __('next') }}</a>
                                        </div>
                                    </div>
                                    <!-- End Next Page BTN -->
                                </div>
                            </div>
                            <!-- End Basic Course Information -->

                            <div class="tab-pane fade {{ $step_2_error ? 'show active' : '' }}" id="courseMediaImages"
                                role="tabpanel" aria-labelledby="mediaImages" tabindex="0">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="mb-4">
                                            <div class="select-type-v2">
                                                <label for="video_source"
                                                    class="form-label">{{ __('video_source') }}</label>
                                                <select id="video_source"
                                                    class="form-select form-select-lg mb-3 without_search"
                                                    name="video_source">
                                                    <option value="">{{ __('select_video_source') }}</option>
                                                    <option value="upload"
                                                        {{ old('video_source') == 'upload' ? 'selected' : '' }}>
                                                        {{ __('upload') }}</option>

                                                    <option value="youtube"
                                                        {{ old('video_source') == 'youtube' ? 'selected' : '' }}>
                                                        {{ __('youtube') }}</option>
                                                    <option value="vimeo"
                                                        {{ old('video_source') == 'vimeo' ? 'selected' : '' }}>
                                                        {{ __('vimeo') }}</option>
                                                    <option value="mp4"
                                                        {{ old('video_source') == 'mp4' ? 'selected' : '' }}>
                                                        {{ __('mp4') }}</option>
                                                </select>
                                                <div class="nk-block-des text-danger">
                                                    <p class="error">{{ $errors->first('video_source') }}</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- End Video Source -->
                                    <div
                                        class="col-lg-6 upload_div {{ old('video_source') == 'upload' ? '' : 'd-none' }}">
                                        <div class="mb-3">
                                            <label for="thumbnailFile"
                                                class="form-label">{{ __('upload_video') }}</label>
                                            <label for="thumbnailFile" class="file-upload-text">
                                                <p class="file_name">{{ __('video') }}</p>
                                                <span class="file-btn">{{ __('choose_file') }}</span>
                                            </label>
                                            <input class="d-none thumb_picker" name="video" type="file"
                                                id="thumbnailFile">
                                            <div class="nk-block-des text-danger">
                                                <p class="error">{{ $errors->first('video') }}</p>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- End Upload Video -->
                                    <div
                                        class="col-lg-6 video_link {{ old('video_source') && old('video_source') != 'upload' ? '' : 'd-none' }}">
                                        <div class="mb-4">
                                            <label for="videoLink" class="form-label">{{ __('video_link') }}</label>
                                            <input type="text" class="form-control rounded-2" name="video_link"
                                                id="videoLink" placeholder="{{ __('enter_video_link') }}"
                                                value="{{ old('video') }}">
                                            <div class="nk-block-des text-danger">
                                                <p class="error">{{ $errors->first('video_link') }}</p>
                                            </div>
                                        </div>
                                    </div>

                                    @include('backend.common.media-input', [
                                        'title' => 'Slider Image',
                                        'name' => 'image_media_id',
                                        'col' => 'col-12',
                                        'size' => '(402x248)',
                                        'image' => old('image_media_id'),
                                        'label' => __('thumbnail'),
                                    ])
                                    <div class="col-lg-6">
                                        <div class="custom-checkbox mt-20">
                                            <label>
                                                <input type="checkbox" value="1"
                                                    {{ old('is_downloadable') == 1 ? 'checked' : '' }}>
                                                <span class="">{{ __('downloadable') }}</span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="d-flex justify-content-between align-items-center mt-30">
                                            <a href="#" type="button"
                                                class="btn sg-btn-outline-primary btn_action" data-bs-toggle="tab"
                                                data-bs-target="#basicInformation">{{ __('back') }}</a>

                                            <a href="#" type="button" class="btn sg-btn-primary btn_action"
                                                data-bs-toggle="tab" data-bs-target="#pricing">{{ __('next') }}</a>
                                        </div>
                                    </div>
                                    <!-- End Next Page BTN -->
                                </div>
                            </div>
                            <!-- End Course Media Images -->

                            <div class="tab-pane fade {{ $step_3_error && !$step_2_error ? 'show active' : '' }}"
                                id="coursePricing" role="tabpanel" aria-labelledby="pricing" tabindex="0">
                                <div class="row gx-20">
                                    <div class="col-lg-6">
                                        <div class="price-checkbox d-flex gap-12 mb-4">
                                            <label for="is_free">{{ __('free_course') }}</label>
                                            <div class="setting-check">
                                                <input type="checkbox" id="is_free" name="is_free" value="1"
                                                    {{ old('is_free') == 1 ? 'checked' : '' }}>
                                                <label for="is_free"></label>
                                            </div>
                                        </div>
                                        <div
                                            class="price-checkbox d-flex gap-12 mb-4 not_free_div {{ old('is_free') == 1 ? 'd-none' : '' }}">
                                            <label for="discountable_course">{{ __('discountable_course') }}</label>
                                            <div class="setting-check">
                                                <input type="checkbox" id="discountable_course" name="is_discountable"
                                                    value="1" {{ old('is_discountable') == 1 ? 'checked' : '' }}>
                                                <label for="discountable_course"></label>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="col-lg-6"></div>
                                    <!-- End Price Checkbox -->

                                    <div class="col-lg-6 not_free_div {{ old('is_free') == 1 ? 'd-none' : '' }}">
                                        <div class="mb-4">
                                            <label for="coursePrice" class="form-label">{{ __('course_price') }}</label>
                                            <input type="number" class="form-control rounded-2" id="coursePrice"
                                                name="price" value="{{ old('price') }}"
                                                placeholder="{{ __('enter_course_price') }}">
                                            <div class="nk-block-des text-danger">
                                                <p class="error">{{ $errors->first('price') }}</p>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- End Course Price -->

                                    <div
                                        class="col-lg-6 discountable_div {{ old('is_discountable') == 1 ? '' : 'd-none' }}">
                                        <div class="">
                                            <label for="discountType" class="form-label">{{ __('discount') }}</label>

                                            <div class="customDiscountField">
                                                <input type="text" class="form-control rounded-2" placeholder="e.g.20"
                                                    id="discountType" name="discount" value="{{ old('discount') }}">

                                                <div class="select-type-v2 selectField">
                                                    <select class="form-select form-select-lg mb-3 without_search"
                                                        name="discount_type">
                                                        <option value="">{{ __('select_discount_type') }}</option>
                                                        <option value="percent"
                                                            {{ old('discount_type') == 'percent' ? 'selected' : 'd-none' }}>
                                                            {{ __('percent') }}</option>
                                                        <option value="amount"
                                                            {{ old('discount_type') == 'amount' ? 'selected' : 'd-none' }}>
                                                            {{ __('amount') }}</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="nk-block-des text-danger">
                                                <p class="error">{{ $errors->first('discount') }}</p>
                                            </div>
                                            <div class="nk-block-des text-danger">
                                                <p class="error">{{ $errors->first('discount_type') }}</p>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- End Discount Type -->

                                    <div
                                        class="col-lg-6 discountable_div {{ old('is_discountable') == 1 ? '' : 'd-none' }}">
                                        <div class="mb-20">
                                            <label for="dateRangePicker"
                                                class="form-label">{{ __('discount_period') }}</label>
                                            <input id="dateRangePicker" name="discount_period" type="text"
                                                class="form-control rounded-2" value="{{ old('discount_period') }}"
                                                placeholder="{{ __('select_date') }}">
                                            <div class="nk-block-des text-danger">
                                                <p class="dateRange_error error">{{ $errors->first('price') }}</p>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- End Date Range Picker -->

                                    <div class="col-lg-6 renewable_div {{ old('is_renewable') == 1 ? '' : 'd-none' }}">
                                        <div class="">
                                            <div class="select-type-v2">
                                                <label for="renew_after"
                                                    class="form-label">{{ __('access_validity') }}</label>
                                                <input type="number" class="form-control rounded-2" id="renew_after"
                                                    name="renew_after" value="{{ old('renew_after') }}"
                                                    placeholder="e.g.90">
                                                <div class="nk-block-des text-danger">
                                                    <p class="dateRange_error error">{{ $errors->first('renew_after') }}
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- End Access Validity -->

                                    <div class="col-lg-12">
                                        <div class="d-flex justify-content-between align-items-center mt-30">
                                            <a href="#" type="button"
                                                class="btn sg-btn-outline-primary btn_action" data-bs-toggle="tab"
                                                data-bs-target="#mediaImages">{{ __('back') }}</a>

                                            <a href="#" type="button" class="btn sg-btn-primary btn_action"
                                                data-bs-toggle="tab" data-bs-target="#seo">{{ __('next') }}</a>
                                        </div>
                                    </div>
                                    <!-- End Next Page BTN -->
                                </div>
                                <!-- End Product images section -->
                            </div>
                            <!-- End Course Pricing -->

                            <div class="tab-pane fade" id="courseSEO" role="tabpanel" aria-labelledby="seo"
                                tabindex="0">
                                <div class="row gx-20">
                                    @include('components.meta-fields', [
                                        'meta_title_class' => 'col-lg-6',
                                        'meta_description_class' => 'col-lg-12',
                                        'meta_keywords_class' => 'col-lg-6',
                                        'meta_image_class' => 'col-lg-12',
                                        'meta_title' => old('meta_title'),
                                        'meta_keywords' => old('meta_keywords'),
                                        'meta_description' => old('meta_description'),
                                        'meta_image' => old('meta_image'),
                                        'edit' => true,
                                    ])
                                    <div class="col-lg-12">
                                        <div class="d-flex justify-content-between align-items-center mt-30">
                                            <a href="#" class="btn sg-btn-outline-primary btn_action"
                                                data-bs-toggle="tab" data-bs-target="#pricing">{{ __('back') }}</a>
                                            <a href="#" class="btn sg-btn-primary btn_action"
                                                data-bs-toggle="tab" data-bs-target="#courseMasterclass">{{ __('next') }}</a>
                                        </div>
                                    </div>
                                    <!-- End Next Page BTN -->
                                </div>
                            </div>
                            <!-- End Course SEO -->

                            <!-- Start Masterclass Landing Tab -->
                            <div class="tab-pane fade" id="courseMasterclass" role="tabpanel" aria-labelledby="masterclass" tabindex="0">
                                <div class="row gx-20">
                                    <div class="col-12 mb-3">
                                        <h5 class="fw-bold text-dark border-bottom pb-2">Section Visibility & Headings</h5>
                                    </div>

                                    <div class="col-lg-4 col-md-6 mb-4">
                                        <label class="form-label fw-bold">Benefits Section Title</label>
                                        <input type="text" name="masterclass_settings[benefits_title]" class="form-control rounded-2"
                                               value="{{ old('masterclass_settings.benefits_title') }}" placeholder="এই মাস্টারক্লাস কার জন্য?">
                                    </div>

                                    <div class="col-lg-4 col-md-6 mb-4">
                                        <label class="form-label fw-bold">Registration Form Title</label>
                                        <input type="text" name="masterclass_settings[order_form_title]" class="form-control rounded-2"
                                               value="{{ old('masterclass_settings.order_form_title') }}" placeholder="মাস্টারক্লাসে জয়েন করতে নিচের ফর্মটি পূরণ করুন">
                                    </div>

                                    <div class="col-lg-4 col-md-6 mb-4">
                                        <label class="form-label fw-bold">FAQ Section Title</label>
                                        <input type="text" name="masterclass_settings[faq_title]" class="form-control rounded-2"
                                               value="{{ old('masterclass_settings.faq_title') }}" placeholder="কিছু সাধারণ প্রশ্নের উত্তর">
                                    </div>

                                    <div class="col-12 mb-4">
                                        <div class="d-flex gap-4 flex-wrap">
                                            <div class="form-check">
                                                <input type="checkbox" name="masterclass_settings[hide_special_gift]" value="1" class="form-check-input" id="create_hide_gift"
                                                    {{ old('masterclass_settings.hide_special_gift') == '1' ? 'checked' : '' }}>
                                                <label class="form-check-label fw-bold" for="create_hide_gift">Hide Special Gift Banner Card</label>
                                            </div>

                                            <div class="form-check">
                                                <input type="checkbox" name="masterclass_settings[hide_explainer]" value="1" class="form-check-input" id="create_hide_exp"
                                                    {{ old('masterclass_settings.hide_explainer') == '1' ? 'checked' : '' }}>
                                                <label class="form-check-label fw-bold" for="create_hide_exp">Hide Token Fee Explainer Box</label>
                                            </div>

                                            <div class="form-check">
                                                <input type="checkbox" name="masterclass_settings[hide_breakdown]" value="1" class="form-check-input" id="create_hide_bd"
                                                    {{ old('masterclass_settings.hide_breakdown') == '1' ? 'checked' : '' }}>
                                                <label class="form-check-label fw-bold" for="create_hide_bd">Hide Price Breakdown Table</label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-12 mb-3 mt-2">
                                        <h5 class="fw-bold text-dark border-bottom pb-2">Hero Header & Schedule Customization</h5>
                                    </div>

                                    <div class="col-lg-6 col-md-6 mb-4">
                                        <label class="form-label fw-bold">Eyebrow Badge Text</label>
                                        <input type="text" name="masterclass_settings[eyebrow_title]" class="form-control rounded-2"
                                               value="{{ old('masterclass_settings.eyebrow_title') }}" placeholder="E-commerce শুরু করার hidden path">
                                        <small class="text-muted">Displayed above the main course title on the landing page.</small>
                                    </div>

                                    <div class="col-lg-6 col-md-6 mb-4">
                                        <label class="form-label fw-bold">Live Schedule Headline</label>
                                        <input type="text" name="masterclass_settings[class_schedule_title]" class="form-control rounded-2"
                                               value="{{ old('masterclass_settings.class_schedule_title') }}" placeholder="২ দিনব্যাপী e-commerce live masterclass">
                                    </div>

                                    <div class="col-lg-6 col-md-6 mb-4">
                                        <label class="form-label fw-bold">Live Schedule Subtitle / Start Time</label>
                                        <input type="text" name="masterclass_settings[class_schedule_time]" class="form-control rounded-2"
                                               value="{{ old('masterclass_settings.class_schedule_time') }}" placeholder="৬ আগস্ট তারিখ রাত ৮ টায় শুরু">
                                    </div>

                                    <div class="col-lg-6 col-md-6 mb-4">
                                        <label class="form-label fw-bold">Urgency Seat Count (Remaining Seats)</label>
                                        <input type="text" name="masterclass_settings[remaining_seats]" class="form-control rounded-2"
                                               value="{{ old('masterclass_settings.remaining_seats') }}" placeholder="৭২">
                                        <small class="text-muted">Text/number displayed in the pulse seat urgency counter.</small>
                                    </div>

                                    <div class="col-12 mb-3 mt-3">
                                        <h5 class="fw-bold text-dark border-bottom pb-2">Special Bonus Gift Offer</h5>
                                    </div>

                                    <div class="col-lg-6 col-md-6 mb-4">
                                        <label class="form-label fw-bold">Gift Pill / Badge Text</label>
                                        <input type="text" name="masterclass_settings[gift_badge]" class="form-control rounded-2"
                                               value="{{ old('masterclass_settings.gift_badge') }}" placeholder="🎁 যারা join করবেন তাদের জন্য special gift">
                                    </div>

                                    <div class="col-lg-6 col-md-6 mb-4">
                                        <label class="form-label fw-bold">Gift Title</label>
                                        <input type="text" name="masterclass_settings[gift_title]" class="form-control rounded-2"
                                               value="{{ old('masterclass_settings.gift_title') }}" placeholder="৳১০,০০০ টাকার Ecom Dropshipping Mastery Course — সম্পূর্ণ FREE করার সুযোগ">
                                    </div>

                                    <div class="col-lg-6 col-md-6 mb-4">
                                        <label class="form-label fw-bold">Original Gift Value</label>
                                        <input type="text" name="masterclass_settings[gift_value]" class="form-control rounded-2"
                                               value="{{ old('masterclass_settings.gift_value') }}" placeholder="৳১০,০০০">
                                    </div>

                                    <div class="col-lg-12 col-md-12 mb-4">
                                        <label class="form-label fw-bold">Gift Description</label>
                                        <textarea name="masterclass_settings[gift_description]" class="form-control rounded-2" rows="3"
                                                  placeholder="এই master class-এ যারা join করবেন, তারা আমার ৳১০,০০০ টাকার Ecom Dropshipping Mastery Course টা free তে করার সুযোগ পাবেন...">{{ old('masterclass_settings.gift_description') }}</textarea>
                                    </div>

                                    <div class="col-lg-12 col-md-12 mb-4">
                                        <label class="form-label fw-bold">Gift Quote</label>
                                        <textarea name="masterclass_settings[gift_quote]" class="form-control rounded-2" rows="3"
                                                  placeholder="এই কোর্সে আমি ই-কমার্স বিজনেস, ডিজিটাল মার্কেটিং এর বিভিন্ন বিষয় যেমন Facebook Ads, Google Ads নিয়ে বিস্তারিত শিখিয়েছি...">{{ old('masterclass_settings.gift_quote') }}</textarea>
                                    </div>

                                    <div class="col-12 mb-3 mt-3">
                                        <h5 class="fw-bold text-dark border-bottom pb-2">Token Fee Explainer Section</h5>
                                    </div>

                                    <div class="col-lg-12 col-md-12 mb-4">
                                        <label class="form-label fw-bold">Explainer Heading Question</label>
                                        <input type="text" name="masterclass_settings[explainer_title]" class="form-control rounded-2"
                                               value="{{ old('masterclass_settings.explainer_title') }}" placeholder="একটা প্রশ্ন আপনার মাথায় আসতে পারে — এত কিছু, মাত্র ৯৯ টাকায় কেন??">
                                    </div>

                                    <div class="col-lg-12 col-md-12 mb-4">
                                        <label class="form-label fw-bold">Explainer Content</label>
                                        <textarea name="masterclass_settings[explainer_text]" class="form-control rounded-2 summernote" rows="5">{{ old('masterclass_settings.explainer_text') }}</textarea>
                                    </div>

                                    <div class="col-12 mb-3 mt-3">
                                        <h5 class="fw-bold text-dark border-bottom pb-2">Price Breakdown Table Items</h5>
                                    </div>

                                    <div class="col-lg-12 col-md-12 mb-4">
                                        <label class="form-label fw-bold">Breakdown Items (One per line: Item Name | Estimated Value)</label>
                                        <textarea name="masterclass_settings[breakdown_items]" class="form-control rounded-2" rows="4"
                                                  placeholder="🎓 ২ দিনের live masterclass — সম্পূর্ণ roadmap সহ | ৳৩,০০০&#10;🎁 Ecom Dropshipping Mastery Course free পাওয়ার সুযোগ | ৳১০,০০০">{{ old('masterclass_settings.breakdown_items') }}</textarea>
                                        <small class="text-muted">Enter each bonus line in the format: <code>Item Title | Price Value</code></small>
                                    </div>

                                    <div class="col-lg-12">
                                        <div class="d-flex justify-content-between align-items-center mt-30">
                                            <a href="#" class="btn sg-btn-outline-primary btn_action" data-bs-toggle="tab" data-bs-target="#courseSEO">{{ __('back') }}</a>
                                            <button type="submit" class="btn sg-btn-primary">{{ __('submit') }}</button>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <!-- End Masterclass Landing Tab -->
                        </div>
                    </form>
                </div>
                <!-- End Default Tab List -->

            </div>
        </div>
    </div>
    @include('backend.common.gallery-modal')
@endsection
@push('css_asset')
    <link rel="stylesheet" href="{{ static_asset('admin/css/dropzone.min.css') }}">
    <link rel="stylesheet" href="{{ static_asset('admin/css/daterangepicker.css') }}">
@endpush
@push('js_asset')
    <!--====== media.js ======-->
    <script src="{{ static_asset('admin/js/dropzone.min.js') }}"></script>
    <script src="{{ static_asset('admin/js/moment.min.js') }}"></script>
    <script src="{{ static_asset('admin/js/daterangepicker.js') }}"></script>
@endpush
@push('js')
    <script src="{{ static_asset('admin/js/media.js') }}"></script>
    <script src="{{ static_asset('admin/js/ai_writer.js') }}"></script>

    <script>
        $(document).ready(function() {
            $('#dateRangePicker').daterangepicker({
                autoUpdateInput: false
            });

            searchCategory($('#select_category'));
            searchSubjects($('#select_subject'));
            searchOrganization($('#ins_by_org'));
            $(document).on('click', "#mgCourse-tabContent a.btn_action", function() {
                const triggerTab = $(this).data('bs-target');
                const tabInstance = new bootstrap.Tab(triggerTab)
                tabInstance.show()
            });
            $(document).on('change', "#video_source", function() {
                let video_source = $(this).val();

                if (!video_source) {
                    $('.video_link').addClass('d-none');
                    $('.upload_div').addClass('d-none');
                } else if (video_source == 'upload') {
                    $('.video_link').addClass('d-none');
                    $('.upload_div').removeClass('d-none');
                } else {
                    $('.video_link').removeClass('d-none');
                    $('.upload_div').addClass('d-none');
                }
            });
            $(document).on('change', "#is_free", function() {
                let is_free = $(this).is(':checked');

                if (is_free) {
                    $('.not_free_div').addClass('d-none');
                    $('.discountable_div').addClass('d-none');
                    $('.renewable_div').addClass('d-none');
                    $("#discountable_course").prop('checked', false);
                } else {
                    $('.not_free_div').removeClass('d-none');
                }
            });
            $(document).on('change', "#discountable_course", function() {
                let is_discountable = $(this).is(':checked');
                if (is_discountable) {
                    $('.discountable_div').removeClass('d-none');
                } else {
                    $('.discountable_div').addClass('d-none');
                }
            });
        });
    </script>
@endpush

