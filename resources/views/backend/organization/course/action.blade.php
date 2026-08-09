<ul class="d-flex gap-30 justify-content-end align-items-center">
    <li>
        <a href="{{ route('organization.courses.edit', $course->id) }}" title="{{ __('edit') }}"><i class="las la-edit"></i></a>
    </li>
    <li>
        <a href="javascript:void(0)" onclick="delete_row('{{ route('organization.courses.destroy', $course->id) }}', {{ $course->id }})" title="{{ __('delete') }}"><i class="las la-trash-alt text-danger"></i></a>
    </li>
   
    <div class="dropdown">
        <a class="dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            <i class="las la-ellipsis-v"></i>
        </a>
        <ul class="dropdown-menu">
            <li><a class="dropdown-item"
                    href="{{ route('course.details', $course->slug) }}">{{ __('visit_course') }}</a></li>
            <li><a class="dropdown-item"
                    href="{{ route('organization.course.students', $course->id) }}">{{ __('manage_student') }}</a></li>
            <li><a class="dropdown-item"
                    href="{{ route('organization.courses.edit', [$course->id, 'tab' => 'curriculum']) }}">{{ __('curriculum') }}</a>
            </li>
            <li><a class="dropdown-item"
                    href="{{ route('organization.courses.edit', [$course->id, 'tab' => 'assignment']) }}">{{ __('assignment') }}</a>
            </li>
            <li><a class="dropdown-item"
                    href="{{ route('organization.courses.edit', [$course->id, 'tab' => 'faq']) }}">{{ __('faq') }}</a>
            </li>
            <li>
                <a class="dropdown-item text-danger" href="javascript:void(0)" onclick="delete_row('{{ route('organization.courses.destroy', $course->id) }}', {{ $course->id }})"><i class="las la-trash-alt me-2"></i>{{ __('delete') }}</a>
            </li>
        </ul>
    </div>
</ul>
