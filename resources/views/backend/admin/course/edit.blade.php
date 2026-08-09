@extends('backend.layouts.master')
@section('title', __('edit_course'))
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h3 class="section-title">{{ __('edit_course') }}</h3>
                @php
                    $step_1_error = false;
                    $step_2_error = false;
                    $step_3_error = false;
                    $step_6_error = false;
                    $step_1_errors = ['title', 'category_id', 'subject_id', 'organization_id', 'language_id', 'level_id', 'instructor_ids', 'duration', 'capacity', 'start_date'];
                    $step_3_errors = ['price', 'discount_type', 'discount', 'discount_period', 'renew_after'];
                    $step_6_errors = ['LiveClassmeetingMethod', 'liveClassDescription', 'LiveClassmeetingLink', 'LiveClassmeetingPassword', 'LiveClassMeetingID'];

                    foreach ($step_1_errors as $step1) {
                        if ($errors->has($step1)) {
                            $step_1_error = true;
                            $request_tab = 'basic';
                            break;
                        }
                    }

                    if ($errors->has('video')) {
                        $step_2_error = true;
                    }

                    foreach ($step_3_errors as $step3) {
                        if ($errors->has($step3)) {
                            $step_3_error = true;
                            if(!$step_1_error)
                                $request_tab = 'pricing';
                            break;
                        }
                    }
                    foreach ($step_6_errors as $step6) {
                        if ($errors->has($step6)) {
                            $step_6_error = true;
                            if(!$step_1_error && !$step_3_error)
                                $request_tab = 'LiveClass';
                            break;
                        }
                    }
                @endphp
                <div class="default-tab-list bg-white redious-border p-20 p-sm-30">
                    <ul class="nav justify-content-center pb-40 mb-0" id="pills-tab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <a class="nav-link tab_change {{ $request_tab == 'basic' ? 'active ' : '' }}{{ $step_1_error ? 'text-danger' : '' }}"
                               data-tab="basic" id="basicInformation" data-bs-toggle="pill"
                               data-bs-target="#basicCourseInformation" role="tab"
                               aria-controls="basicCourseInformation" aria-selected="true">
                                <span
                                    class="default-tab-count {{ $step_1_error ? 'bg-danger text-white' : '' }}">1</span>{{ __('basic_information') }}
                            </a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link tab_change {{ $request_tab == 'mediaImages' ? 'active' : '' }}"
                               data-tab="mediaImages" id="mediaImages" data-bs-toggle="pill"
                               data-bs-target="#courseMediaImages" role="tab" aria-controls="courseMediaImages"
                               aria-selected="false">
                                <span
                                    class="default-tab-count {{ $step_2_error  ? 'bg-danger text-white' : '' }}">2</span>{{ __('media_images') }}
                            </a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link tab_change {{ $request_tab == 'pricing' ? 'active ' : '' }} {{ $step_3_error ? 'text-danger' : '' }}"
                               data-tab="pricing" id="pricing" data-bs-toggle="pill" data-bs-target="#coursePricing"
                               role="tab" aria-controls="coursePricing" aria-selected="false">
                                <span
                                    class="default-tab-count {{ $step_3_error  ? 'bg-danger text-white' : '' }}">3</span>{{ __('pricing') }}
                            </a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link tab_change {{ $request_tab == 'seo' ? 'active' : '' }} {{ $step_1_error || $step_2_error || $step_3_error }}"
                               data-tab="seo" id="seo" data-bs-toggle="pill" data-bs-target="#courseSEO"
                               role="tab" aria-controls="courseSEO" aria-selected="false">
                                <span class="default-tab-count">4</span>{{ __('seo') }}</a>
                        </li>

                        <li class="nav-item" role="presentation">
                            <a class="nav-link tab_change {{ $step_1_error || $step_2_error || $step_3_error }} {{ $request_tab == 'curriculum' ? 'active' : '' }}"
                               data-tab="curriculum" id="curriculum" data-bs-toggle="pill"
                               data-bs-target="#courseCurriculum" role="tab" aria-controls="courseCurriculum"
                               aria-selected="false"><span class="default-tab-count ">5</span> {{ __('curriculum') }}
                            </a>
                        </li>
                        <li class="nav-item {{ $course->course_type == 'live_class' ? '' : 'd-none' }}"
                            id="notLiveClass"
                            role="presentation">
                            <a class="nav-link tab_change {{ $step_6_error ? 'text-danger ' : '' }} {{ $request_tab == 'LiveClass' ? 'active' : '' }}"
                               data-tab="live_class" id="live_class" data-bs-toggle="pill"
                               data-bs-target="#courseLiveClass" role="tab" aria-controls="courseLiveClass"
                               aria-selected="false"><span class="default-tab-count {{ $step_6_error ? 'bg-danger text-white' : '' }}">6</span> {{ __('Live Class') }}
                            </a>
                        </li>


                        <li class="nav-item" role="presentation">
                            <a class="nav-link tab_change {{ $step_1_error || $step_2_error || $step_3_error }} {{ $request_tab == 'assignment' ? 'active' : '' }}"
                               data-tab="assignment" id="assignment" data-bs-toggle="pill"
                               data-bs-target="#courseAssignment" role="tab" aria-controls="courseAssignment"
                               aria-selected="false">
                                <span class="default-tab-count courseAssignmentIndex">
                                    @if ($course->course_type == 'live_class')
                                        {{ 7 }}
                                    @else
                                        {{ 6 }}
                                    @endif
                                </span>
                                {{-- <span class="default-tab-count num_live">6 </span> --}}

                                {{ __('assignment') }}
                            </a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link tab_change {{ $step_1_error || $step_2_error || $step_3_error }} {{ $request_tab == 'resource' ? 'active' : '' }}"
                               data-tab="resource" id="resource" data-bs-toggle="pill" data-bs-target="#courseResource"
                               role="tab" aria-controls="courseResource" aria-selected="false">
                                {{-- <span class="default-tab-count order">8 </span>
                                <span class="default-tab-count num_live">6</span> --}}
                                <span class="default-tab-count courseresourceIndex">
                                    @if ($course->course_type == 'live_class')
                                        {{ 8 }}
                                    @else
                                        {{ 7 }}
                                    @endif
                                </span>
                                {{ __('resource') }}
                            </a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link tab_change {{ $step_1_error || $step_2_error || $step_3_error }} {{ $request_tab == 'faq' ? 'active' : '' }}"
                               data-tab="faq" id="faq" data-bs-toggle="pill" data-bs-target="#courseFAQ"
                               role="tab" aria-controls="courseFAQ" aria-selected="false">
                                <span class="default-tab-count coursefaqIndex">
                                    @if ($course->course_type == 'live_class')
                                        {{ 9 }}
                                    @else
                                        {{ 8 }}
                                    @endif
                                </span>
                                {{ __('faq') }}
                            </a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link tab_change {{ $request_tab == 'masterclass' ? 'active' : '' }}"
                               data-tab="masterclass" id="masterclass" data-bs-toggle="pill" data-bs-target="#courseMasterclass"
                               role="tab" aria-controls="courseMasterclass" aria-selected="false">
                                <span class="default-tab-count masterclassIndex">
                                    @if ($course->course_type == 'live_class')
                                        {{ 10 }}
                                    @else
                                        {{ 9 }}
                                    @endif
                                </span>
                                {{ __('Masterclass Landing') }}
                            </a>
                        </li>
                    </ul>
                    <!-- End Edit Course tab menu -->

                    <form action="{{ route('courses.update', $course->id) }}" method="POST"
                          enctype="multipart/form-data">@csrf
                        @method('PUT')
                        <input type="hidden" name="tab" id="form_active_tab" value="{{ $request_tab }}">
                        <div class="tab-content" id="mgCourse-tabContent">
                            <div
                                class="tab-pane fade {{ $request_tab == 'basic' ? 'show active' : '' }} {{ $step_1_error ? 'show active' : '' }}"
                                id="basicCourseInformation" role="tabpanel" aria-labelledby="basicInformation"
                                tabindex="0">
                                <div class="row gx-20">
                                    <div class="col-lg-6 col-md-6">
                                        <div class="mb-4">
                                            <label for="courseTitle" class="form-label">{{ __('course_title') }}</label>
                                            <input type="text" value="{{ old('title', $course->title) }}"
                                                   class="form-control rounded-2 ai_content_name" id="courseTitle"
                                                   name="title" placeholder="{{ __('enter_course_title') }}">
                                            <div class="nk-block-des text-danger">
                                                <p class="error">{{ $errors->first('title') }}</p>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- End Course Title -->

                                    <div class="col-lg-6 col-md-6">
                                        <div class="mb-4">
                                            <div class="select-type-v2">
                                                <label for="select_category"
                                                       class="form-label">{{ __('select_category') }}</label>
                                                <select id="select_category" name="category_id"
                                                        data-route="{{ route('ajax.categories') }}"
                                                        placeholder="{{ __('select_category') }}"
                                                        class="form-select-lg rounded-0 mb-3"
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

                                    <div class="col-lg-6 col-md-6">
                                        <div class="mb-4">
                                            <div class="select-type-v2">
                                                <label for="courseType"
                                                       class="form-label">{{ __('course_type') }}</label>
                                                <select id="courseType" name="course_type"
                                                        class="form-select form-select-lg mb-3 without_search selectcourse"
                                                        aria-label=".form-select-lg">

                                                    <option value="course"
                                                        {{ old('course_type', $course->course_type) == 'course' ? 'selected' : '' }}>
                                                        {{ __('course') }}</option>
                                                    <option value="live_class"
                                                        {{ old('course_type', $course->course_type) == 'live_class' ? 'selected' : '' }}>
                                                        {{ __('live_class') }}</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- End Course Type -->

                                    <div class="col-lg-6 col-md-6">
                                        <div class="mb-4">
                                            <div class="select-type-v2">
                                                <label for="language_id" class="form-label">{{ __('language') }}</label>
                                                <select id="language_id"
                                                        class="form-select form-select-lg mb-3 with_search"
                                                        name="language_id">
                                                    <option value="">{{ __('select_language') }}</option>
                                                    @foreach ($languages as $language)
                                                        <option value="{{ $language->id }}"
                                                            {{ old('language_id', $course->language_id) == $language->id ? 'selected' : '' }}>
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

                                    <div class="col-lg-6 col-md-6">
                                        <div class="mb-4">
                                            <div class="select-type-v2">
                                                <label for="select_subject"
                                                       class="form-label">{{ __('select_subject') }}</label>
                                                <select id="select_subject" name="subject_id"
                                                        placeholder="{{ __('select_subject') }}"
                                                        data-route="{{ route('ajax.subjects') }}"
                                                        class="form-select-lg rounded-0 mb-3"
                                                        aria-label=".form-select-lg example">
                                                    @if ($subject)
                                                        <option value="{{ $subject->id }}"
                                                                @if ($subject->id == $course->subject_id) selected @endif>
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

                                    <div class="col-lg-6 col-md-6">
                                        <div class="mb-4">
                                            <div class="select-type-v2">
                                                <label for="courseLevel"
                                                       class="form-label">{{ __('course_level') }}</label>
                                                <select id="courseLevel"
                                                        class="form-select form-select-lg mb-3 with_search"
                                                        name="level_id"
                                                        aria-label=".form-select-lg">
                                                    <option value="">{{ __('select_level') }}</option>
                                                    @foreach ($levels as $level)
                                                        <option value="{{ $level->id }}"
                                                            {{ old('level_id', $course->level_id) == $level->id ? 'selected' : '' }}>
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

                                    <div class="col-lg-6 col-md-6">
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

                                    <div class="col-lg-6 col-md-6">
                                        <div class="mb-4">
                                            <div class="select-type-v2">
                                                <label for="instructor_ids"
                                                       class="form-label">{{ __('instructor') }}</label>
                                                <select id="instructor_ids" name="instructor_ids[]" multiple
                                                        class="form-select form-select-lg mb-3 without_search"
                                                        aria-label=".form-select-lg">
                                                    @foreach ($instructors as $instructor)
                                                        <option value="{{ $instructor->id }}"
                                                            {{ old('instructor_ids', $course->instructor_ids) && in_array($instructor->id, old('instructor_ids', $course->instructor_ids)) ? 'selected' : '' }}>
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

                                    <div class="col-lg-6 col-md-6">
                                        <div class="mb-4">
                                            <label for="courseDuration"
                                                   class="form-label">{{ __('course_duration') }}</label>
                                            <input type="text" class="form-control rounded-2" id="courseDuration"
                                                   name="duration" placeholder="{{ __('72_hours') }}"
                                                   value="{{ old('duration', $course->duration) }}">
                                            <div class="nk-block-des text-danger">
                                                <p class="error">{{ $errors->first('duration') }}</p>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- End Course Duration -->

                                    <div class="col-lg-6 col-md-6">
                                        <div class="multi-select-v2 mb-4">
                                            <label for="tag" class="form-label">{{ __('course_tag') }}</label>
                                            <select id="tag" multiple
                                                    class="form-select form-select-lg mb-3 with_search" name="tags[]"
                                                    aria-label=".form-select-lg" placeholder="{{ __('select_tags') }}">
                                                @foreach ($tags as $tag)
                                                    <option value="{{ $tag->id }}"
                                                        {{ old('tags', $course->tags) && in_array($tag->id, old('tags', $course->tags)) ? 'selected' : '' }}>
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
                                            <textarea class="form-control" name="short_description"
                                                      id="shortDescription"
                                                      placeholder="{{ __('enter_short_description') }}">{{ old('short_description', $course->short_description) }}</textarea>
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
                                            <textarea id="product-update-editor"
                                                      name="description">{!! old('description', $course->description) !!}</textarea>
                                        </div>

                                        <div class="row mt-3">
                                            <div class="custom-checkbox mt-12 col-6">
                                                <label>
                                                    <input type="checkbox" value="1" name="is_private"
                                                        {{ old('is_private', $course->is_private) == 1 ? 'checked' : '' }}>
                                                    <span>{{ __('private_course') }}</span>
                                                </label>
                                            </div>
                                            <div class="col-6 d-flex align-items-center">
                                                <label class="col-6 text-end px-4" for="course_status">Change
                                                    Status</label>
                                                <div class="col-6">
                                                    <select name="status" id="course_status"
                                                            class="form-control form-select form-select-lg mb-3 without_search">
                                                        <option
                                                            {{ $course->status == 'draft' ? 'selected' : '' }}
                                                            value="draft">Draft
                                                        </option>
                                                        <option
                                                            {{ $course->status == 'in_review' ? 'selected' : '' }}
                                                            value="in_review">In
                                                            Review
                                                        </option>
                                                        <option
                                                            {{ $course->status == 'rejected' ? 'selected' : '' }}
                                                            value="rejected">Rejected
                                                        </option>
                                                        <option
                                                            {{ $course->status == 'approved' ? 'selected' : '' }}
                                                            value="approved">Approved
                                                        </option>
                                                    </select>
                                                </div>
                                            </div>
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

                            <div
                                class="tab-pane fade {{ $request_tab == 'mediaImages' ? 'show active' : '' }}"
                                id="courseMediaImages" role="tabpanel" aria-labelledby="mediaImages" tabindex="0">
                                <div class="row">
                                    <div class="col-lg-6 col-md-6">
                                        <div class="mb-4">
                                            <div class="select-type-v2">
                                                <label for="video_source"
                                                       class="form-label">{{ __('video_source') }}</label>
                                                <select id="video_source"
                                                        class="form-select form-select-lg mb-3 without_search"
                                                        name="video_source">
                                                    <option value="">{{ __('select_video_source') }}</option>
                                                    <option value="upload"
                                                        {{ old('video_source', $course->video_source) == 'upload' ? 'selected' : '' }}>
                                                        {{ __('upload') }}</option>

                                                    <option value="youtube"
                                                        {{ old('video_source', $course->video_source) == 'youtube' ? 'selected' : '' }}>
                                                        {{ __('youtube') }}</option>

                                                    <option value="vimeo"
                                                        {{ old('video_source', $course->video_source) == 'vimeo' ? 'selected' : '' }}>
                                                        {{ __('vimeo') }}</option>
                                                    <option value="mp4"
                                                        {{ old('video_source', $course->video_source) == 'mp4' ? 'selected' : '' }}>
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
                                        class="col-lg-6 col-md-6 upload_div {{ old('video_source', $course->video_source) == 'upload' ? '' : 'd-none' }}">
                                        <div class="mb-3">
                                            <label for="thumbnailFile"
                                                   class="form-label">{{ __('upload_video') }}</label>
                                            <label for="thumbnailFile" class="file-upload-text">
                                                <p class="file_name">
                                                    {{ getFileName(getArrayValue('image', $course->video)) }}</p>
                                                <span class="file-btn">{{ __('choose_file') }}</span>
                                            </label>
                                            <input class="d-none thumb_picker" name="video" type="file"
                                                   id="thumbnailFile">
                                            <div class="nk-block-des text-danger">
                                                <p class="error">{{ $errors->first('video_file') }}</p>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- End Upload Video -->
                                    <div
                                        class="col-lg-6 col-md-6 video_link {{ old('video_source', $course->video_source) && old('video_source', $course->video_source) != 'upload' ? '' : 'd-none' }}">
                                        <div class="mb-4">
                                            <label for="videoLink" class="form-label">{{ __('video_link') }}</label>
                                            <input type="text" class="form-control rounded-2" name="video_link"
                                                   id="videoLink" placeholder="{{ __('enter_video_link') }}"
                                                   value="{{ $course->video_source == 'upload' ? getFileName(getArrayValue('image', $course->video)) : $course->video }}">
                                            <div class="nk-block-des text-danger">
                                                <p class="error">{{ $errors->first('video') }}</p>
                                            </div>
                                        </div>
                                    </div>

                                    @include('backend.common.media-input', [
                                        'title' => 'Slider Image',
                                        'name' => 'image_media_id',
                                        'col' => 'col-12',
                                        'size' => '(402x248)',
                                        'image' => old('image_media_id', $course->image_media_id),
                                        'label' => __('thumbnail'),
                                        'edit' => $course,
                                        'image_object' => $course->image,
                                        'media_id' => $course->image_media_id,
                                    ])
                                    <div class="col-lg-6 col-md-6">
                                        <div class="custom-checkbox mt-20">
                                            <label>
                                                <input type="checkbox" value="1"
                                                    {{ old('is_downloadable', $course->is_downloadable) == 1 ? 'checked' : '' }}>
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
                                                    {{ old('is_free', $course->is_free) == 1 ? 'checked' : '' }}>
                                                <label for="is_free"></label>
                                            </div>
                                        </div>
                                        <div
                                            class="price-checkbox d-flex gap-12 mb-4 not_free_div {{ old('is_free', $course->is_free) == 1 ? 'd-none' : '' }}">
                                            <label for="discountable_course">{{ __('discountable_course') }}</label>
                                            <div class="setting-check">
                                                <input type="checkbox" id="discountable_course" name="is_discountable"
                                                       value="1"
                                                    {{ old('is_discountable', $course->is_discountable) == 1 ? 'checked' : '' }}>
                                                <label for="discountable_course"></label>
                                            </div>
                                        </div>

                                    </div>
                                    <!-- End Free Course Option -->

                                    <div class="col-lg-6 not_free_div {{ old('is_free', $course->is_free) == 1 ? 'd-none' : '' }}">
                                        <div class="mb-4">
                                            <label for="price" class="form-label">{{ __('price') }}</label>
                                            <input type="text" class="form-control rounded-2" id="price" name="price"
                                                   placeholder="{{ __('price') }}"
                                                   value="{{ old('price', $course->price) }}">
                                            <div class="nk-block-des text-danger">
                                                <p class="error">{{ $errors->first('price') }}</p>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- End Price -->

                                    <div
                                        class="col-lg-6 discountable_div {{ old('is_discountable', $course->is_discountable) == 1 && old('is_free', $course->is_free) == 0 ? '' : 'd-none' }}">
                                        <div class="mb-4">
                                            <div class="select-type-v2">
                                                <label for="discount_type"
                                                       class="form-label">{{ __('discount_type') }}</label>

                                                <select class="form-select form-select-lg mb-3 without_search"
                                                        id="discount_type" name="discount_type">
                                                    <option value="">{{ __('select_discount_type') }}</option>
                                                    <option value="flat"
                                                        {{ old('discount_type', $course->discount_type) == 'flat' ? 'selected' : '' }}>
                                                        {{ __('flat') }}</option>
                                                    <option value="percentage"
                                                        {{ old('discount_type', $course->discount_type) == 'percentage' ? 'selected' : '' }}>
                                                        {{ __('percentage') }}</option>
                                                </select>
                                                <div class="nk-block-des text-danger">
                                                    <p class="error">{{ $errors->first('discount_type') }}</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- End Discount Type -->

                                    <div
                                        class="col-lg-6 discountable_div {{ old('is_discountable', $course->is_discountable) == 1 && old('is_free', $course->is_free) == 0 ? '' : 'd-none' }}">
                                        <div class="mb-4">
                                            <label for="discount_amount"
                                                   class="form-label">{{ __('discount_amount') }}</label>
                                            <input type="text" class="form-control rounded-2" id="discount_amount"
                                                   name="discount_amount"
                                                   value="{{ old('discount_amount', $course->discount_amount) }}"
                                                   placeholder="{{ __('discount_amount') }}">
                                            <div class="nk-block-des text-danger">
                                                <p class="error">{{ $errors->first('discount_amount') }}</p>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- End Discount Amount -->

                                    <div
                                        class="col-lg-6 discountable_div {{ old('is_discountable', $course->is_discountable) == 1 && old('is_free', $course->is_free) == 0 ? '' : 'd-none' }}">
                                        <div class="mb-4">
                                            <label for="liveClassDateRangePicker"
                                                   class="form-label">{{ __('discount_period') }}</label>

                                            <div class="date-picker-div text-start">
                                                <input type="text" class="form-control" name="discount_period"
                                                       id="liveClassDateRangePicker"
                                                       value="{{ old('discount_period', $course->discount_period) }}">
                                                <div class="nk-block-des text-danger">
                                                    <p class="error">{{ $errors->first('discount_period') }}</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- End Date Range Picker -->


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

                            <div
                                class="tab-pane fade tab-pane fade {{ $request_tab == 'seo' ? 'show active' : '' }} {{ $step_1_error || $step_2_error || $step_3_error }}"
                                id="courseSEO" role="tabpanel" aria-labelledby="seo" tabindex="0">
                                <div class="row gx-20">
                                    @include('components.meta-fields', [
                                        'meta_title_class' => 'col-lg-6 col-md-6',
                                        'meta_description_class' => 'col-lg-12',
                                        'meta_keywords_class' => 'col-lg-6',
                                        'meta_image_class' => 'col-lg-12',
                                        'meta_title' => old('meta_title', $course->meta_title),
                                        'meta_keywords' => old('meta_keywords', $course->meta_keywords),
                                        'meta_description' => old('meta_description', $course->meta_description),
                                        'meta_image' => $course->meta_image,
                                        'edit' => $course,
                                    ])
                                    <div class="col-lg-12">
                                        <div class="d-flex justify-content-between align-items-center mt-30">
                                            <a href="#" class="btn sg-btn-outline-primary btn_action"
                                               data-bs-target="#coursePricing">{{ __('back') }}</a>
                                            <a href="#" type="button" class="btn sg-btn-primary btn_action"
                                               data-bs-target="#courseCurriculum">{{ __('next') }}</a>
                                        </div>
                                    </div>
                                    <!-- End Next Page BTN -->
                                </div>
                            </div>

                            <!-- start Curriculum Tab -->
                            <div
                                class="tab-pane fade {{ $step_3_error || $step_1_error || $step_2_error }} {{ $request_tab == 'curriculum' ? 'show active' : '' }}"
                                id="courseCurriculum" role="tabpanel" aria-labelledby="curriculum" tabindex="0">
                                <div class="row">

                                    <div class="col-lg-12">
                                        <div class="d-flex justify-content-between align-items-center mb-20">
                                            <button type="button" data-bs-toggle="modal" data-bs-target="#section"
                                                    class="btn sg-btn-primary add_modal">{{ __('add_module') }} <i
                                                    class="las la-plus"></i></button>
                                        </div>
                                    </div>

                                    <div class="col-lg-12">
                                        <div class="accordion editCourseCurriculum" id="editCourse">
                                            @php
                                                $i = 0;
                                            @endphp
                                            @foreach ($sections as $key => $section)
                                                <div class="accordion-item" data-id="{{ $section->id }}">
                                                    <input type="hidden" name="order_no"
                                                           class="sections section_{{ $section->id }}"
                                                           value="{{ $section->order_no }}">
                                                    <h2 class="accordion-header" id="{{ $key }}">
                                                        <button class="accordion-button" type="button"
                                                                data-bs-toggle="collapse"
                                                                data-bs-target="#courseSection{{ $id = $section->id }}"
                                                                aria-expanded="true"
                                                                aria-controls="courseSection{{ $id }}">
                                                            {{ __('module') }} {{ ++$key }} :
                                                            {{ $section->title }}
                                                        </button>
                                                        <ul class="d-flex align-items-center course-edit-action gap-12">
                                                            <li class="dropdown">
                                                                <a class="dropdown-toggle" href="#"
                                                                   data-bs-toggle="dropdown" aria-expanded="false">
                                                                    {{ __('add_lesson') }}
                                                                </a>
                                                                <ul class="dropdown-menu">
                                                                    <li><a class="dropdown-item lesson_modal"
                                                                           href="#" data-bs-toggle="modal"
                                                                           data-section="{{ json_encode($section) }}"
                                                                           data-bs-target="#video_lesson">{{ __('add_video_lesson') }}</a>
                                                                    </li>
                                                                    <li><a class="dropdown-item lesson_modal"
                                                                           href="#" data-bs-toggle="modal"
                                                                           data-section="{{ json_encode($section) }}"
                                                                           data-bs-target="#audio_lesson">{{ __('add_audio_lesson') }}</a>
                                                                    </li>
                                                                    <li><a class="dropdown-item lesson_modal"
                                                                           href="#" data-bs-toggle="modal"
                                                                           data-section="{{ json_encode($section) }}"
                                                                           data-bs-target="#doc_lesson">{{ __('add_doc_lesson') }}</a>
                                                                    </li>
                                                                </ul>
                                                            </li>
                                                            <li>
                                                                <a href="#"
                                                                   class="btn sg-btn-outline-primary lesson_modal"
                                                                   data-section="{{ json_encode($section) }}"
                                                                   data-bs-toggle="modal"
                                                                   data-bs-target="#add_quiz">{{ __('add_quiz') }}</a>
                                                            </li>
                                                            <li class="listMove">
                                                                <a href="#" class="icon btn sg-btn-outline-primary">
                                                                    <i class="las la-arrows-alt"></i>
                                                                </a>
                                                            </li>
                                                            <li class="dropdown pe-0">
                                                                <a class="dropdown-toggle icon" href="#"
                                                                   data-bs-toggle="dropdown" aria-expanded="false"><i
                                                                        class="las la-ellipsis-v"></i></a>
                                                                <ul class="dropdown-menu">
                                                                    <li><a class="dropdown-item edit_modal"
                                                                           href="javascript:void(0)"
                                                                           data-fetch_url="{{ route('sections.edit', $section->id) }}"
                                                                           data-route="{{ route('sections.update', $section->id) }}"
                                                                           data-modal="editSection">{{ __('edit_section') }}</a>
                                                                    </li>
                                                                    <li><a class="dropdown-item"
                                                                           href="javascript:void(0)"
                                                                           onclick="delete_row('{{ route('sections.destroy', $section->id) }}',null,true)"
                                                                           data-toggle="tooltip"
                                                                           data-original-title="{{ __('delete') }}">{{ __('delete') }}</a>
                                                                    </li>
                                                                </ul>
                                                            </li>
                                                        </ul>
                                                    </h2>
                                                    <div id="courseSection{{ $id }}"
                                                         class="accordion-collapse collapse {{ $i == 0 && (count($lessons->where('section_id', $section->id)) > 0 || count($section->quizzes) > 0) ? 'show' : '' }}"
                                                         aria-labelledby="courseSectionOne"
                                                         data-bs-parent="#editCourse">
                                                        <div class="accordion-body">
                                                            <div class="row">
                                                                <div class="col-lg-12">
                                                                    <div class="moveable-list-view mt-20 mt-md-0"
                                                                         id="lesson_sortable">
                                                                        @if (count($lessons) > 0)
                                                                            @foreach ($lessons->where('section_id', $section->id) as $k => $lesson)
                                                                                <div class="list-view"
                                                                                     data-id="{{ $lesson->id }}">
                                                                                    <div
                                                                                        class="list-view-content d-flex align-items-center gap-30">
                                                                                        <span class="icon"><i
                                                                                                @class([
                                                                                                    'las',
                                                                                                    'la-play' => $lesson->lesson_type == 'video',
                                                                                                    'la-music' => $lesson->lesson_type == 'audio',
                                                                                                    'la-file-invoice' => $lesson->lesson_type == 'doc',
                                                                                                ])></i></span>
                                                                                        <p>{{ __('lesson') }}
                                                                                            {{ ++$k }}
                                                                                            : {{ $lesson->title }}</p>
                                                                                    </div>


                                                                                    <ul
                                                                                        class="d-flex align-items-center gap-20">
                                                                                        <li><a href="#"
                                                                                               class="icon edit_modal"
                                                                                               data-fetch_url="{{ route('lessons.edit', $lesson->id) }}"
                                                                                               data-route="{{ route('lessons.update', $lesson->id) }}"
                                                                                               data-modal="edit_{{ $lesson->lesson_type }}_lesson"
                                                                                               data-bs-custom-class="custom-tooltip"
                                                                                               data-bs-toggle="tooltip"
                                                                                               data-bs-placement="top"
                                                                                               data-bs-title="{{ __('edit') }}"><i
                                                                                                    class="lar la-edit"></i></a>
                                                                                        </li>

                                                                                        <li><a href="#"
                                                                                               class="icon"
                                                                                               onclick="delete_row('{{ route('lessons.destroy', $lesson->id) }}',null,true)"
                                                                                               data-bs-toggle="tooltip"
                                                                                               data-bs-placement="top"
                                                                                               data-bs-title="{{ __('delete') }}"><i
                                                                                                    class="las la-times"></i></a>
                                                                                        </li>

                                                                                        <li
                                                                                            class="list-view-icon lessonMove lesson_modal">
                                                                                            <a href="#"><i
                                                                                                    class="las la-arrows-alt"></i></a>
                                                                                        </li>
                                                                                    </ul>
                                                                                </div>
                                                                                <!-- End List View -->
                                                                            @endforeach
                                                                        @endif

                                                                    </div>
                                                                    @foreach ($section->quizzes as $quiz)
                                                                        <div class="list-view fixed-list-view mt-20">
                                                                            <div
                                                                                class="list-view-content d-flex align-items-center gap-30">
                                                                                <span class="icon"><i
                                                                                        class="las la-question"></i></span>
                                                                                <div>
                                                                                    <h6>{{ $quiz->title }}</h6>
                                                                                    <p>Question 5
                                                                                        | {{ __('time') }}
                                                                                        {{ $quiz->duration }}
                                                                                        {{ __('minutes') }}
                                                                                        | {{ __('total_marks') }}
                                                                                        {{ $quiz->total_marks }} </p>
                                                                                </div>
                                                                            </div>


                                                                            <ul
                                                                                class="action-btn d-flex align-items-center gap-20 px-20">
                                                                                <li><a href="#"
                                                                                        @class(['active', 'bg-danger' => $quiz->status == 0])>{{ $quiz->status == 1 ? __('active') : __('in_active') }}</a>
                                                                                </li>
                                                                                <li>
                                                                                    <a href="{{ route('quizzes.edit', $quiz->id) }}"
                                                                                       class="icon"
                                                                                       data-bs-toggle="tooltip"
                                                                                       data-bs-placement="top"
                                                                                       data-bs-title="{{ __('edit') }}"><i
                                                                                            class="lar la-edit"></i></a>
                                                                                </li>
                                                                                <li><a href="#" class="icon"
                                                                                       data-bs-toggle="tooltip"
                                                                                       onclick="delete_row('{{ route('quizzes.destroy', $quiz->id) }}',null,true)"
                                                                                       data-bs-placement="top"
                                                                                       data-bs-title="{{ __('destroy') }}"><i
                                                                                            class="lar la-trash-alt"></i></a>
                                                                                </li>
                                                                            </ul>
                                                                        </div>
                                                                    @endforeach
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                @php
                                                    $i++;
                                                @endphp
                                            @endforeach
                                            <!-- End Course Module 1 Accordion ITEM -->
                                        </div>
                                    </div>

                                    <div class="col-lg-12">
                                        <div class="d-flex justify-content-between align-items-center mt-30">
                                            <a href="#" type="button"
                                               class="btn sg-btn-outline-primary btn_action"
                                               data-bs-target="#courseSEO">{{ __('back') }}</a>
                                            <a href="#" type="button" class="btn sg-btn-primary btn_action"
                                               data-bs-target="#courseAssignment">{{ __('next') }}</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- End Curriculum Tab -->

                            <!-- Start Live Class Tab -->
                            <div class="tab-pane fade {{ $step_6_error && (!$step_1_error && !$step_2_error && !$step_3_error) ? 'show active' : '' }}" id="courseLiveClass" role="tabpanel" aria-labelledby="courseLiveClass"
                                 tabindex="0">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="mb-20">
                                            <div class="col">
                                                <div class="mb-20">
                                                    <label for="liveClassDate" class="form-label">Live Class
                                                        Date</label>
                                                    <input id="liveClassDateRangePicker" name="dateRange" type="text"
                                                           class="form-control rounded-2"
                                                           placeholder="{{ __('select_date') }}">
                                                    <div class="nk-block-des text-danger">
                                                        <p class="dateRange_error error"></p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="nk-block-des text-danger">
                                                <p class="error">{{ $errors->first('dateRange') }}</p>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- End Date Range Picker -->

                                    <div class="col-lg-12">
                                        <div class="mb-3 d-flex">
                                            <label class="form-label">Meeting Method :</label>
                                            <div class="custom-radio mx-20">
                                                <label>
                                                    <input type="radio" name="LiveClassmeetingMethod"
                                                           value="zoom" {{$liveClass && $liveClass->meeting_method === 'zoom' ? 'checked' : '' }} >
                                                    <span class="ms-12">Zoom</span>
                                                </label>
                                            </div>

                                            <div class="custom-radio mx-20">
                                                <label>
                                                    <input type="radio" name="LiveClassmeetingMethod"
                                                           value="google_meet" {{$liveClass && $liveClass->meeting_method === 'google_meet' ? 'checked' : '' }} >
                                                    <span class="ms-12">Google Meet</span>
                                                </label>
                                            </div>

                                            <div class="custom-radio mx-20">
                                                <label>
                                                    <input type="radio" name="LiveClassmeetingMethod"
                                                           value="jitsi" {{$liveClass && $liveClass->meeting_method === 'jitsi' ? 'checked' : '' }} >
                                                    <span class="ms-12">Jitsi</span>
                                                </label>
                                            </div>

                                            <div class="custom-radio mx-20">
                                                <label>
                                                    <input type="radio" name="LiveClassmeetingMethod"
                                                           value="team" {{$liveClass && $liveClass->meeting_method === 'team' ? 'checked' : '' }} >
                                                    <span class="ms-12">Team</span>
                                                </label>
                                            </div>

                                            <div class="custom-radio mx-20">
                                                <label>
                                                    <input type="radio" name="LiveClassmeetingMethod"
                                                           value="microsoft_team" {{$liveClass && $liveClass->meeting_method === 'microsoft_team' ? 'checked' : '' }} >
                                                    <span class="ms-12">Microsoft Teams</span>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="nk-block-des text-danger">
                                            <p class="error">{{ $errors->first('LiveClassmeetingMethod') }}</p>
                                        </div>
                                    </div>
                                    <!-- End Meeting Method -->

                                    <div class="col-lg-12">
                                        <div class="mb-4">
                                            <label for="liveDescription" class="form-label">Description</label>
                                            <textarea class="form-control" id="liveDescription"
                                                      name="liveClassDescription"
                                                      style="height: 100px"> {{ $liveClass->description??  '' }}</textarea>
                                        </div>
                                        <div class="nk-block-des text-danger">
                                            <p class="error">{{ $errors->first('liveClassDescription') }}</p>
                                        </div>
                                    </div>
                                    <!-- End Description -->


                                    <div class="col-lg-12">
                                        <div class="mb-4">
                                            <label for="meetingLink" class="form-label">Meeting Link</label>
                                            <input type="text" class="form-control rounded-2"
                                                   name="LiveClassmeetingLink" id="meetingLink"
                                                   placeholder="https://"
                                                   value="{{ $liveClass->meeting_link ??  old('metting_link') }}">
                                            <div class="nk-block-des text-danger">
                                                <p class="error">{{ $errors->first('LiveClassmeetingLink') }}</p>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- End Meeting Link -->

                                    <div class="col-lg-6">
                                        <label for="MeetingID" class="form-label">Meeting ID</label>
                                        <input type="number" class="form-control rounded-2" name="LiveClassMeetingID"
                                               id="MeetingID"
                                               placeholder="756 3546 14256"
                                               value="{{ $liveClass->meeting_id ??  old('metting_id') }}">
                                        <div class="nk-block-des text-danger">
                                            <p class="error">{{ $errors->first('LiveClassMeetingID') }}</p>
                                        </div>
                                    </div>
                                    <!-- End Meeting ID -->

                                    <div class="col-lg-6">
                                        <label for="meetingPassword" class="form-label">Meeting Password</label>
                                        <input type="text" class="form-control rounded-2"
                                               name="LiveClassmeetingPassword" id="meetingPassword"
                                               placeholder="K465G465"
                                               value="{{ $liveClass->meeting_password ??  old('metting_password')}}">
                                        <div class="nk-block-des text-danger">
                                            <p class="error">{{ $errors->first('LiveClassmeetingPassword') }}</p>
                                        </div>
                                    </div>
                                    <!-- End Meeting Password -->

                                    <div class="col-lg-12">
                                        <div class="d-flex justify-content-between align-items-center mt-30">
                                            <a href="#" type="button"
                                               class="btn sg-btn-outline-primary btn_action"
                                               data-bs-target="#courseCurriculum">{{ __('back') }}</a>
                                            <a href="#" type="button" class="btn sg-btn-primary btn_action"
                                               data-bs-target="#courseAssignment">{{ __('next') }}</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- End Live Class Tab -->

                            <!-- Start assignment Tab -->
                            <div
                                class="tab-pane fade {{ $request_tab == 'assignment' ? 'show active' : '' }} {{ $step_1_error || $step_2_error || $step_3_error }}"
                                id="courseAssignment" role="tabpanel" aria-labelledby="assignment" tabindex="0">
                                <div class="row">
                                    <div class="col-lg-5 col-md-5 col-sm-12">
                                    </div>

                                    <div class="col-lg-7 col-md-7 col-sm-12">
                                        <div class="oftions-content-right mb-20">
                                            <a href="#" data-bs-toggle="modal" data-bs-target="#add_assignment"
                                               class="d-flex align-items-center button-default gap-2">
                                                <i class="las la-plus"></i>
                                                <span>{{ __('add_assignment') }}</span>
                                            </a>
                                        </div>
                                    </div>

                                    <div class="col-lg-12">
                                        <div class="default-list-table edit-course yajra-dataTable">
                                            {{ $dataTable->table() }}
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="d-flex justify-content-between align-items-center mt-30">
                                            <a href="#" type="button"
                                               class="btn sg-btn-outline-primary btn_action"
                                               data-bs-target="#courseCurriculum">{{ __('back') }}</a>
                                            <a href="#" type="button" class="btn sg-btn-primary btn_action"
                                               data-bs-target="#courseResource">{{ __('next') }}</a>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <!-- End Assignment Tab -->


                            <!-- Start Resource Tab -->
                            <div
                                class="tab-pane fade {{ $request_tab == 'resource' ? 'show active' : '' }} {{ $step_1_error || $step_2_error || $step_3_error }}"
                                id="courseResource" role="tabpanel" aria-labelledby="resource" tabindex="0">
                                <div class="row">
                                    <div class="col-lg-5 col-md-5 col-sm-12">
                                    </div>

                                    <div class="col-lg-7 col-md-7 col-sm-12">
                                        <div class="oftions-content-right mb-20">
                                            <a href="#" data-bs-toggle="modal" data-bs-target="#resourcesAddModal"
                                               class="d-flex align-items-center button-default gap-2">
                                                <i class="las la-plus"></i>
                                                <span>{{ __('add_resource') }}</span>
                                            </a>
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div id="resourceListContainer" class="row gy-20">
                                            @include('backend.admin.course.resource_list')
                                        </div>
                                    </div>


                                    <div class="col-lg-12">
                                        <div class="d-flex justify-content-between align-items-center mt-30">
                                            <a href="#" type="button"
                                               class="btn sg-btn-outline-primary btn_action"
                                               data-bs-target="#courseAssignment">{{ __('back') }}</a>
                                            <a href="#" type="button" class="btn sg-btn-primary btn_action"
                                               data-bs-target="#courseFAQ">{{ __('next') }}</a>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <!-- End Resource Tab -->

                            <!-- Start faq Tab -->
                            <div
                                class="tab-pane fade {{ $request_tab == 'faq' ? 'show active' : '' }} {{ $step_1_error || $step_2_error || $step_3_error }}"
                                id="courseFAQ" role="tabpanel" aria-labelledby="faq" tabindex="0">
                                <div class="row">
                                    <div class="col-lg-12">
                                        
                                        <!-- FAQ Image Upload -->
                                        <div class="card mb-4 mt-2 border-0 shadow-sm">
                                            <div class="card-body">
                                                <h5 class="card-title mb-3">{{ __('FAQ Section Image') }}</h5>
                                                <p class="text-muted mb-4">{{ __('Upload an image to display on the right side of the FAQ section on the single course page.') }}</p>
                                                @include('backend.common.media-input', [
                                                    'title' => __('FAQ Image'),
                                                    'name' => 'faq_image_media_id',
                                                    'col' => 'col-12',
                                                    'size' => '(800x600)',
                                                    'image' => old('faq_image_media_id', $course->faq_image_media_id),
                                                    'label' => __('FAQ Image'),
                                                    'edit' => $course,
                                                    'image_object' => $course->faq_image,
                                                    'media_id' => $course->faq_image_media_id,
                                                ])
                                            </div>
                                        </div>

                                        <div class="oftions-content-right mb-20">
                                            <a href="#" data-bs-toggle="modal" data-bs-target="#add_faq"
                                               class="button-default">{{ __('add_faq') }} <i
                                                    class="las la-plus"></i></a>
                                        </div>
                                        <div class="accordion accordion-v2" id="faqsContent">
                                            @foreach ($faqs as $key => $faq)
                                                <div class="accordion-item">
                                                    <h2 class="accordion-header" id="faq{{ $key }}">
                                                        <button class="accordion-button" type="button"
                                                                data-bs-toggle="collapse"
                                                                data-bs-target="#faq{{ $key }}Collapse"
                                                                aria-expanded="true"
                                                                aria-controls="faq{{ $key }}Collapse">
                                                            {{ $faq->question }}
                                                            <ul class="d-flex align-items-center gap-20">
                                                                <li data-bs-toggle="modal"
                                                                    data-bs-target="#faqsEditModal">
                                                                    <a class="icon edit_modal" href="javascript:void(0)"
                                                                       data-fetch_url="{{ route('faqs.edit', $faq->id) }}"
                                                                       data-route="{{ route('faqs.update', $faq->id) }}"
                                                                       data-modal="edit_faq"
                                                                       data-bs-custom-class="custom-tooltip"
                                                                       data-bs-toggle="tooltip" data-bs-placement="top"
                                                                       data-bs-title="{{ __('edit') }}"><i
                                                                            class="lar la-edit"></i></a>
                                                                </li>

                                                                <li><a href="javascript:void(0)"
                                                                       onclick="delete_row('{{ route('faqs.destroy', $faq->id) }}',null,true)"
                                                                       data-toggle="tooltip"
                                                                       data-original-title="{{ __('delete') }}"
                                                                       class="icon" data-bs-toggle="tooltip"
                                                                       data-bs-placement="top"
                                                                       data-bs-title="{{ __('delete') }}"><i
                                                                            class="las la-times"></i></a></li>
                                                            </ul>
                                                        </button>
                                                    </h2>
                                                    <div id="faq{{ $key }}Collapse"
                                                         class="accordion-collapse collapse {{ $key == 0 ? 'show' : '' }}"
                                                         aria-labelledby="faq{{ $key }}"
                                                         data-bs-parent="#faqsContent">
                                                        <div class="accordion-body">
                                                            <div class="row">
                                                                <div class="col-lg-12">
                                                                    <div class="faqAns">
                                                                        <p>{!! $faq->answer !!}</p>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>

                                    <div class="col-lg-12">
                                        <div class="d-flex justify-content-between align-items-center mt-30">
                                            <a href="#" type="button"
                                               class="btn sg-btn-outline-primary btn_action"
                                               data-bs-target="#courseResource">{{ __('back') }}</a>


                                            <div class="d-flex align-items-center gap-3">
                                                 <a href="#" type="button"
                                                    class="btn sg-btn-primary btn_action"
                                                    data-bs-target="#courseMasterclass">{{ __('next') }}</a>

                                                <button type="submit"
                                                        class="btn sg-btn-primary mr-1">{{ __('update') }}</button>

                                                <button type="submit" name="save_and_published" value="1"
                                                        class="btn sg-btn-primary">{{ __('save_&_publish') }}</button>
                                            </div>


                                            @include('backend.common.loading-btn', [
                                                'class' => 'btn sg-btn-primary',
                                            ])
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- End FAQ Tab -->

                            <!-- Start Masterclass Landing Tab -->
                            <div class="tab-pane fade {{ $request_tab == 'masterclass' ? 'show active' : '' }}"
                                 id="courseMasterclass" role="tabpanel" aria-labelledby="masterclass" tabindex="0">
                                @php
                                    $mcSettings = is_array($course->masterclass_settings) ? $course->masterclass_settings : json_decode($course->masterclass_settings ?? '[]', true);
                                    if(!is_array($mcSettings)) $mcSettings = [];

                                    $defEyebrow = !empty($mcSettings['eyebrow_title']) ? $mcSettings['eyebrow_title'] : ($category ? $category->lang_title : 'E-commerce শুরু করার hidden path');
                                    $defPrimaryCta = !empty($mcSettings['primary_cta_text']) ? $mcSettings['primary_cta_text'] : 'রেজিস্ট্রেশন করুন এখনই';
                                    $defVideoCaption = !empty($mcSettings['video_caption']) ? $mcSettings['video_caption'] : 'বিস্তারিত জানতে ভিডিওটি দেখুন';
                                    $defRemainingSeats = !empty($mcSettings['remaining_seats']) ? $mcSettings['remaining_seats'] : ($course->capacity > 0 ? max(0, $course->capacity - $course->total_enrolled) : '72');

                                    $defGoldBadgeTop = !empty($mcSettings['gold_badge_top']) ? $mcSettings['gold_badge_top'] : 'এখনই সিট বুক করুন';
                                    $defZoomTitle = !empty($mcSettings['zoom_title']) ? $mcSettings['zoom_title'] : 'Zoom লাইভ 104';
                                    $defZoomSubtitle = !empty($mcSettings['zoom_subtitle']) ? $mcSettings['zoom_subtitle'] : 'অনলাইন ইন্টারেক্টিভ সেশন';
                                    $defScheduleLabel = !empty($mcSettings['schedule_label']) ? $mcSettings['schedule_label'] : 'সময় / সময়সূচী';
                                    $defScheduleValue = !empty($mcSettings['schedule_value']) ? $mcSettings['schedule_value'] : (!empty($course->duration) ? $course->duration : '2h 40min');
                                    $defLevelLabel = !empty($mcSettings['level_label']) ? $mcSettings['level_label'] : 'Level';
                                    $defLevelValue = !empty($mcSettings['level_value']) ? $mcSettings['level_value'] : ($level ? $level->lang_title : 'beginner');
                                    $defGoldOfferTitle = !empty($mcSettings['gold_offer_title']) ? $mcSettings['gold_offer_title'] : 'আজকের স্পেশাল অফার';
                                    $defOriginalPriceLabel = !empty($mcSettings['original_price_label']) ? $mcSettings['original_price_label'] : 'মূল প্রাইস';
                                    $defGoldCtaText = !empty($mcSettings['gold_cta_text']) ? $mcSettings['gold_cta_text'] : 'এখনই জয়েন করুন';
                                    $defGoldSeatsText = !empty($mcSettings['gold_seats_text']) ? $mcSettings['gold_seats_text'] : 'আর মাত্র ' . $defRemainingSeats . ' সিট বাকি';

                                    $defBenefitsTitle = !empty($mcSettings['benefits_title']) ? $mcSettings['benefits_title'] : 'এই মাস্টারক্লাস কার জন্য?';
                                    
                                    $benefitsList = [];
                                    if (!empty($mcSettings['benefits_list']) && is_array($mcSettings['benefits_list'])) {
                                        $benefitsList = array_values(array_filter(array_map('trim', $mcSettings['benefits_list'])));
                                    } elseif (!empty($mcSettings['benefits_items'])) {
                                        $lines = array_filter(array_map('trim', explode("\n", $mcSettings['benefits_items'])));
                                        $benefitsList = array_values($lines);
                                    } elseif (!empty($course->what_will_learn)) {
                                        $lines = array_filter(array_map('trim', explode("\n", strip_tags($course->what_will_learn))));
                                        $benefitsList = array_values($lines);
                                    }
                                    if (empty($benefitsList)) {
                                        $benefitsList = [
                                            'অনলাইন বিজনেস করতে চান কিন্তু কনফিউজড',
                                            'পুঁজি কম নিয়ে বিজনেস শুরু করতে চাচ্ছেন',
                                            'ই-কমার্স বিজনেস শুরু করার ভয় আছে',
                                            'লস না করে সঠিকভাবে শুরু করতে চান',
                                        ];
                                    }

                                    $defGiftBadge = !empty($mcSettings['gift_badge']) ? $mcSettings['gift_badge'] : '🎁 যারা join করবেন তাদের জন্য special gift';
                                    $defGiftTitle = !empty($mcSettings['gift_title']) ? $mcSettings['gift_title'] : '৳১০,০০০ টাকার Ecom Dropshipping Mastery Course — সম্পূর্ণ FREE করার সুযোগ';
                                    $defGiftValue = !empty($mcSettings['gift_value']) ? $mcSettings['gift_value'] : '৳১০,০০০';
                                    $defGiftDescription = !empty($mcSettings['gift_description']) ? $mcSettings['gift_description'] : 'এই master class-এ যারা join করবেন, তারা আমার ৳১০,০০০ টাকার Ecom Dropshipping Mastery Course টা free তে করার সুযোগ পাবেন। মাস্টারক্লাসে এই বিষয়ে বিস্তারিত আলোচনা।';
                                    $defGiftQuote = !empty($mcSettings['gift_quote']) ? $mcSettings['gift_quote'] : '"এই কোর্সে আমি ই-কমার্স বিজনেস, ডিজিটাল মার্কেটিং এর বিভিন্ন বিষয় যেমন Facebook Ads, Google Ads নিয়ে বিস্তারিত শিখিয়েছি। এছাড়াও কিভাবে একটা বিজনেসকে Scale করতে তা নিয়ে ক্লাস আছে।"';
                                    $defGiftFooterNote = !empty($mcSettings['gift_footer_note']) ? $mcSettings['gift_footer_note'] : 'যারা একদম নতুন আছেন তারাও এই কোর্স থেকে বেনিফিটেড হতে পারবে।';
                                    $defGiftCtaText = !empty($mcSettings['gift_cta_text']) ? $mcSettings['gift_cta_text'] : 'সিট কনফার্ম করুন →';

                                    $defScheduleBadge = !empty($mcSettings['schedule_badge']) ? $mcSettings['schedule_badge'] : 'LIVE ZOOM MASTERCLASS';
                                    $defClassScheduleTitle = !empty($mcSettings['class_schedule_title']) ? $mcSettings['class_schedule_title'] : '২ দিনব্যাপী e-commerce live masterclass';
                                    $defClassScheduleTime = !empty($mcSettings['class_schedule_time']) ? $mcSettings['class_schedule_time'] : '৬ আগস্ট তারিখ রাত ৮ টায় শুরু';

                                    $defExplainerTitle = !empty($mcSettings['explainer_title']) ? $mcSettings['explainer_title'] : 'একটা প্রশ্ন আপনার মাথায় আসতে পারে — এত কিছু, মাত্র ৯৯ টাকায় কেন??';
                                    $defExplainerText = !empty($mcSettings['explainer_text']) ? $mcSettings['explainer_text'] : '<p>টু বি অনেস্ট, আমি এই masterclass-টা সম্পূর্ণ free করাতে চেয়েছিলাম।</p><p>কিন্তু problem হচ্ছে — আমার free session-গুলোতে দেখা যায় কয়েক হাজার মানুষ register করে বা join করে। যেহেতু এই session-টা Zoom-এ live হবে, তাই আমি চাইলেও এখানে বেশি মানুষ নিতে পারব না। Seat limit থাকবে।</p><p>তাই আমি এখানে ছোট্ট একটা token amount রেখেছি — শুধু audience filter করার জন্য। যেন এই masterclass-এ তারাই join করে, যারা সত্যিই e-commerce business শুরু করার ব্যাপারে serious এবং step-by-step process-টা মনোযোগ দিয়ে শিখতে ready।</p>';

                                    $defBreakdownSubheading = !empty($mcSettings['breakdown_subheading']) ? $mcSettings['breakdown_subheading'] : 'এই $15.00 টাকায় আপনি পাচ্ছেন:';
                                    $defBreakdownTodayTitle = !empty($mcSettings['breakdown_today_title']) ? $mcSettings['breakdown_today_title'] : 'আজকের মূল্য (token)';
                                    $defBreakdownItems = !empty($mcSettings['breakdown_items']) ? $mcSettings['breakdown_items'] : "🎓 ২ দিনের live masterclass — সম্পূর্ণ roadmap সহ | ৳৩,০০০\n🎁 Ecom Dropshipping Mastery Course free পাওয়ার সুযোগ | ৳১০,০০০";

                                    $defOrderFormTitle = !empty($mcSettings['order_form_title']) ? $mcSettings['order_form_title'] : 'মাস্টারক্লাসে জয়েন করতে নিচের ফর্মটি পূরণ করুন';
                                    $defOrderFormSubtitle = !empty($mcSettings['order_form_subtitle']) ? $mcSettings['order_form_subtitle'] : 'Give valid information';
                                    $defNameLabel = !empty($mcSettings['name_label']) ? $mcSettings['name_label'] : 'Your Full Name';
                                    $defNamePlaceholder = !empty($mcSettings['name_placeholder']) ? $mcSettings['name_placeholder'] : 'আপনার সম্পূর্ণ নাম';
                                    $defPhoneLabel = !empty($mcSettings['phone_label']) ? $mcSettings['phone_label'] : 'Mobile Number';
                                    $defPhonePlaceholder = !empty($mcSettings['phone_placeholder']) ? $mcSettings['phone_placeholder'] : '01XXXXXXXXX';
                                    $defEmailLabel = !empty($mcSettings['email_label']) ? $mcSettings['email_label'] : 'Email address';
                                    $defEmailPlaceholder = !empty($mcSettings['email_placeholder']) ? $mcSettings['email_placeholder'] : 'আপনার ইমেইল এড্রেস';
                                    $defOrderSummaryTitle = !empty($mcSettings['order_summary_title']) ? $mcSettings['order_summary_title'] : 'Your order';
                                    $defPayNowBtnText = !empty($mcSettings['pay_now_btn_text']) ? $mcSettings['pay_now_btn_text'] : 'PAY NOW';
                                    $defPrivacyNotice = !empty($mcSettings['privacy_notice']) ? $mcSettings['privacy_notice'] : 'Your personal data will be used to process your order, support your experience throughout this website, and for other purposes described in our privacy policy.';

                                    $defFaqTitle = !empty($mcSettings['faq_title']) ? $mcSettings['faq_title'] : 'কিছু সাধারণ প্রশ্নের উত্তর';

                                    $faqList = [];
                                    if (!empty($mcSettings['faq_list']) && is_array($mcSettings['faq_list'])) {
                                        $faqList = $mcSettings['faq_list'];
                                    } elseif (!empty($mcSettings['faq_items'])) {
                                        $lines = array_filter(array_map('trim', explode("\n", $mcSettings['faq_items'])));
                                        foreach ($lines as $line) {
                                            $parts = explode('|', $line);
                                            if (isset($parts[0]) && isset($parts[1])) {
                                                $faqList[] = [
                                                    'question' => trim($parts[0]),
                                                    'answer'   => trim($parts[1])
                                                ];
                                            }
                                        }
                                    }
                                    if (empty($faqList)) {
                                        $faqList = [
                                            ['question' => 'লাইভ ক্লাসে কিভাবে যুক্ত হবো?', 'answer' => 'আপনি পেমেন্ট করার পর আপনাকে আমাদের একটা প্রাইভেট গ্রুপে জয়েন করানো হবে, এবং যেদিন লাইভ ক্লাসগুলো হবে সেদিন আপনাকে জুমের লিংক শেয়ার করা হবে'],
                                            ['question' => 'লাইভ ক্লাসগুলো কত ঘন্টার হবে?', 'answer' => 'এইটা সঠিক ভাবে বলা যাচ্ছে না, যে টাইম দেয়া আছে ঠিক সেই সময়েই শুরু হবে কিন্তু শেষ হবে আপনাদের ইচ্ছায়। যতক্ষণ আপনাদের প্রয়োজন আমি লাইভে থাকবো ইনশাআল্লাহ্'],
                                            ['question' => 'মাষ্টার ক্লাসটিতে ডিস্কাউন্ট দেয়া যাবে না?', 'answer' => 'বর্তমানে বিশাল ডিস্কাউন্ট দেয়া আছে তবে প্রতিনিয়ত প্রোগ্রামটির মূল্য কিছু কিছু করে বাড়ানো হবে। তাই যত দ্রুত যুক্ত হবেন তত বেশি আপনারই লাভ।'],
                                        ];
                                    }

                                    $defDualCtaLeft = !empty($mcSettings['dual_cta_left']) ? $mcSettings['dual_cta_left'] : 'রেজিস্ট্রেশন করুন এখনই';
                                    $defDualCtaSeats = !empty($mcSettings['dual_cta_seats']) ? $mcSettings['dual_cta_seats'] : 'আর মাত্র ' . $defRemainingSeats . ' সিট বাকি';
                                @endphp
                                
                                <div class="row gx-20">
                                    <div class="col-12 mb-3">
                                        <h5 class="fw-bold text-dark border-bottom pb-2 mb-0">{{ __('Masterclass Landing Page Settings') }}</h5>
                                    </div>

                                    <!-- Section 1: Hero Header -->
                                    <div class="col-12 mb-2">
                                        <h6 class="fw-bold text-primary mb-3"><i class="fas fa-bullhorn me-1"></i> Section 1: Hero Header & Video Media</h6>
                                    </div>

                                    <div class="col-lg-6 col-md-6 mb-4">
                                        <label class="form-label fw-bold">Eyebrow Badge Text</label>
                                        <input type="text" name="masterclass_settings[eyebrow_title]" class="form-control rounded-2"
                                               value="{{ $defEyebrow }}" placeholder="E-commerce শুরু করার hidden path">
                                    </div>

                                    <div class="col-lg-6 col-md-6 mb-4">
                                        <label class="form-label fw-bold">Primary CTA Button Text</label>
                                        <input type="text" name="masterclass_settings[primary_cta_text]" class="form-control rounded-2"
                                               value="{{ $defPrimaryCta }}" placeholder="রেজিস্ট্রেশন করুন এখনই">
                                    </div>

                                    <div class="col-lg-6 col-md-6 mb-4">
                                        <label class="form-label fw-bold">Video Instruction Caption</label>
                                        <input type="text" name="masterclass_settings[video_caption]" class="form-control rounded-2"
                                               value="{{ $defVideoCaption }}" placeholder="বিস্তারিত জানতে ভিডিওটি দেখুন">
                                    </div>

                                    <div class="col-lg-6 col-md-6 mb-4">
                                        <label class="form-label fw-bold">Remaining Seats Urgency Count</label>
                                        <input type="text" name="masterclass_settings[remaining_seats]" class="form-control rounded-2"
                                               value="{{ $defRemainingSeats }}" placeholder="72">
                                    </div>

                                    <!-- Section 2: Gold Offer Card -->
                                    <div class="col-12 mb-2 mt-3">
                                        <h6 class="fw-bold text-primary mb-3"><i class="fas fa-crown me-1"></i> Section 2: Gold Info Card Settings</h6>
                                    </div>

                                    <div class="col-lg-4 col-md-6 mb-4">
                                        <label class="form-label fw-bold">Top Gold Offer Badge</label>
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
                                        <label class="form-label fw-bold">Gold Offer Title</label>
                                        <input type="text" name="masterclass_settings[gold_offer_title]" class="form-control rounded-2"
                                               value="{{ $defGoldOfferTitle }}" placeholder="আজকের স্পেশাল অফার">
                                    </div>

                                    <div class="col-lg-4 col-md-6 mb-4">
                                        <label class="form-label fw-bold">Original Price Label</label>
                                        <input type="text" name="masterclass_settings[original_price_label]" class="form-control rounded-2"
                                               value="{{ $defOriginalPriceLabel }}" placeholder="মূল প্রাইস">
                                    </div>

                                    <div class="col-lg-6 col-md-6 mb-4">
                                        <label class="form-label fw-bold">Gold Card CTA Text</label>
                                        <input type="text" name="masterclass_settings[gold_cta_text]" class="form-control rounded-2"
                                               value="{{ $defGoldCtaText }}" placeholder="এখনই জয়েন করুন">
                                    </div>

                                    <div class="col-lg-6 col-md-6 mb-4">
                                        <label class="form-label fw-bold">Gold Card Remaining Seats</label>
                                        <input type="text" name="masterclass_settings[gold_seats_text]" class="form-control rounded-2"
                                               value="{{ $defGoldSeatsText }}" placeholder="আর মাত্র 72 সিট বাকি">
                                    </div>

                                    <!-- Section 3: Benefits Section -->
                                    <div class="col-12 mb-2 mt-3">
                                        <div class="d-flex align-items-center justify-content-between">
                                            <h6 class="fw-bold text-primary m-0"><i class="fas fa-check-circle me-1"></i> Section 3: Benefits & Target Audience</h6>
                                            <button type="button" class="button-default" id="add_new_benefit_btn">
                                                Add New Benefit Point <i class="las la-plus ms-1"></i>
                                            </button>
                                        </div>
                                    </div>

                                    <div class="col-lg-12 mb-4">
                                        <label class="form-label fw-bold">Benefits Heading</label>
                                        <input type="text" name="masterclass_settings[benefits_title]" class="form-control rounded-2"
                                               value="{{ $defBenefitsTitle }}" placeholder="এই মাস্টারক্লাস কার জন্য?">
                                    </div>

                                    <div class="col-12 mb-4">
                                        <label class="form-label fw-bold text-dark mb-2">Benefit Items</label>
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

                                    <!-- Section 4: Special Bonus Gift -->
                                    <div class="col-12 mb-2 mt-3">
                                        <h6 class="fw-bold text-primary mb-3"><i class="fas fa-gift me-1"></i> Section 4: Special Gift Banner Offer</h6>
                                    </div>

                                    <div class="col-12 mb-3">
                                        <div class="form-check">
                                            <input type="checkbox" name="masterclass_settings[hide_special_gift]" value="1" class="form-check-input" id="hide_gift"
                                                {{ !empty($mcSettings['hide_special_gift']) ? 'checked' : '' }}>
                                            <label class="form-check-label fw-bold" for="hide_gift">Hide Special Gift Banner Card</label>
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

                                    <div class="col-lg-6 col-md-6 mb-4">
                                        <label class="form-label fw-bold">Gift Red CTA Text</label>
                                        <input type="text" name="masterclass_settings[gift_cta_text]" class="form-control rounded-2"
                                               value="{{ $defGiftCtaText }}" placeholder="সিট কনফার্ম করুন →">
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

                                    <div class="col-lg-12 col-md-12 mb-4">
                                        <label class="form-label fw-bold">Gift Footer Note Text</label>
                                        <input type="text" name="masterclass_settings[gift_footer_note]" class="form-control rounded-2"
                                               value="{{ $defGiftFooterNote }}" placeholder="যারা একদম নতুন আছেন তারাও এই কোর্স থেকে বেনিফিটেড হতে পারবে।">
                                    </div>

                                    <!-- Section 5: Schedule & Token Fee Explainer -->
                                    <div class="col-12 mb-2 mt-3">
                                        <h6 class="fw-bold text-primary mb-3"><i class="fas fa-calendar-alt me-1"></i> Section 5 & 6: Schedule & Token Fee Explainer</h6>
                                    </div>

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
                                        <label class="form-label fw-bold">Live Schedule Time</label>
                                        <input type="text" name="masterclass_settings[class_schedule_time]" class="form-control rounded-2"
                                               value="{{ $defClassScheduleTime }}" placeholder="৬ আগস্ট তারিখ রাত ৮ টায় শুরু">
                                    </div>

                                    <div class="col-12 mb-3">
                                        <div class="form-check">
                                            <input type="checkbox" name="masterclass_settings[hide_explainer]" value="1" class="form-check-input" id="hide_exp"
                                                {{ !empty($mcSettings['hide_explainer']) ? 'checked' : '' }}>
                                            <label class="form-check-label fw-bold" for="hide_exp">Hide Token Fee Explainer Box</label>
                                        </div>
                                    </div>

                                    <div class="col-lg-12 col-md-12 mb-4">
                                        <label class="form-label fw-bold">Explainer Title</label>
                                        <input type="text" name="masterclass_settings[explainer_title]" class="form-control rounded-2"
                                               value="{{ $defExplainerTitle }}" placeholder="একটা প্রশ্ন আপনার মাথায় আসতে পারে — এত কিছু, মাত্র ৯৯ টাকায় কেন??">
                                    </div>

                                    <div class="col-lg-12 col-md-12 mb-4">
                                        <label class="form-label fw-bold">Explainer Content (WYSIWYG Rich Text)</label>
                                        <textarea name="masterclass_settings[explainer_text]" class="form-control rounded-2 summernote" rows="5">{{ $defExplainerText }}</textarea>
                                    </div>

                                    <!-- Section 7: Price Breakdown Table -->
                                    <div class="col-12 mb-2 mt-3">
                                        <h6 class="fw-bold text-primary mb-3"><i class="fas fa-list-alt me-1"></i> Section 7: Price Breakdown Table</h6>
                                    </div>

                                    <div class="col-12 mb-3">
                                        <div class="form-check">
                                            <input type="checkbox" name="masterclass_settings[hide_breakdown]" value="1" class="form-check-input" id="hide_bd"
                                                {{ !empty($mcSettings['hide_breakdown']) ? 'checked' : '' }}>
                                            <label class="form-check-label fw-bold" for="hide_bd">Hide Price Breakdown Table</label>
                                        </div>
                                    </div>

                                    <div class="col-lg-6 col-md-6 mb-4">
                                        <label class="form-label fw-bold">Breakdown Subheading</label>
                                        <input type="text" name="masterclass_settings[breakdown_subheading]" class="form-control rounded-2"
                                               value="{{ $defBreakdownSubheading }}" placeholder="এই $15.00 টাকায় আপনি পাচ্ছেন:">
                                    </div>

                                    <div class="col-lg-6 col-md-6 mb-4">
                                        <label class="form-label fw-bold">Today Token Price Title</label>
                                        <input type="text" name="masterclass_settings[breakdown_today_title]" class="form-control rounded-2"
                                               value="{{ $defBreakdownTodayTitle }}" placeholder="আজকের মূল্য (token)">
                                    </div>

                                    <div class="col-lg-12 col-md-12 mb-4">
                                        <label class="form-label fw-bold">Breakdown Items (Item Title | Price Value)</label>
                                        <textarea name="masterclass_settings[breakdown_items]" class="form-control rounded-2" rows="4"
                                                  placeholder="🎓 ২ দিনের live masterclass — সম্পূর্ণ roadmap সহ | ৳৩,০০০&#10;🎁 Ecom Dropshipping Mastery Course free পাওয়ার সুযোগ | ৳১০,০০০">{{ $defBreakdownItems }}</textarea>
                                        <small class="text-muted">Format: <code>Item Title | Price Value</code> per line</small>
                                    </div>

                                    <!-- Section 8: Registration Form & FAQs -->
                                    <div class="col-12 mb-2 mt-3">
                                        <h6 class="fw-bold text-primary mb-3"><i class="fas fa-user-edit me-1"></i> Section 8 & 9: Registration Order Form & FAQs</h6>
                                    </div>

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
                                        <label class="form-label fw-bold">Full Name Label</label>
                                        <input type="text" name="masterclass_settings[name_label]" class="form-control rounded-2"
                                               value="{{ $defNameLabel }}" placeholder="Your Full Name">
                                    </div>

                                    <div class="col-lg-4 col-md-6 mb-4">
                                        <label class="form-label fw-bold">Mobile Number Label</label>
                                        <input type="text" name="masterclass_settings[phone_label]" class="form-control rounded-2"
                                               value="{{ $defPhoneLabel }}" placeholder="Mobile Number">
                                    </div>

                                    <div class="col-lg-4 col-md-6 mb-4">
                                        <label class="form-label fw-bold">Email Address Label</label>
                                        <input type="text" name="masterclass_settings[email_label]" class="form-control rounded-2"
                                               value="{{ $defEmailLabel }}" placeholder="Email address">
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
                                        <label class="form-label fw-bold">Privacy Policy Notice</label>
                                        <textarea name="masterclass_settings[privacy_notice]" class="form-control rounded-2" rows="2"
                                                  placeholder="Your personal data will be used to process your order...">{{ $defPrivacyNotice }}</textarea>
                                    </div>

                                    <div class="col-lg-12 col-md-12 mb-4">
                                        <div class="d-flex align-items-center justify-content-between mb-2">
                                            <label class="form-label fw-bold text-dark m-0">FAQ Section Main Title</label>
                                            <a href="#" data-bs-toggle="modal" data-bs-target="#add_faq" class="button-default py-1 px-3">
                                                {{ __('add_faq') }} <i class="las la-plus ms-1"></i>
                                            </a>
                                        </div>
                                        <input type="text" name="masterclass_settings[faq_title]" class="form-control rounded-2"
                                               value="{{ $defFaqTitle }}" placeholder="কিছু সাধারণ প্রশ্নের উত্তর">
                                    </div>

                                    <div class="col-12 mb-4">
                                        <label class="form-label fw-bold text-dark mb-2">Course Official FAQs</label>
                                        @if(count($faqs) > 0)
                                            <div class="accordion accordion-v2" id="mcFaqsContent">
                                                @foreach ($faqs as $key => $faq)
                                                    <div class="accordion-item border rounded-3 mb-2 overflow-hidden">
                                                        <h2 class="accordion-header" id="mcFaqHead{{ $key }}">
                                                            <button class="accordion-button collapsed py-2 px-3 bg-light" type="button"
                                                                    data-bs-toggle="collapse"
                                                                    data-bs-target="#mcFaqCollapse{{ $key }}"
                                                                    aria-expanded="false">
                                                                <span class="fw-bold text-dark me-auto"><i class="fas fa-question-circle text-primary me-2"></i>{{ $faq->question }}</span>
                                                                <div class="d-flex align-items-center gap-2 ms-3" onclick="event.stopPropagation();">
                                                                    <a class="btn btn-sm btn-outline-primary py-1 px-2 edit_modal" href="javascript:void(0)"
                                                                       data-fetch_url="{{ route('faqs.edit', $faq->id) }}"
                                                                       data-route="{{ route('faqs.update', $faq->id) }}"
                                                                       data-modal="edit_faq"
                                                                       data-bs-toggle="modal"
                                                                       data-bs-target="#faqsEditModal">
                                                                        <i class="lar la-edit me-1"></i> {{ __('edit') }}
                                                                    </a>
                                                                    <a href="javascript:void(0)"
                                                                       onclick="delete_row('{{ route('faqs.destroy', $faq->id) }}',null,true)"
                                                                       class="btn btn-sm btn-outline-danger py-1 px-2">
                                                                        <i class="las la-trash-alt me-1"></i> {{ __('delete') }}
                                                                    </a>
                                                                </div>
                                                            </button>
                                                        </h2>
                                                        <div id="mcFaqCollapse{{ $key }}"
                                                             class="accordion-collapse collapse"
                                                             data-bs-parent="#mcFaqsContent">
                                                            <div class="accordion-body p-3 bg-white">
                                                                <p class="m-0 text-muted">{!! $faq->answer !!}</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        @else
                                            <div class="alert alert-warning py-3 text-center rounded-3">
                                                <p class="mb-2"><i class="fas fa-exclamation-triangle me-1"></i> কোনো FAQ পাওয়া যায়নি। নিচে <strong>+ Add FAQ</strong> বাটনে ক্লিক করে নতুন প্রশ্ন যোগ করুন।</p>
                                                <a href="#" data-bs-toggle="modal" data-bs-target="#add_faq" class="button-default d-inline-flex align-items-center">
                                                    {{ __('add_faq') }} <i class="las la-plus ms-1"></i>
                                                </a>
                                            </div>
                                        @endif
                                    </div>

                                    <!-- Section 10, 11, 12: Dual CTA & Visibility -->
                                    <div class="col-12 mb-2 mt-3">
                                        <h6 class="fw-bold text-primary mb-3"><i class="fas fa-sliders-h me-1"></i> Section 10, 11 & 12: Dual CTA & Display Toggles</h6>
                                    </div>

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

                                    <div class="col-lg-6 col-md-6 mb-3">
                                        <div class="form-check">
                                            <input type="checkbox" name="masterclass_settings[hide_reviews]" value="1" class="form-check-input" id="hide_rev"
                                                {{ !empty($mcSettings['hide_reviews']) ? 'checked' : '' }}>
                                            <label class="form-check-label fw-bold" for="hide_rev">Hide Reviews Section from Landing Page</label>
                                        </div>
                                    </div>

                                    <div class="col-lg-6 col-md-6 mb-3">
                                        <div class="form-check">
                                            <input type="checkbox" name="masterclass_settings[hide_related_courses]" value="1" class="form-check-input" id="hide_rel"
                                                {{ !empty($mcSettings['hide_related_courses']) ? 'checked' : '' }}>
                                            <label class="form-check-label fw-bold" for="hide_rel">Hide Related Courses Section from Landing Page</label>
                                        </div>
                                    </div>

                                    <div class="col-lg-12">
                                        <div class="d-flex justify-content-between align-items-center mt-30">
                                            <a href="#" class="btn sg-btn-outline-primary btn_action" data-bs-target="#courseFAQ">{{ __('back') }}</a>
                                            <button type="submit" class="btn sg-btn-primary">{{ __('update') }}</button>
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
    @include('backend.admin.course.modals')
    @include('backend.common.delete-script')
    @include('backend.common.gallery-modal')
