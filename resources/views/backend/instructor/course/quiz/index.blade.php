@extends('backend.layouts.master')
@section('title', __('quiz_list'))
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="header-top d-flex justify-content-between align-items-center">
                    <h3 class="section-title">{{__('quiz_list') }}</h3>
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
@endsection
@include('backend.common.delete-script')
@push('js')
    {{ $dataTable->scripts() }}
@endpush
