<div class="col-xxl-4 col-xl-6 col-lg-6 col-md-12">
    <div class="payment-box">
        <div class="payment-icon">
            <img src="{{ static_asset('images/payment-icon/tap.svg') }}" alt="tap">
            <span class="title">{{ __('tap') }}</span>
        </div>

        <div class="payment-settings">
            <div class="payment-settings-btn">
                <a href="#" class="btn btn-md sg-btn-outline-primary" data-bs-toggle="modal"
                   data-bs-target="#tap"><i class="las la-cog"></i> <span>{{ __('setting') }}</span></a>
            </div>

            <div class="setting-check">
                <input type="checkbox" id="is_tap_activated"
                       value="setting-status-change/is_tap_activated"
                       class="status-change" {{ setting('is_tap_activated') ? 'checked' : '' }}>
                <label for="is_tap_activated"></label>
            </div>
        </div>
    </div>
</div>
<!-- End Payment box -->
<div class="modal fade" id="tap" tabindex="-1" aria-labelledby="paymentMethodLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <h6 class="sub-title">{{ __('tap') }} {{ __('configuration') }}</h6>
            <button type="button" class="btn-close modal-close" data-bs-dismiss="modal" aria-label="Close"></button>
            <form action="{{ route('payment.gateway') }}" method="post" class="form">@csrf
                <div class="row gx-20">
                    <input type="hidden" name="is_modal" class="is_modal" value="0">
                    <input type="hidden" name="payment_method" value="tap">
                    <div class="col-12">
                        <div class="d-flex gap-12 sandbox_mode_div mb-4">
                            <input type="hidden" name="is_tap_sandbox_mode_activated"
                                   value="{{ setting('is_tap_sandbox_mode_activated') == 1 ? 1 : 0 }}">
                            <label class="form-label"
                                   for="is_tap_sandbox_mode_activated">{{ __('sandbox_mode') }}</label>
                            <div class="setting-check">
                                <input type="checkbox" value="1" id="is_tap_sandbox_mode_activated"
                                       class="sandbox_mode" {{ setting('is_tap_sandbox_mode_activated') == 1 ? 'checked' : '' }}>
                                <label for="is_tap_sandbox_mode_activated"></label>
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="mb-4">
                            <label class="form-label">{{ __('secret_key') }}</label>
                            <input type="text" class="form-control rounded-2" name="tap_secret_key"
                                   placeholder="{{ __('enter_api_key') }}" value="{{ stringMasking(old('tap_secret_key',setting('tap_secret_key')),'*',3,-3) }}">
                            <div class="nk-block-des text-danger">
                                <p class="tap_secret_key_error error"></p>
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="mb-4">
                            <label class="form-label">{{ __('publishable_key') }}</label>
                            <input type="text" class="form-control rounded-2" name="publishable_key"
                                   placeholder="{{ __('publishable_key') }}"
                                   value="{{ stringMasking(old('publishable_key',setting('publishable_key')),'*',3,-3) }}">
                            <div class="nk-block-des text-danger">
                                <p class="publishable_key_error error"></p>
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="mb-4">
                            <label class="form-label">{{ __('encryption_key') }}</label>
                            <input type="text" class="form-control rounded-2" name="encryption_key"
                                   placeholder="{{ __('encryption_key') }}"
                                   value="{{ stringMasking(old('encryption_key',setting('encryption_key')),'*',3,-3) }}">
                            <div class="nk-block-des text-danger">
                                <p class="encryption_key_error error"></p>
                            </div>
                        </div>
                    </div>
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