@endsection
@push('css_asset')
    <link rel="stylesheet" href="{{ static_asset('admin/css/dropzone.min.css') }}">
    <link rel="stylesheet" href="{{ static_asset('admin/css/daterangepicker.css') }}">
    <link rel="stylesheet" href="{{ static_asset('admin/css/bootstrap-datepicker.min.css') }}">
@endpush
@push('js_asset')
    <!--====== media.js ======-->
    <script src="{{ static_asset('admin/js/axios.min.js') }}"></script>
    <script src="{{ static_asset('admin/js/dropzone.min.js') }}"></script>
    <script src="{{ static_asset('admin/js/moment.min.js') }}"></script>
    <script src="{{ static_asset('admin/js/daterangepicker.js') }}"></script>
    <script src="{{ static_asset('admin/js/sortable.min.js') }}"></script>
    <script src="{{ static_asset('admin/js/bootstrap-datepicker.min.js') }}"></script>
@endpush
@push('js')
    {{ $dataTable->scripts() }}
    <script src="{{ static_asset('admin/js/media.js?ver=1.0.0') }}"></script>
    <script src="{{ static_asset('admin/js/ai_writer.js') }}"></script>
    <script>
        let section_id = '';
        var numbeonelive = 7;
        var numbeone = 6;
        var numbertwoLive = 8;
        var numbertwo = 7;
        var numberthreeLive = 9;
        var numberThree = 8;
        $(document).ready(function () {
            searchCategory($('#select_category'));
            searchOrganization($('#ins_by_org'));
            searchSubjects($('#select_subject'));
            $(document).on('click', "#mgCourse-tabContent a.btn_action, .mc-step-btn", function (e) {
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

            $(document).on('click', '.tab_change', function () {
                let href = $(this).attr('href');
                if (href && href.indexOf('tab=') !== -1) {
                    let tabName = href.split('tab=')[1];
                    changeUrl('tab', tabName);
                }
            });
            $(document).on('click', '#add_new_benefit_btn', function () {
                let count = $('#benefits_items_container .benefit-single-item').length;
                let html = `
                    <div class="benefit-single-item d-flex align-items-center gap-2 mb-3">
                        <span class="badge bg-secondary p-2"><i class="fas fa-check"></i> #<span class="benefit-num">${count + 1}</span></span>
                        <input type="text" name="masterclass_settings[benefits_list][]" class="form-control rounded-2 bg-white" placeholder="সুবিধা / পয়েন্টটি লিখুন...">
                        <button type="button" class="btn btn-outline-danger remove-benefit-btn px-3">
                            <i class="fas fa-trash-alt"></i>
                        </button>
                    </div>
                `;
                $('#benefits_items_container').append(html);
            });

            $(document).on('click', '.remove-benefit-btn', function () {
                $(this).closest('.benefit-single-item').remove();
                $('#benefits_items_container .benefit-single-item').each(function (i) {
                    $(this).find('.benefit-num').text(i + 1);
                });
            });

            $(document).on('click', '#add_new_faq_btn', function () {
                let index = $('#faq_items_container .faq-single-item').length;
                let html = `
                    <div class="faq-single-item card border mb-3 bg-light rounded-3 p-3 position-relative">
                        <div class="d-flex align-items-center justify-content-between mb-3 border-bottom pb-2">
                            <span class="fw-bold text-primary fs-6"><i class="fas fa-question-circle me-1"></i> FAQ Question #<span class="faq-num">${index + 1}</span></span>
                            <button type="button" class="btn btn-sm btn-outline-danger remove-faq-btn py-1 px-2">
                                <i class="fas fa-trash-alt me-1"></i> Delete
                            </button>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold small text-dark">Question (প্রশ্ন)</label>
                            <input type="text" name="masterclass_settings[faq_list][${index}][question]" class="form-control rounded-2 bg-white" placeholder="প্রশ্নটি লিখুন...">
                        </div>
                        <div>
                            <label class="form-label fw-bold small text-dark">Answer (উত্তর)</label>
                            <textarea name="masterclass_settings[faq_list][${index}][answer]" class="form-control rounded-2 bg-white" rows="2" placeholder="উত্তরটি লিখুন..."></textarea>
                        </div>
                    </div>
                `;
                $('#faq_items_container').append(html);
            });

            $(document).on('click', '.remove-faq-btn', function () {
                $(this).closest('.faq-single-item').remove();
                $('#faq_items_container .faq-single-item').each(function (i) {
                    $(this).find('.faq-num').text(i + 1);
                });
            });
            /*$(document).on('click', "#select_subject", function () {
                searchSubjects($('#select_subject'));
            });*/

            let sections = document.getElementById("editCourse");
            if (sections) {
                new Sortable(sections, {
                    handle: '.listMove',
                    animation: 150,
                    onSort: function (evt) {
                        let form = {
                            _token: '{{ csrf_token() }}',
                            ids: [],
                            course_id: '{{ $course->id }}',
                        };
                        let nodes = evt.from.childNodes;

                        $.each(nodes, function (index, value) {
                            if ($(this).hasClass('accordion-item')) {
                                form.ids.push($(this).data('id'));
                            }
                        });
                        $.ajax({
                            url: '{{ route('course.sections.order') }}',
                            type: 'POST',
                            data: form,
                            success: function (data) {
                                if (data.error) {
                                    toastr.error(data.error);
                                }
                            },
                            error: function (data) {
                                toastr.error('Something went wrong');
                            }
                        });
                    },
                });
            }
            let lessons = document.getElementById("lesson_sortable");
            if (lessons) {
                new Sortable(lessons, {
                    handle: '.lessonMove',
                    animation: 150,
                    onSort: function (evt) {
                        let form = {
                            _token: '{{ csrf_token() }}',
                            ids: [],
                            section_id: section_id,
                        };
                        let nodes = evt.from.childNodes;

                        $.each(nodes, function (index, value) {
                            if ($(this).hasClass('list-view')) {
                                form.ids.push($(this).data('id'));
                            }
                        });
                        $.ajax({
                            url: '{{ route('section.lessons.order') }}',
                            type: 'POST',
                            data: form,
                            success: function (data) {
                                if (data.error) {
                                    toastr.error(data.error);
                                }
                                else{
                                    toastr.success(data.success);
                                }
                            },
                            error: function (data) {
                                toastr.error('Something went wrong');
                            }
                        });
                    },
                });
            }
            $('#dateRangePicker').daterangepicker({
                startDate: '{{ Carbon\Carbon::parse($course->discount_start_at)->format('m/d/Y') }}',
                endDate: '{{ Carbon\Carbon::parse($course->discount_end_at)->format('m/d/Y') }}',
            });
            $('.datePickerUP').datepicker({});
            $('#liveClassDateRangePicker').daterangepicker({
                startDate: '{{ Carbon\Carbon::parse($course->discount_start_at)->format('m/d/Y') }}',
                endDate: '{{ Carbon\Carbon::parse($course->discount_end_at)->format('m/d/Y') }}',
            });
            $('.liveClassDateRangePicker').datepicker({});
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
            $(document).on('change', ".lesson_source", function () {
                let video_source = $(this).val();

                if (video_source == 'upload') {
                    $('.lesson_link').addClass('d-none');
                    $('.lesson_upload_div').removeClass('d-none');
                } else {
                    $('.lesson_link').removeClass('d-none');
                    $('.lesson_upload_div').addClass('d-none');
                }
            });
            $(document).on('change', "#is_free", function () {
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
            $(document).on('change', "#discountable_course", function () {
                let is_discountable = $(this).is(':checked');
                if (is_discountable) {
                    $('.discountable_div').removeClass('d-none');
                } else {
                    $('.discountable_div').addClass('d-none');
                }
            });
            $(document).on('click', ".lesson_modal", function () {
                let section = $(this).data('section');
                section_id = section.id;
                $('.section_id').val(section.id);
            });
            /*$(document).on('click', "#basicInformation", function () {
                searchCategory($('#select_category'));
                searchSubjects($('#select_subject'));
                searchOrganization($('#ins_by_org'));
            });*/
            $(document).on('change','#courseType',function () {
                var selectedValue = $(this).val();
                if (selectedValue === 'live_class') {
                    $("#notLiveClass").removeClass('d-none');
                    $('.courseAssignmentIndex').text(numbeonelive);
                    $('.courseresourceIndex').text(numbertwoLive);
                    $('.coursefaqIndex').text(numberthreeLive);

                } else if (selectedValue === 'course') {
                    $("#notLiveClass").addClass('d-none');
                    $('.courseAssignmentIndex').text(numbeone);
                    $('.courseresourceIndex').text(numbertwo);
                    $('.coursefaqIndex').text(numberThree);

                }
            });
            $(document).on('click', '.tab_change', function () {
                var tab = $(this).attr('data-tab');
                changeUrl('tab', tab);
            });
            $(document).on('click', '.deleteResource', function (event) {
                event.preventDefault();
                let url = $(this).data('url');
                axios.delete(url, {
                    params: {
                        method: 'DELETE',
                        course_id: $(this).data('course'),
                    }
                })
                    .then(response => {
                        console.log(response.data);
                        $('#resourceListContainer').html(response.data);
                        toastr.success('Deleted Successfully')
                    })
                    .catch(error => {
                        console.log(error.message);
                    })
            });
            $(document).on("submit", "#storeResource", function (e) {
                e.preventDefault();
                let selector = this;
                $(selector).find(".loading_button").removeClass("d-none");
                $(selector).find("p.error").text("");
                $(selector).find(":submit").addClass("d-none");
                let action = $(selector).attr("action");
                let method = $(selector).attr("method");
                let formData = new FormData(selector);
                let modal = $(selector).find('.is_modal').val();

                axios.post(action, formData)

                    .then(response => {

                        $('#resourceListContainer').html(response.data);

                        if (modal_id && !modal) {
                            $(selector).find(".loading_button").addClass("d-none");
                            $(selector).find(":submit").removeClass("d-none");
                            toastr.success('Created Successfully');
                            modal_id.modal("hide");
                            $(selector).trigger("reset");
                            modal_id
                                .find(".create_sub_title")
                                .removeClass("d-none");
                            modal_id.find(".edit_sub_title").addClass("d-none");
                            $(".dataTable").DataTable().ajax.reload();
                        } else {
                            if (response.route) {
                                window.location.href = response.route;
                            } else {
                                location.reload();
                            }
                        }

                    })
                    .catch(error => {
                        let message = error.response.data.errors.file[0] || error.response.data.error
                        toastr.error(message)
                        $(selector).find(".loading_button").addClass("d-none");
                        $(selector).find(":submit").removeClass("d-none");

                    })

            });
        });

        function changeUrl(type, val) {
            var url = new URL(window.location.href);
            var params = new URLSearchParams(url.search);

            params.set(type, val);

            var newUrl = url.origin + url.pathname + '?' + params.toString();
            window.history.pushState({
                path: newUrl
            }, '', newUrl);
        }
    </script>
@endpush
