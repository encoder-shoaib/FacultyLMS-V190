@extends('backend.layouts.master')
@section('title', __('my_subscription'))
@section('content')
    <section class="oftions">
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-lg-4">
                <h3 class="section-title">{{ __('my_subscription') }}</h3>
                <div class="bg-white redious-border p-20 p-sm-30">
                    @if($subscription)
                        <div>
                            <img src="{{ getFileLink('72x72', $subscription->package->image) }}" alt="">
                            <h5 class="mt-2">{{ $subscription->package->lang_title }}</h5>
                            <h6 class="mt-2">{{ __('total_instructor') }} : {{ $subscription->total_instructor }}</h6>
                            <h6 class="mt-2">{{ __('total_course') }} : {{ $subscription->total_course }}</h6>
                            <h6 class="mt-2">{{ __('expires_at') }} : {{ Carbon\Carbon::parse($subscription->expires_at)->format('d M, Y') }}</h6>
                            <a href="{{ route('instructor.available.packages') }}" class="align-items-center btn sg-btn-primary mt-3">{{ __('upgrade_package') }}</a>
                        </div>
                    @else
                        <h6 class="text-danger">{{ __('no_subscription_found') }}</h6>
                        <a href="{{ route('instructor.available.packages') }}" class="align-items-center btn sg-btn-primary mt-3">{{ __('purchase_now') }}</a>
                    @endif
                </div>
            </div>
        </div>
    </div>
    </section>
@endsection
