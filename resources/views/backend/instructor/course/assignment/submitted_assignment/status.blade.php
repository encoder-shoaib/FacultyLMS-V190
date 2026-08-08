@if($assignment->status == 0)
    <td><span class="text-info">{{__('pending')}}</span></td>
@elseif($assignment->status == 1)
    <td><span class="text-success">{{__('pass')}}</span></td>
@elseif($assignment->status == 2)
    <td><span class="text-danger">{{__('fail')}}</span></td>
@endif
