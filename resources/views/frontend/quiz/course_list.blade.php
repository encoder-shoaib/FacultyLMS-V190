<div class="col-lg-6 col-sm-6" data-aos="fade-up" data-aos-delay="{{ 200 * $key }}">
    <div class="course-item course-progress">
        <a href="{{ route('quiz.list',$course->slug) }}" class="course-item-thumb">
            <img src="{{getFileLink('402x248', $course->image) }}" alt="{{__(@$course->category->title) }}">
        </a>
        <div class="course-item-body">
            <h4 class="title">
                <a href="{{ route('quiz.list',$course->slug) }}">{{__(@$course->title) }}</a>
            </h4>
        </div>
        <div class="course-item-footer">
            <div class="line-progress">
                <span>{{ $course->progress }}%</span>
                <div data-progress="{{ $course->progress }}" class="animate-progress" style="--animate-progress:{{ $course->progress }}%;"></div>
            </div>
            <a href="{{ route('quiz.list',$course->slug) }}" class="template-btn">{{__('quiz_list') }}</a>
        </div>
    </div>
</div>
