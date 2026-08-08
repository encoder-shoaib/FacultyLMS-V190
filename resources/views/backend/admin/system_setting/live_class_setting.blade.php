@extends('backend.layouts.master')
@section('title', __('live_class_setting'))
@section('content')
    <section class="oftions">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-8 m-auto">
                    <h3 class="section-title">{{ __('meeting_type') }}</h3>
                    <div class="bg-white redious-border p-20 p-sm-30 pt-sm-30">
                        <div class="row align-items-center g-20">
                            <div class="col-xxl-12 col-xl-12 col-lg-6 col-md-12">
                                <div class="payment-box">
                                    <div class="payment-icon">
                                        <img src="{{ static_asset('images/payment-icon/zoom.svg') }}" alt="zoom">
                                        <span class="title">{{ __('zoom') }}</span>
                                    </div>
                                    <div class="payment-settings">
                                        <div class="payment-settings-btn">
                                            <a href="#" class="btn btn-md sg-btn-outline-primary" data-bs-toggle="modal" data-bs-target="#zoom"><i
                                                    class="las la-cog"></i> <span>{{ __('setting') }}</span></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- End Payment box -->
                            <div class="modal fade" id="zoom" tabindex="-1" aria-labelledby="zoomSettingLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <h6 class="sub-title">{{ __('zoom') }} {{ __('configuration') }}</h6>
                                        <button type="button" class="btn-close modal-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        <form action="{{ route('live.class.setting.store') }}" method="post" class="form">@csrf
                                            <div class="row gx-20">
                                                <input type="hidden" name="is_modal" class="is_modal" value="0">
                                                <input type="hidden" name="meeting_method" value="zoom">
                                                <div class="col-12">
                                                    <div class="mb-4">
                                                        <label class="form-label">{{ __('client_id') }}</label>
                                                        <input type="text" class="form-control rounded-2" name="zoom_client_id"
                                                               placeholder="{{ __('enter_zoom_client_id') }}"
                                                               value="{{ stringMasking(old('zoom_client_id',setting('zoom_client_id')),'*',3,-3) }}">
                                                        <div class="nk-block-des text-danger">
                                                            <p class="zoom_client_id_error error"></p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="mb-4">
                                                        <label class="form-label">{{ __('secret_key') }}</label>
                                                        <input type="text" class="form-control rounded-2" name="zoom_secret_key"
                                                               placeholder="{{ __('enter_secret_key') }}"
                                                               value="{{ stringMasking(old('zoom_secret_key',setting('zoom_secret_key')),'*',3,-3) }}">
                                                        <div class="nk-block-des text-danger">
                                                            <p class="zoom_secret_key_error error"></p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="mb-4">
                                                        <label class="form-label">{{ __('account_id') }}</label>
                                                        <input type="text" class="form-control rounded-2" name="zoom_account_id"
                                                               placeholder="{{ __('enter_zoom_account_id') }}"
                                                               value="{{ stringMasking(old('zoom_account_id',setting('zoom_account_id')),'*',3,-3) }}">
                                                        <div class="nk-block-des text-danger">
                                                            <p class="zoom_account_id_error error"></p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- End MarChant ID -->
                                            </div>
                                            <!-- END Permissions Tab====== -->
                                            <div class="d-flex justify-content-end align-items-center mt-30">
                                                <button type="submit" class="btn sg-btn-primary">{{ __('save') }}</button>
                                                @include('backend.common.loading-btn',['class' => 'btn sg-btn-primary'])
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
