@extends('backend.layouts.master')
@section('title', __('my_subscription'))
@section('content')
    <section class="oftions">
        <div class="container-fluid">
            <h3 class="section-title">{{ __('packages') }}</h3>
            <div class="bg-white redious-border p-20 p-sm-30">
                <div class="row justify-content-center">
                    @foreach($packages as $package)
                        <div class="col-md-4">
                            <div class="package-default mb-4 mb-xl-0">
                                <div class="package-header pt-40 px-30 text-center position-relative">
                                    @if($package->is_popular)
                                        <span class="package-badge">{{ __('most_popular') }}</span>
                                    @endif
                                    <h2 class="package-title mt-30">{{ $package->lang_title }}</h2>
                                    <hr>
                                    <div>{!! $package->lang_description !!}</div>
                                </div>

                                <div class="package-content text-center">
                                    <h2 class="package-pirce text-center">{{ get_price($package->price) }}</h2>
                                    <ul>
                                        <li class="d-flex align-items-center justify-content-center gap-5 py-3 px-30">
                                            <p>{{ __('course_upload_limit') }}</p>
                                            <span>{{ $package->total_course }}</span>
                                        </li>
                                        <li class="d-flex align-items-center justify-content-center gap-5 py-3 px-30">
                                            <p>{{ __('total_instructor') }}</p>
                                            <span>{{ $package->total_instructor }}</span>
                                        </li>
                                        <li class="d-flex align-items-center justify-content-center gap-5 py-3 px-30">
                                            <p>{{ __('package_validity') }}</p>
                                            <span>{{ $package->days }} {{ $package->days > 0 ? __('days') : __('day') }}</span>
                                        </li>
                                    </ul>
                                    <div class="mb-40 mt-12">
                                        <a href="{{ route('') }}" class="btn btn-md sg-btn-primary"><span>{{ __('subscribe_now') }}</span></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
@endsection
