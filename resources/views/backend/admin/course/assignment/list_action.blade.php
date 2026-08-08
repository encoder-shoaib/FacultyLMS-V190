@if(hasPermission('submitted_assignment_list.index'))
    <ul class="d-flex gap-30 justify-content-end">
        <li>
            <a style="font-size: 16px" href="{{route('submittedStudent.list',$assignment->id)}}"> <span
                    class="text-success">{{__('student_list')}}</span></a>
        </li>
    </ul>
@endif
