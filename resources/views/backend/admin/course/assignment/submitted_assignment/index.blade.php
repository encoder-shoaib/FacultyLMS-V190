@extends('backend.layouts.master')
@section('title', __('students_list'))
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="header-top d-flex justify-content-between align-items-center">
                    <h3 class="section-title">{{__('students_list') }}</h3>
                    <div class="oftions-content-right mb-12">
                        <a href="javascript:void(0);" onclick="history.back()" class="d-flex align-items-center btn sg-btn-primary gap-2">
                            <i class="las la-long-arrow-alt-left"></i>
                            <span>{{ __('back') }}</span>
                        </a>
                    </div>
                </div>
                <div
                    class="default-tab-list table-responsive default-tab-list-v2 activeItem-bd-md bg-white redious-border p-20 p-sm-30">
                    <div class="default-list-table yajra-dataTable">
                        {{ $dataTable->table() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="give_marks" tabindex="-1" aria-labelledby="give_marks" aria-hidden="true">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <h6 class="sub-title">{{ __('give_marks') }}</h6>
                <button type="button" class="btn-close modal-close" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                <form action="" method="post" class="form"
                      enctype="multipart/form-data">@csrf
                    <div class="row gx-20">
                        <input type="hidden" class="is_modal" value="0">
                        <div class="col-12">
                            <div class="mb-4">
                                <label class="form-label">{{ __('marks') }}</label>
                                <input type="number" name="marks" class="form-control rounded-2"
                                       placeholder="{{ __('enter_assignment_marks') }}">
                                <div class="nk-block-des text-danger">
                                    <p class="marks_error error"></p>
                                </div>
                            </div>
                        </div>
                        <div class="text-end">
                            <button type="submit" class="btn sg-btn-primary">{{ __('save') }}</button>
                            @include('backend.common.loading-btn', ['class' => 'btn sg-btn-primary'])
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@include('backend.common.delete-script')
@push('js')
    {{ $dataTable->scripts() }}
@endpush
@push('js')
    <script>
        $(document).on('click','.open-give-marks-modal', function() {
                var assignmentId = $(this).data('assignment-id');
                var formAction = '{{ route("assignments.marks.store", ":id") }}';
                formAction = formAction.replace(':id', assignmentId);
                $('#give_marks form').attr('action', formAction);
        });
    </script>
@endpush
