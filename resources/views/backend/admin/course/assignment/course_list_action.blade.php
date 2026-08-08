<ul class="d-flex gap-30 justify-content-center">
    <div class="dropdown">
        <a class="dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            <i class="las la-ellipsis-v"></i>
        </a>
        <ul class="dropdown-menu" style="width: 150px">
            @if(hasPermission('submitted_assignment.index'))
                <li>
                    <a class="dropdown-item"
                       href="{{route('assignments.list',$course->id)}}">{{ __('assignment_list') }}</a>
                </li>
            @endif
            @if(hasPermission('submitted_quiz.index'))
                <li>
                    <a class="dropdown-item"
                       href="{{route('exam.list',$course->slug)}}">{{ __('quiz_list') }}</a>
                </li>
            @endif
        </ul>
    </div>
</ul>


