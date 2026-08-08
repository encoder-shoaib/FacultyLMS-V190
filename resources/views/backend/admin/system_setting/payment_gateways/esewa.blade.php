<div class="col-xxl-4 col-xl-6 col-lg-6 col-md-12">
    <div class="payment-box">
        <div class="payment-icon">
            <img src="{{ static_asset('images/payment-icon/esewa.png') }}" alt="khalti">
            <span class="title">{{ __('esewa') }}</span>
        </div>

        <div class="payment-settings">
            <div class="payment-settings-btn">
                <a href="#" class="btn btn-md sg-btn-outline-primary" data-bs-toggle="modal" data-bs-target="#esewa"><i
                        class="las la-cog"></i> <span>{{ __('setting') }}</span></a>
            </div>

            <div class="setting-check">
                <input type="checkbox" id="is_esewa_activated" value="setting-status-change/is_esewa_activated"
                       class="status-change" {{ setting('is_esewa_activated') ? 'checked' : '' }}>
                <label for="is_esewa_activated"></label>
            </div>
        </div>
    </div>
</div>
<!-- End Payment box -->
<div class="modal fade" id="esewa" tabindex="-1" aria-labelledby="paymentMethodLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <h6 class="sub-title">{{ __('esewa') }} {{ __('configuration') }}</h6>
            <button type="button" class="btn-close modal-close" data-bs-dismiss="modal" aria-label="Close"></button>
            <form action="{{ route('payment.gateway') }}" method="post" class="form">@csrf
                <div class="row gx-20">
                    <input type="hidden" name="is_modal" class="is_modal" value="0">
                    <input type="hidden" name="payment_method" value="esewa">
                    <div class="col-12">
                        <div class="d-flex gap-12 sandbox_mode_div mb-4">
                            <input type="hidden" name="is_esewa_sandbox_mode_activated"
                                   value="{{ setting('is_esewa_sandbox_mode_activated') == 1 ? 1 : 0 }}">
                            <label class="form-label"
                                   for="is_esewa_sandbox_mode_activated">{{ __('sandbox_mode') }}</label>
                            <div class="setting-check">
                                <input type="checkbox" value="1" id="is_esewa_sandbox_mode_activated"
                                       class="sandbox_mode" {{ setting('is_esewa_sandbox_mode_activated') == 1 ? 'checked' : '' }}>
                                <label for="is_esewa_sandbox_mode_activated"></label>
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="mb-4">
                            <label class="form-label">{{ __('secret_key') }}</label>
                            <input type="text" class="form-control rounded-2" name="esewa_secret_key"
                                   placeholder="{{ __('enter_secret_key') }}"
                                   value="{{ setting('esewa_secret_key') }}">
                            <div class="nk-block-des text-danger">
                                <p class="esewa_secret_key_error error"></p>
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="mb-4">
                            <label class="form-label">{{ __('merchant_id') }}</label>
                            <input type="text" class="form-control rounded-2" name="esewa_merchant_id"
                                   placeholder="{{ __('enter_merchant_id') }}"
                                   value="{{ setting('esewa_merchant_id') }}">
                            <div class="nk-block-des text-danger">
                                <p class="esewa_merchant_id_error error"></p>
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
