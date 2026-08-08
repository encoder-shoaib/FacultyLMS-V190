@if(count($courses)>0)
    @if($course->liveClass)
    <div class="col-lg-6 col-sm-6" data-aos="fade-up"
         data-aos-delay="{{ 200 * $key }}">
        <div class="course-item course-progress">
            <a href="#" class="course-item-thumb">
                <img src="{{ getFileLink('402x248', $course->image) }}"
                     alt="{{ __(optional($course->category)->title) }}">
            </a>
            <div class="course-item-body">
                <h4 class="title">
                    <a href="{{ route('course.details', $course->slug) }}">{{ __($course->title) }}</a>
                </h4>
            </div>
            @php
                $meetingMethods = is_array($course->liveClass->meeting_method) ? $course->liveClass->meeting_method : json_decode($course->liveClass->meeting_method, true);
            @endphp

            @if($course->liveClass && $course->liveClass->meeting_method)
                @if(arrayCheck('zoom', $course->liveClass->meeting_link))
                    <div class="course-item-footer">
                        <div class="line-progress">
                            <span>{{ __('starting_date') }} : {{ \Carbon\Carbon::parse($course->liveClass->start_time)->format('d M y') }}</span>
                            <span>{{ __('time') }} : {{ \Carbon\Carbon::parse($course->liveClass->start_time)->format('h:i A') }}</span>
                        </div>
                        <a href="{{ $course->liveClass->meeting_link['zoom']['join_url'] }}"
                           class="template-btn">{{ __('join_zoom') }}</a>
                    </div>
                @endif
                    @if(arrayCheck('google_meet', $course->liveClass->meeting_link))
                        <div class="course-item-footer">
                            <div class="line-progress">
                                <span>{{ __('starting_date') }} : {{ \Carbon\Carbon::parse($course->liveClass->start_time)->format('d M y') }}</span>
                                <span>{{ __('time') }} : {{ \Carbon\Carbon::parse($course->liveClass->start_time)->format('h:i A') }}</span>
                            </div>
                            <a href="{{ $course->liveClass->meeting_link['google_meet']['join_url'] }}"
                               class="template-btn">{{ __('join_google_meet') }}</a>
                        </div>
                    @endif
            @endif
        </div>
    </div>
@endif
@else
    @include('frontend.not_found',$data=['title'=> 'Live class'])
@endif
