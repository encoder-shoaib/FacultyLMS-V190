@extends('frontend.layouts.base')
@section('base.content')
    @php
        $headerStyle = isset($section) && isset($section['header']) ? $section['header'] : (setting('header_style') ?: 'header1');
    @endphp
    @include('frontend.layouts.header.' . $headerStyle)
    @yield('content')
    @include('frontend.homePage.cta')
    @include('frontend.layouts.footer')
@endsection
