@extends('frontend.layouts.master')
@section('title', __('my_quiz_list'))
@section('content')
    <section class="purchase-courses-section p-t-50 p-b-50 p-b-md-20 p-t-sm-30">
        <div class="container container-1278">
            <div class="row">
                @include('frontend.profile.sidebar')
                <div class="col-md-8">
                    <div class="certification-course-wrapper">
                        <div class="row">
                            <div class="col-12">
                                <h5 class="border-bottom-soft-white p-b-10 fw-semibold m-b-20 m-b-sm-15">{{__('my_quiz_list') }}</h5>
                            </div>
                        </div>
                        <div class="course-items-wrap">
                            <table class="table table-striped">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>{{ __('title') }}</th>
                                    <th>{{ __('total_marks') }}</th>
                                    <th>{{ __('your_marks') }}</th>
                                    <th class="text-end">{{ __('action') }}</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($sections as $key => $section)
                                    @if ($section->quizzes->count() > 0)
                                        @foreach ($section->quizzes as $k => $quiz)
                                            @php
                                                $correct_answer = \App\Models\QuizAnswer::where([
                                                    ['user_id', auth()->user()->id],
                                                    ['quiz_id', $quiz->id],
                                                ])->whereColumn('answers', 'correct_answer')
                                                ->where('answers', '!=', null)->count();

                                                $question_count = $quiz->questions->count();
                                                $question_mark = $question_count > 0 ? ($quiz->total_marks / $question_count) : 0;
                                                $found_mark = ($correct_answer * $question_mark);
                                            @endphp


                                            <tr>
                                                <td>{{ ++$loop->index }}</td>
                                                <td>{{ $quiz->title }}</td>
                                                <td>{{ $quiz->total_marks }}</td>
                                                @if( !empty($quiz->quizAnswer->count()))
                                                <td>{{ $found_mark }}</td>
                                                @else
                                                    <td></td>
                                                @endif
                                                <td class="text-end">
                                                    @if(! empty($quiz->questions->count()))
                                                        <a href="{{ route('my-quiz', $quiz->slug) }}"
                                                           class="template-btn" style="padding: 5px 19px">
                                                            @if( empty($quiz->quizAnswer->count()))
                                                                {{__('start_exam') }}
                                                            @else
                                                                {{__('result') }}
                                                            @endif
                                                        </a>
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                    @else
                                        {{ __('No quizzes Found') . ' !' }}
                                    @endif
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@push('js')
    <script>
        let page = 2;
        $(document).ready(function () {
            $(document).on('click', '.load_more', function () {
                let that = this;
                let url = $(this).data('url');
                let selector = $(this).closest('.course-pagination');
                $(that).addClass('d-none');
                $(selector).find('.loading_button').removeClass('d-none');
                $.ajax({
                    url: url,
                    type: "GET",
                    data: {
                        page: page,
                    },
                    success: function (data) {
                        $(selector).find('.loading_button').addClass('d-none');

                        if (data.success) {
                            if (data.next_page) {
                                $(that).removeClass('d-none');
                            }
                            page++;
                            $('.course_section_wrap').append(data.html);
                            $('.total_results').text(data.total_results);
                            $('.total_courses').text(data.total_courses);
                        } else {
                            toastr.error(data.error);
                        }

                        console.log(data);
                    }
                });
            });
        });
    </script>
@endpush
