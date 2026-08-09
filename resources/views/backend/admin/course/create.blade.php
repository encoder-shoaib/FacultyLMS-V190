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
                                                data-bs-target="#courseMediaImages">{{ __('next') }}</a>
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
                                                class="btn sg-btn-outline-primary btn_action"
                                                data-bs-target="#basicCourseInformation">{{ __('back') }}</a>

                                            <a href="#" type="button" class="btn sg-btn-primary btn_action"
                                                data-bs-target="#coursePricing">{{ __('next') }}</a>
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
                                                class="btn sg-btn-outline-primary btn_action"
                                                data-bs-target="#courseMediaImages">{{ __('back') }}</a>

                                            <a href="#" type="button" class="btn sg-btn-primary btn_action"
                                                data-bs-target="#courseSEO">{{ __('next') }}</a>
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
                                            <a href="#" type="button"
                                                class="btn sg-btn-outline-primary btn_action"
                                                data-bs-target="#coursePricing">{{ __('back') }}</a>

                                            <a href="#" type="button" class="btn sg-btn-primary btn_action"
                                                data-bs-target="#courseMasterclass">{{ __('next') }}</a>
                                        </div>
                                    </div>
                                    <!-- End Next Page BTN -->
                                </div>
                            </div>
                            <!-- End Course SEO -->

                            <!-- Start Masterclass Landing Tab -->
                            <div class="tab-pane fade" id="courseMasterclass" role="tabpanel" aria-labelledby="masterclass" tabindex="0">
                                @php
                                    $defEyebrow = old('masterclass_settings.eyebrow_title', 'E-commerce শুরু করার hidden path');
                                    $defPrimaryCta = old('masterclass_settings.primary_cta_text', 'রেজিস্ট্রেশন করুন এখনই');
                                    $defVideoCaption = old('masterclass_settings.video_caption', 'বিস্তারিত জানতে ভিডিওটি দেখুন');
                                    $defRemainingSeats = old('masterclass_settings.remaining_seats', '72');

                                    $defGoldBadgeTop = old('masterclass_settings.gold_badge_top', 'এখনই সিট বুক করুন');
                                    $defZoomTitle = old('masterclass_settings.zoom_title', 'Zoom লাইভ 104');
                                    $defZoomSubtitle = old('masterclass_settings.zoom_subtitle', 'অনলাইন ইন্টারেক্টিভ সেশন');
                                    $defScheduleLabel = old('masterclass_settings.schedule_label', 'সময় / সময়সূচী');
                                    $defScheduleValue = old('masterclass_settings.schedule_value', '2h 40min');
                                    $defLevelLabel = old('masterclass_settings.level_label', 'Level');
                                    $defLevelValue = old('masterclass_settings.level_value', 'beginner');
                                    $defGoldOfferTitle = old('masterclass_settings.gold_offer_title', 'আজকের স্পেশাল অফার');
                                    $defOriginalPriceLabel = old('masterclass_settings.original_price_label', 'মূল প্রাইস');
                                    $defGoldCtaText = old('masterclass_settings.gold_cta_text', 'এখনই জয়েন করুন');
                                    $defGoldSeatsText = old('masterclass_settings.gold_seats_text', 'আর মাত্র 72 সিট বাকি');

                                    $defBenefitsTitle = old('masterclass_settings.benefits_title', 'এই মাস্টারক্লাস কার জন্য?');
                                    $benefitsList = old('masterclass_settings.benefits_list', [
                                        'অনলাইন বিজনেস করতে চান কিন্তু কনফিউজড',
                                        'পুঁজি কম নিয়ে বিজনেস শুরু করতে চাচ্ছেন',
                                        'ই-কমার্স বিজনেস শুরু করার ভয় আছে',
                                        'লস না করে সঠিকভাবে শুরু করতে চান',
                                    ]);

                                    $defGiftBadge = old('masterclass_settings.gift_badge', '🎁 যারা join করবেন তাদের জন্য special gift');
                                    $defGiftTitle = old('masterclass_settings.gift_title', '৳১০,০০০ টাকার Ecom Dropshipping Mastery Course — সম্পূর্ণ FREE করার সুযোগ');
                                    $defGiftValue = old('masterclass_settings.gift_value', '৳১০,০০০');
                                    $defGiftDescription = old('masterclass_settings.gift_description', 'এই master class-এ যারা join করবেন, তারা আমার ৳১০,০০০ টাকার Ecom Dropshipping Mastery Course টা free তে করার সুযোগ পাবেন। মাস্টারক্লাসে এই বিষয়ে বিস্তারিত আলোচনা।');
                                    $defGiftQuote = old('masterclass_settings.gift_quote', '"এই কোর্সে আমি ই-কমার্স বিজনেস, ডিজিটাল মার্কেটিং এর বিভিন্ন বিষয় যেমন Facebook Ads, Google Ads নিয়ে বিস্তারিত শিখিয়েছি। এছাড়াও কিভাবে একটা বিজনেসকে Scale করতে তা নিয়ে ক্লাস আছে।"');
                                    $defGiftFooterNote = old('masterclass_settings.gift_footer_note', 'যারা একদম নতুন আছেন তারাও এই কোর্স থেকে বেনিফিটেড হতে পারবে।');
                                    $defGiftCtaText = old('masterclass_settings.gift_cta_text', 'সিট কনফার্ম করুন →');

                                    $defScheduleBadge = old('masterclass_settings.schedule_badge', 'LIVE ZOOM MASTERCLASS');
                                    $defClassScheduleTitle = old('masterclass_settings.class_schedule_title', '২ দিনব্যাপী e-commerce live masterclass');
                                    $defClassScheduleTime = old('masterclass_settings.class_schedule_time', '৬ আগস্ট তারিখ রাত ৮ টায় শুরু');

                                    $defExplainerTitle = old('masterclass_settings.explainer_title', 'একটা প্রশ্ন আপনার মাথায় আসতে পারে — এত কিছু, মাত্র ৯৯ টাকায় কেন??');
                                    $defExplainerText = old('masterclass_settings.explainer_text', '<p>টু বি অনেস্ট, আমি এই masterclass-টা সম্পূর্ণ free করাতে চেয়েছিলাম।</p><p>কিন্তু problem হচ্ছে — আমার free session-গুলোতে দেখা যায় কয়েক হাজার মানুষ register করে বা join করে। যেহেতু এই session-টা Zoom-এ live হবে, তাই আমি চাইলেও এখানে বেশি মানুষ নিতে পারব না। Seat limit থাকবে।</p><p>তাই আমি এখানে ছোট্ট একটা token amount রেখেছি — শুধু audience filter করার জন্য। যেন এই masterclass-এ তারাই join করে, যারা সত্যিই e-commerce business শুরু করার ব্যাপারে serious এবং step-by-step process-টা মনোযোগ দিয়ে শিখতে ready।</p>');

                                    $defBreakdownSubheading = old('masterclass_settings.breakdown_subheading', 'এই $15.00 টাকায় আপনি পাচ্ছেন:');
                                    $defBreakdownTodayTitle = old('masterclass_settings.breakdown_today_title', 'আজকের মূল্য (token)');
                                    $defBreakdownItems = old('masterclass_settings.breakdown_items', "🎓 ২ দিনের live masterclass — সম্পূর্ণ roadmap সহ | ৳৩,০০০\n🎁 Ecom Dropshipping Mastery Course free পাওয়ার সুযোগ | ৳১০,০০০");

                                    $defOrderFormTitle = old('masterclass_settings.order_form_title', 'মাস্টারক্লাসে জয়েন করতে নিচের ফর্মটি পূরণ করুন');
                                    $defOrderFormSubtitle = old('masterclass_settings.order_form_subtitle', 'Give valid information');
                                    $defNameLabel = old('masterclass_settings.name_label', 'Your Full Name');
                                    $defNamePlaceholder = old('masterclass_settings.name_placeholder', 'আপনার সম্পূর্ণ নাম');
                                    $defPhoneLabel = old('masterclass_settings.phone_label', 'Mobile Number');
                                    $defPhonePlaceholder = old('masterclass_settings.phone_placeholder', '01XXXXXXXXX');
                                    $defEmailLabel = old('masterclass_settings.email_label', 'Email address');
                                    $defEmailPlaceholder = old('masterclass_settings.email_placeholder', 'আপনার ইমেইল এড্রেস');
                                    $defOrderSummaryTitle = old('masterclass_settings.order_summary_title', 'Your order');
                                    $defPayNowBtnText = old('masterclass_settings.pay_now_btn_text', 'PAY NOW');
                                    $defPrivacyNotice = old('masterclass_settings.privacy_notice', 'Your personal data will be used to process your order, support your experience throughout this website, and for other purposes described in our privacy policy.');

                                    $defFaqTitle = old('masterclass_settings.faq_title', 'কিছু সাধারণ প্রশ্নের উত্তর');
                                    $faqList = old('masterclass_settings.faq_list', [
                                        ['question' => 'লাইভ ক্লাসে কিভাবে যুক্ত হবো?', 'answer' => 'আপনি পেমেন্ট করার পর আপনাকে আমাদের একটা প্রাইভেট গ্রুপে জয়েন করানো হবে, এবং যেদিন লাইভ ক্লাসগুলো হবে সেদিন আপনাকে জুমের লিংক শেয়ার করা হবে'],
                                        ['question' => 'লাইভ ক্লাসগুলো কত ঘন্টার হবে?', 'answer' => 'এইটা সঠিক ভাবে বলা যাচ্ছে না, যে টাইম দেয়া আছে ঠিক সেই সময়েই শুরু হবে কিন্তু শেষ হবে আপনাদের ইচ্ছায়। যতক্ষণ আপনাদের প্রয়োজন আমি লাইভে থাকবো ইনশাআল্লাহ্'],
                                        ['question' => 'মাষ্টার ক্লাসটিতে ডিস্কাউন্ট দেয়া যাবে না?', 'answer' => 'বর্তমানে বিশাল ডিস্কাউন্ট দেয়া আছে তবে প্রতিনিয়ত প্রোগ্রামটির মূল্য কিছু কিছু করে বাড়ানো হবে। তাই যত দ্রুত যুক্ত হবেন তত বেশি আপনারই লাভ।'],
                                    ]);

                                    $defDualCtaLeft = old('masterclass_settings.dual_cta_left', 'রেজিস্ট্রেশন করুন এখনই');
                                    $defDualCtaSeats = old('masterclass_settings.dual_cta_seats', 'আর মাত্র ' . $defRemainingSeats . ' সিট বাকি');
                                @endphp

                                <div class="masterclass-single-page-wrapper bg-light p-4 rounded-3 border mb-4">
                                    <div class="d-flex align-items-center justify-content-between mb-4 border-bottom pb-3">
                                        <div>
                                            <h4 class="fw-bold text-dark mb-1"><i class="fas fa-magic text-primary me-2"></i> Masterclass Landing Page Full Section Editor</h4>
                                            <p class="text-muted small m-0">Edit every single text, title, and section of your landing page on this single page. Scroll down to customize all sections.</p>
                                        </div>
                                        <div class="d-flex gap-2">
                                            <button type="submit" class="btn sg-btn-primary py-2 px-4"><i class="fas fa-save me-1"></i> {{ __('save') }}</button>
                                        </div>
                                    </div>

                                    <!-- Section 1: Hero Header -->
                                    <div class="card border mb-4 rounded-3 shadow-sm">
                                        <div class="card-header bg-white py-3">
                                            <h5 class="fw-bold text-dark m-0"><span class="badge bg-primary me-2">Section 1</span> Hero Header & Video Media</h5>
                                        </div>
                                        <div class="card-body p-4">
                                            <div class="row gx-20">
                                                <div class="col-lg-6 col-md-6 mb-4">
                                                    <label class="form-label fw-bold"><i class="fas fa-tag text-muted me-1"></i> Eyebrow Golden Badge Text</label>
                                                    <input type="text" name="masterclass_settings[eyebrow_title]" class="form-control rounded-2"
                                                           value="{{ $defEyebrow }}" placeholder="E-commerce শুরু করার hidden path">
                                                    <small class="text-muted">Displayed inside top golden pill badge above course title.</small>
                                                </div>
                                                <div class="col-lg-6 col-md-6 mb-4">
                                                    <label class="form-label fw-bold"><i class="fas fa-mouse-pointer text-muted me-1"></i> Primary CTA Button Text</label>
                                                    <input type="text" name="masterclass_settings[primary_cta_text]" class="form-control rounded-2"
                                                           value="{{ $defPrimaryCta }}" placeholder="রেজিস্ট্রেশন করুন এখনই">
                                                </div>
                                                <div class="col-lg-6 col-md-6 mb-4">
                                                    <label class="form-label fw-bold"><i class="fas fa-video text-muted me-1"></i> Video Box Instruction Caption</label>
                                                    <input type="text" name="masterclass_settings[video_caption]" class="form-control rounded-2"
                                                           value="{{ $defVideoCaption }}" placeholder="বিস্তারিত জানতে ভিডিওটি দেখুন">
                                                </div>
                                                <div class="col-lg-6 col-md-6 mb-4">
                                                    <label class="form-label fw-bold"><i class="fas fa-users text-muted me-1"></i> Urgency Remaining Seats Count</label>
                                                    <input type="text" name="masterclass_settings[remaining_seats]" class="form-control rounded-2"
                                                           value="{{ $defRemainingSeats }}" placeholder="৭২">
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Section 2: Gold Info Card -->
                                    <div class="card border mb-4 rounded-3 shadow-sm">
                                        <div class="card-header bg-white py-3">
                                            <h5 class="fw-bold text-dark m-0"><span class="badge bg-primary me-2">Section 2</span> Gold Border Info Card</h5>
                                        </div>
                                        <div class="card-body p-4">
                                            <div class="row gx-20">
                                                <div class="col-lg-4 col-md-6 mb-4">
                                                    <label class="form-label fw-bold">Top Gold Offer Badge Text</label>
                                                    <input type="text" name="masterclass_settings[gold_badge_top]" class="form-control rounded-2"
                                                           value="{{ $defGoldBadgeTop }}" placeholder="এখনই সিট বুক করুন">
                                                </div>
                                                <div class="col-lg-4 col-md-6 mb-4">
                                                    <label class="form-label fw-bold">Zoom Title</label>
                                                    <input type="text" name="masterclass_settings[zoom_title]" class="form-control rounded-2"
                                                           value="{{ $defZoomTitle }}" placeholder="Zoom লাইভ 104">
                                                </div>
                                                <div class="col-lg-4 col-md-6 mb-4">
                                                    <label class="form-label fw-bold">Zoom Subtitle</label>
                                                    <input type="text" name="masterclass_settings[zoom_subtitle]" class="form-control rounded-2"
                                                           value="{{ $defZoomSubtitle }}" placeholder="অনলাইন ইন্টারেক্টিভ সেশন">
                                                </div>
                                                <div class="col-lg-4 col-md-6 mb-4">
                                                    <label class="form-label fw-bold">Schedule Label</label>
                                                    <input type="text" name="masterclass_settings[schedule_label]" class="form-control rounded-2"
                                                           value="{{ $defScheduleLabel }}" placeholder="সময় / সময়সূচী">
                                                </div>
                                                <div class="col-lg-4 col-md-6 mb-4">
                                                    <label class="form-label fw-bold">Schedule Value</label>
                                                    <input type="text" name="masterclass_settings[schedule_value]" class="form-control rounded-2"
                                                           value="{{ $defScheduleValue }}" placeholder="2h 40min">
                                                </div>
                                                <div class="col-lg-4 col-md-6 mb-4">
                                                    <label class="form-label fw-bold">Level Label</label>
                                                    <input type="text" name="masterclass_settings[level_label]" class="form-control rounded-2"
                                                           value="{{ $defLevelLabel }}" placeholder="Level">
                                                </div>
                                                <div class="col-lg-4 col-md-6 mb-4">
                                                    <label class="form-label fw-bold">Level Value</label>
                                                    <input type="text" name="masterclass_settings[level_value]" class="form-control rounded-2"
                                                           value="{{ $defLevelValue }}" placeholder="beginner">
                                                </div>
                                                <div class="col-lg-4 col-md-6 mb-4">
                                                    <label class="form-label fw-bold">Gold Offer Highlight Title</label>
                                                    <input type="text" name="masterclass_settings[gold_offer_title]" class="form-control rounded-2"
                                                           value="{{ $defGoldOfferTitle }}" placeholder="আজকের স্পেশাল অফার">
                                                </div>
                                                <div class="col-lg-4 col-md-6 mb-4">
                                                    <label class="form-label fw-bold">Original Price Label</label>
                                                    <input type="text" name="masterclass_settings[original_price_label]" class="form-control rounded-2"
                                                           value="{{ $defOriginalPriceLabel }}" placeholder="মূল প্রাইস">
                                                </div>
                                                <div class="col-lg-6 col-md-6 mb-4">
                                                    <label class="form-label fw-bold">Gold Card CTA Button Text</label>
                                                    <input type="text" name="masterclass_settings[gold_cta_text]" class="form-control rounded-2"
                                                           value="{{ $defGoldCtaText }}" placeholder="এখনই জয়েন করুন">
                                                </div>
                                                <div class="col-lg-6 col-md-6 mb-4">
                                                    <label class="form-label fw-bold">Gold Card Remaining Seats Text</label>
                                                    <input type="text" name="masterclass_settings[gold_seats_text]" class="form-control rounded-2"
                                                           value="{{ $defGoldSeatsText }}" placeholder="আর মাত্র 72 সিট বাকি">
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Section 3: Benefits & Target Audience -->
                                    <div class="card border mb-4 rounded-3 shadow-sm">
                                        <div class="card-header bg-white py-3 d-flex align-items-center justify-content-between">
                                            <h5 class="fw-bold text-dark m-0"><span class="badge bg-primary me-2">Section 3</span> Benefits & Target Audience Section</h5>
                                            <button type="button" class="button-default" id="add_new_benefit_btn">
                                                Add New Benefit Point <i class="las la-plus ms-1"></i>
                                            </button>
                                        </div>
                                        <div class="card-body p-4">
                                            <div class="mb-4">
                                                <label class="form-label fw-bold">Benefits Section Heading</label>
                                                <input type="text" name="masterclass_settings[benefits_title]" class="form-control rounded-2"
                                                       value="{{ $defBenefitsTitle }}" placeholder="এই মাস্টারক্লাস কার জন্য?">
                                            </div>

                                            <label class="form-label fw-bold text-dark mb-2">Benefit Points (এই মাস্টারক্লাস কার কার জন্য)</label>
                                            <div id="benefits_items_container">
                                                @foreach($benefitsList as $bIdx => $bItem)
                                                    <div class="benefit-single-item d-flex align-items-center gap-2 mb-3">
                                                        <span class="badge bg-secondary p-2"><i class="fas fa-check"></i> #<span class="benefit-num">{{ $bIdx + 1 }}</span></span>
                                                        <input type="text" name="masterclass_settings[benefits_list][]" class="form-control rounded-2 bg-white"
                                                               value="{{ $bItem }}" placeholder="সুবিধা / পয়েন্টটি লিখুন...">
                                                        <button type="button" class="btn btn-outline-danger remove-benefit-btn px-3">
                                                            <i class="fas fa-trash-alt"></i>
                                                        </button>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Section 4: Special Bonus Gift Offer -->
                                    <div class="card border mb-4 rounded-3 shadow-sm">
                                        <div class="card-header bg-white py-3">
                                            <h5 class="fw-bold text-dark m-0"><span class="badge bg-primary me-2">Section 4</span> Special Bonus Gift Offer Section</h5>
                                        </div>
                                        <div class="card-body p-4">
                                            <div class="row gx-20">
                                                <div class="col-12 mb-4">
                                                    <div class="form-check">
                                                        <input type="checkbox" name="masterclass_settings[hide_special_gift]" value="1" class="form-check-input" id="create_hide_gift"
                                                            {{ old('masterclass_settings.hide_special_gift') == '1' ? 'checked' : '' }}>
                                                        <label class="form-check-label fw-bold" for="create_hide_gift">Hide Special Gift Banner Card</label>
                                                    </div>
                                                </div>

                                                <div class="col-lg-6 col-md-6 mb-4">
                                                    <label class="form-label fw-bold">Gift Pill / Badge Text</label>
                                                    <input type="text" name="masterclass_settings[gift_badge]" class="form-control rounded-2"
                                                           value="{{ $defGiftBadge }}" placeholder="🎁 যারা join করবেন তাদের জন্য special gift">
                                                </div>

                                                <div class="col-lg-6 col-md-6 mb-4">
                                                    <label class="form-label fw-bold">Gift Title</label>
                                                    <input type="text" name="masterclass_settings[gift_title]" class="form-control rounded-2"
                                                           value="{{ $defGiftTitle }}" placeholder="৳১০,০০০ টাকার Ecom Dropshipping Mastery Course — সম্পূর্ণ FREE করার সুযোগ">
                                                </div>

                                                <div class="col-lg-6 col-md-6 mb-4">
                                                    <label class="form-label fw-bold">Original Gift Value</label>
                                                    <input type="text" name="masterclass_settings[gift_value]" class="form-control rounded-2"
                                                           value="{{ $defGiftValue }}" placeholder="৳১০,০০০">
                                                </div>

                                                <div class="col-lg-12 col-md-12 mb-4">
                                                    <label class="form-label fw-bold">Gift Description</label>
                                                    <textarea name="masterclass_settings[gift_description]" class="form-control rounded-2" rows="3"
                                                              placeholder="এই master class-এ যারা join করবেন, তারা আমার ৳১০,০০০ টাকার Ecom Dropshipping Mastery Course টা free তে করার সুযোগ পাবেন...">{{ $defGiftDescription }}</textarea>
                                                </div>

                                                <div class="col-lg-12 col-md-12 mb-4">
                                                    <label class="form-label fw-bold">Gift Quote Callout Box</label>
                                                    <textarea name="masterclass_settings[gift_quote]" class="form-control rounded-2" rows="3"
                                                              placeholder="এই কোর্সে আমি ই-কমার্স বিজনেস, ডিজিটাল মার্কেটিং এর বিভিন্ন বিষয় নিয়ে আলোচনা করেছি...">{{ $defGiftQuote }}</textarea>
                                                </div>

                                                <div class="col-lg-6 col-md-6 mb-4">
                                                    <label class="form-label fw-bold">Gift Footer Note Text</label>
                                                    <input type="text" name="masterclass_settings[gift_footer_note]" class="form-control rounded-2"
                                                           value="{{ $defGiftFooterNote }}" placeholder="যারা একদম নতুন আছেন তারাও এই কোর্স থেকে বেনিফিটেড হতে পারবে।">
                                                </div>

                                                <div class="col-lg-6 col-md-6 mb-4">
                                                    <label class="form-label fw-bold">Gift Red CTA Button Text</label>
                                                    <input type="text" name="masterclass_settings[gift_cta_text]" class="form-control rounded-2"
                                                           value="{{ $defGiftCtaText }}" placeholder="সিট কনফার্ম করুন →">
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Section 5: Live Schedule & Progress Bar -->
                                    <div class="card border mb-4 rounded-3 shadow-sm">
                                        <div class="card-header bg-white py-3">
                                            <h5 class="fw-bold text-dark m-0"><span class="badge bg-primary me-2">Section 5</span> Live Schedule & Progress Bar Section</h5>
                                        </div>
                                        <div class="card-body p-4">
                                            <div class="row gx-20">
                                                <div class="col-lg-4 col-md-6 mb-4">
                                                    <label class="form-label fw-bold">Schedule Pill Badge Text</label>
                                                    <input type="text" name="masterclass_settings[schedule_badge]" class="form-control rounded-2"
                                                           value="{{ $defScheduleBadge }}" placeholder="LIVE ZOOM MASTERCLASS">
                                                </div>

                                                <div class="col-lg-4 col-md-6 mb-4">
                                                    <label class="form-label fw-bold">Live Schedule Headline</label>
                                                    <input type="text" name="masterclass_settings[class_schedule_title]" class="form-control rounded-2"
                                                           value="{{ $defClassScheduleTitle }}" placeholder="২ দিনব্যাপী e-commerce live masterclass">
                                                </div>

                                                <div class="col-lg-4 col-md-6 mb-4">
                                                    <label class="form-label fw-bold">Live Schedule Subtitle / Start Time</label>
                                                    <input type="text" name="masterclass_settings[class_schedule_time]" class="form-control rounded-2"
                                                           value="{{ $defClassScheduleTime }}" placeholder="৬ আগস্ট তারিখ রাত ৮ টায় শুরু">
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Section 6: Token Fee Explainer Box -->
                                    <div class="card border mb-4 rounded-3 shadow-sm">
                                        <div class="card-header bg-white py-3">
                                            <h5 class="fw-bold text-dark m-0"><span class="badge bg-primary me-2">Section 6</span> Token Fee Explainer Box</h5>
                                        </div>
                                        <div class="card-body p-4">
                                            <div class="row gx-20">
                                                <div class="col-12 mb-4">
                                                    <div class="form-check">
                                                        <input type="checkbox" name="masterclass_settings[hide_explainer]" value="1" class="form-check-input" id="create_hide_exp"
                                                            {{ old('masterclass_settings.hide_explainer') == '1' ? 'checked' : '' }}>
                                                        <label class="form-check-label fw-bold" for="create_hide_exp">Hide Token Fee Explainer Box</label>
                                                    </div>
                                                </div>

                                                <div class="col-lg-12 col-md-12 mb-4">
                                                    <label class="form-label fw-bold">Explainer Heading Question</label>
                                                    <input type="text" name="masterclass_settings[explainer_title]" class="form-control rounded-2"
                                                           value="{{ $defExplainerTitle }}" placeholder="একটা প্রশ্ন আপনার মাথায় আসতে পারে — এত কিছু, মাত্র ৯৯ টাকায় কেন??">
                                                </div>

                                                <div class="col-lg-12 col-md-12 mb-4">
                                                    <label class="form-label fw-bold">Explainer Content (WYSIWYG Rich Text)</label>
                                                    <textarea name="masterclass_settings[explainer_text]" class="form-control rounded-2 summernote" rows="5">{{ $defExplainerText }}</textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Section 7: Price Breakdown Table -->
                                    <div class="card border mb-4 rounded-3 shadow-sm">
                                        <div class="card-header bg-white py-3">
                                            <h5 class="fw-bold text-dark m-0"><span class="badge bg-primary me-2">Section 7</span> Price Breakdown Table</h5>
                                        </div>
                                        <div class="card-body p-4">
                                            <div class="row gx-20">
                                                <div class="col-12 mb-4">
                                                    <div class="form-check">
                                                        <input type="checkbox" name="masterclass_settings[hide_breakdown]" value="1" class="form-check-input" id="create_hide_bd"
                                                            {{ old('masterclass_settings.hide_breakdown') == '1' ? 'checked' : '' }}>
                                                        <label class="form-check-label fw-bold" for="create_hide_bd">Hide Price Breakdown Table</label>
                                                    </div>
                                                </div>

                                                <div class="col-lg-6 col-md-6 mb-4">
                                                    <label class="form-label fw-bold">Breakdown Subheading Text</label>
                                                    <input type="text" name="masterclass_settings[breakdown_subheading]" class="form-control rounded-2"
                                                           value="{{ $defBreakdownSubheading }}" placeholder="এই $15.00 টাকায় আপনি পাচ্ছেন:">
                                                </div>

                                                <div class="col-lg-6 col-md-6 mb-4">
                                                    <label class="form-label fw-bold">Today Token Price Table Title</label>
                                                    <input type="text" name="masterclass_settings[breakdown_today_title]" class="form-control rounded-2"
                                                           value="{{ $defBreakdownTodayTitle }}" placeholder="আজকের মূল্য (token)">
                                                </div>

                                                <div class="col-lg-12 col-md-12 mb-4">
                                                    <label class="form-label fw-bold">Breakdown Items (Format: Item Title | Price Value)</label>
                                                    <textarea name="masterclass_settings[breakdown_items]" class="form-control rounded-2" rows="4"
                                                              placeholder="🎓 ২ দিনের live masterclass — সম্পূর্ণ roadmap সহ | ৳৩,০০০&#10;🎁 Ecom Dropshipping Mastery Course free পাওয়ার সুযোগ | ৳১০,০০০">{{ $defBreakdownItems }}</textarea>
                                                    <small class="text-muted">Enter one item per line using pipe separator: <code>Item Title | Price Value</code></small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Section 8: Registration Order Form -->
                                    <div class="card border mb-4 rounded-3 shadow-sm">
                                        <div class="card-header bg-white py-3">
                                            <h5 class="fw-bold text-dark m-0"><span class="badge bg-primary me-2">Section 8</span> Registration Order Form Section</h5>
                                        </div>
                                        <div class="card-body p-4">
                                            <div class="row gx-20">
                                                <div class="col-lg-6 col-md-6 mb-4">
                                                    <label class="form-label fw-bold">Registration Form Title</label>
                                                    <input type="text" name="masterclass_settings[order_form_title]" class="form-control rounded-2"
                                                           value="{{ $defOrderFormTitle }}" placeholder="মাস্টারক্লাসে জয়েন করতে নিচের ফর্মটি পূরণ করুন">
                                                </div>

                                                <div class="col-lg-6 col-md-6 mb-4">
                                                    <label class="form-label fw-bold">Registration Form Subtitle</label>
                                                    <input type="text" name="masterclass_settings[order_form_subtitle]" class="form-control rounded-2"
                                                           value="{{ $defOrderFormSubtitle }}" placeholder="Give valid information">
                                                </div>

                                                <div class="col-lg-4 col-md-6 mb-4">
                                                    <label class="form-label fw-bold">Full Name Field Label</label>
                                                    <input type="text" name="masterclass_settings[name_label]" class="form-control rounded-2"
                                                           value="{{ $defNameLabel }}" placeholder="Your Full Name">
                                                </div>

                                                <div class="col-lg-4 col-md-6 mb-4">
                                                    <label class="form-label fw-bold">Full Name Field Placeholder</label>
                                                    <input type="text" name="masterclass_settings[name_placeholder]" class="form-control rounded-2"
                                                           value="{{ $defNamePlaceholder }}" placeholder="আপনার সম্পূর্ণ নাম">
                                                </div>

                                                <div class="col-lg-4 col-md-6 mb-4">
                                                    <label class="form-label fw-bold">Mobile Number Field Label</label>
                                                    <input type="text" name="masterclass_settings[phone_label]" class="form-control rounded-2"
                                                           value="{{ $defPhoneLabel }}" placeholder="Mobile Number">
                                                </div>

                                                <div class="col-lg-4 col-md-6 mb-4">
                                                    <label class="form-label fw-bold">Mobile Number Field Placeholder</label>
                                                    <input type="text" name="masterclass_settings[phone_placeholder]" class="form-control rounded-2"
                                                           value="{{ $defPhonePlaceholder }}" placeholder="01XXXXXXXXX">
                                                </div>

                                                <div class="col-lg-4 col-md-6 mb-4">
                                                    <label class="form-label fw-bold">Email Address Field Label</label>
                                                    <input type="text" name="masterclass_settings[email_label]" class="form-control rounded-2"
                                                           value="{{ $defEmailLabel }}" placeholder="Email address">
                                                </div>

                                                <div class="col-lg-4 col-md-6 mb-4">
                                                    <label class="form-label fw-bold">Email Address Field Placeholder</label>
                                                    <input type="text" name="masterclass_settings[email_placeholder]" class="form-control rounded-2"
                                                           value="{{ $defEmailPlaceholder }}" placeholder="আপনার ইমেইল এড্রেস">
                                                </div>

                                                <div class="col-lg-6 col-md-6 mb-4">
                                                    <label class="form-label fw-bold">Order Summary Heading</label>
                                                    <input type="text" name="masterclass_settings[order_summary_title]" class="form-control rounded-2"
                                                           value="{{ $defOrderSummaryTitle }}" placeholder="Your order">
                                                </div>

                                                <div class="col-lg-6 col-md-6 mb-4">
                                                    <label class="form-label fw-bold">Pay Now Button Text</label>
                                                    <input type="text" name="masterclass_settings[pay_now_btn_text]" class="form-control rounded-2"
                                                           value="{{ $defPayNowBtnText }}" placeholder="PAY NOW">
                                                </div>

                                                <div class="col-lg-12 col-md-12 mb-4">
                                                    <label class="form-label fw-bold">Privacy Policy Notice Text</label>
                                                    <textarea name="masterclass_settings[privacy_notice]" class="form-control rounded-2" rows="2"
                                                              placeholder="Your personal data will be used to process your order, support your experience throughout this website, and for other purposes described in our privacy policy.">{{ $defPrivacyNotice }}</textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Section 9: FAQ Accordion -->
                                    <div class="card border mb-4 rounded-3 shadow-sm">
                                        <div class="card-header bg-white py-3 d-flex align-items-center justify-content-between">
                                            <h5 class="fw-bold text-dark m-0"><span class="badge bg-primary me-2">Section 9</span> FAQ Section Customization</h5>
                                            <button type="button" class="btn btn-sm btn-outline-secondary py-1" id="add_new_faq_btn">
                                                <i class="fas fa-plus me-1"></i> Add Custom FAQ Item
                                            </button>
                                        </div>
                                        <div class="card-body p-4">
                                            <div class="mb-4">
                                                <label class="form-label fw-bold">FAQ Section Main Title</label>
                                                <input type="text" name="masterclass_settings[faq_title]" class="form-control rounded-2"
                                                       value="{{ $defFaqTitle }}" placeholder="কিছু সাধারণ প্রশ্নের উত্তর">
                                            </div>

                                            <div id="faq_items_container">
                                                @foreach($faqList as $idx => $faqItem)
                                                    <div class="faq-single-item card border mb-3 bg-light rounded-3 p-3 position-relative">
                                                        <div class="d-flex align-items-center justify-content-between mb-3 border-bottom pb-2">
                                                            <span class="fw-bold text-primary fs-6"><i class="fas fa-question-circle me-1"></i> Custom FAQ #<span class="faq-num">{{ $idx + 1 }}</span></span>
                                                            <button type="button" class="btn btn-sm btn-outline-danger remove-faq-btn py-1 px-2">
                                                                <i class="fas fa-trash-alt me-1"></i> Delete
                                                            </button>
                                                        </div>

                                                        <div class="mb-3">
                                                            <label class="form-label fw-bold small text-dark">Question (প্রশ্ন)</label>
                                                            <input type="text" name="masterclass_settings[faq_list][{{ $idx }}][question]" class="form-control rounded-2 bg-white"
                                                                   value="{{ $faqItem['question'] ?? '' }}" placeholder="প্রশ্নটি লিখুন...">
                                                        </div>

                                                        <div>
                                                            <label class="form-label fw-bold small text-dark">Answer (উত্তর)</label>
                                                            <textarea name="masterclass_settings[faq_list][{{ $idx }}][answer]" class="form-control rounded-2 bg-white" rows="2"
                                                                      placeholder="উত্তরটি লিখুন...">{{ $faqItem['answer'] ?? '' }}</textarea>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Section 10: Dual CTA Banner & Footer Urgency -->
                                    <div class="card border mb-4 rounded-3 shadow-sm">
                                        <div class="card-header bg-white py-3">
                                            <h5 class="fw-bold text-dark m-0"><span class="badge bg-primary me-2">Section 10</span> Dual CTA Banner & Footer Urgency</h5>
                                        </div>
                                        <div class="card-body p-4">
                                            <div class="row gx-20">
                                                <div class="col-lg-6 col-md-6 mb-4">
                                                    <label class="form-label fw-bold">Dual CTA Left Button Text</label>
                                                    <input type="text" name="masterclass_settings[dual_cta_left]" class="form-control rounded-2"
                                                           value="{{ $defDualCtaLeft }}" placeholder="রেজিস্ট্রেশন করুন এখনই">
                                                </div>

                                                <div class="col-lg-6 col-md-6 mb-4">
                                                    <label class="form-label fw-bold">Dual CTA Urgency Seats Text</label>
                                                    <input type="text" name="masterclass_settings[dual_cta_seats]" class="form-control rounded-2"
                                                           value="{{ $defDualCtaSeats }}" placeholder="আর মাত্র 72 সিট বাকি">
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Section 11: Reviews & Ratings Visibility -->
                                    <div class="card border mb-4 rounded-3 shadow-sm">
                                        <div class="card-header bg-white py-3">
                                            <h5 class="fw-bold text-dark m-0"><span class="badge bg-primary me-2">Section 11</span> Reviews & Ratings Section</h5>
                                        </div>
                                        <div class="card-body p-4">
                                            <div class="row gx-20">
                                                <div class="col-12">
                                                    <div class="form-check">
                                                        <input type="checkbox" name="masterclass_settings[hide_reviews]" value="1" class="form-check-input" id="create_hide_rev"
                                                            {{ old('masterclass_settings.hide_reviews') == '1' ? 'checked' : '' }}>
                                                        <label class="form-check-label fw-bold" for="create_hide_rev">Hide Reviews Section from Landing Page</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Section 12: Related Courses Visibility -->
                                    <div class="card border mb-4 rounded-3 shadow-sm">
                                        <div class="card-header bg-white py-3">
                                            <h5 class="fw-bold text-dark m-0"><span class="badge bg-primary me-2">Section 12</span> Related Courses Section</h5>
                                        </div>
                                        <div class="card-body p-4">
                                            <div class="row gx-20">
                                                <div class="col-12">
                                                    <div class="form-check">
                                                        <input type="checkbox" name="masterclass_settings[hide_related_courses]" value="1" class="form-check-input" id="create_hide_rel"
                                                            {{ old('masterclass_settings.hide_related_courses') == '1' ? 'checked' : '' }}>
                                                        <label class="form-check-label fw-bold" for="create_hide_rel">Hide Related Courses Section from Landing Page</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="d-flex align-items-center justify-content-between pt-3 border-top">
                                        <a href="#" class="btn sg-btn-outline-primary btn_action" data-bs-toggle="tab" data-bs-target="#courseSEO">{{ __('back') }}</a>
                                        <button type="submit" class="btn sg-btn-primary py-2 px-4 fs-6"><i class="fas fa-check-circle me-1"></i> {{ __('submit') }}</button>
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
            $(document).on('click', "#mgCourse-tabContent a.btn_action, .mc-step-btn", function(e) {
                e.preventDefault();
                let target = $(this).attr('data-bs-target');
                if (target) {
                    let navLink = document.querySelector('.nav-link[data-bs-target="' + target + '"]');
                    if (navLink) {
                        let tabInstance = bootstrap.Tab.getOrCreateInstance(navLink);
                        tabInstance.show();
                    }
                }
            });

            // Video Source & File Pickers
            $(document).on('change', "#video_source", function () {
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

            $(document).on('change', ".thumb_picker", function (e) {
                let fileName = e.target.files[0] ? e.target.files[0].name : '{{ __("video") }}';
                $(this).closest('.mb-3').find('.file_name').text(fileName);
            });

            $(document).on('change', "#is_free", function () {
                let is_free = $(this).is(':checked');
                if (is_free) {
                    $('.not_free_div').addClass('d-none');
                    $('.discountable_div').addClass('d-none');
                    $("#discountable_course").prop('checked', false);
                } else {
                    $('.not_free_div').removeClass('d-none');
                }
            });

            $(document).on('change', "#discountable_course", function () {
                let is_discountable = $(this).is(':checked');
                if (is_discountable) {
                    $('.discountable_div').removeClass('d-none');
                } else {
                    $('.discountable_div').addClass('d-none');
                }
            });

            // Dynamic Benefit Repeater
            $('#add_new_benefit_btn').on('click', function () {
                let count = $('#benefits_items_container .benefit-single-item').length + 1;
                let html = `
                    <div class="benefit-single-item card border mb-3 bg-light rounded-3 p-3 position-relative">
                        <div class="d-flex align-items-center justify-content-between mb-2">
                            <span class="fw-bold text-success fs-6"><i class="fas fa-check-circle me-1"></i> Benefit Point #<span class="benefit-num">${count}</span></span>
                            <button type="button" class="btn btn-sm btn-outline-danger remove-benefit-btn py-1 px-2">
                                <i class="fas fa-trash-alt me-1"></i> Delete
                            </button>
                        </div>
                        <input type="text" name="masterclass_settings[benefits_list][]" class="form-control rounded-2 bg-white" placeholder="এখানে বেনিফিট পয়েন্টটি লিখুন...">
                    </div>
                `;
                $('#benefits_items_container').append(html);
            });

            $(document).on('click', '.remove-benefit-btn', function () {
                $(this).closest('.benefit-single-item').remove();
                $('#benefits_items_container .benefit-single-item').each(function (idx) {
                    $(this).find('.benefit-num').text(idx + 1);
                });
            });
        });
    </script>
@endpush

