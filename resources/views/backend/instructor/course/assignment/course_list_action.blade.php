<ul class="d-flex gap-30 justify-content-center">
    <div class="dropdown">
        <a class="dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            <i class="las la-ellipsis-v"></i>
        </a>
        <ul class="dropdown-menu" style="width: 150px">
            <li>
                <a class="dropdown-item"
                   href="{{route('instructor.assignments.list',$course->id)}}">{{ __('assignment_list') }}</a>
            </li>
            <li>
                <a class="dropdown-item"
                   href="{{route('instructor.exam.list',$course->slug)}}">{{ __('quiz_list') }}</a>
            </li>
        </ul>
    </div>
</ul>


