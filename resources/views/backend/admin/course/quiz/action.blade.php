@if(hasPermission('submitted_quiz_student.index'))
    <ul class="d-flex gap-30 justify-content-end">
        <li>
            <a style="font-size: 16px" href="{{ route('exam.attend.list',$quiz->id )}}"> <span
                    class="text-success">{{__('details')}}</span></a>
        </li>
    </ul>
@endif
