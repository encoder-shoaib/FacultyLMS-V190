@if(hasPermission('courses.edit'))
    <div class="setting-check">
        <input type="checkbox" class="status-change"
               {{ ($course->is_featured == 1) ? 'checked' : '' }} data-id="{{ $course->id }}"
               value="course-feature/{{$course->id}}"
               id="customSwitch3-{{$course->id}}">
        <label for="customSwitch3-{{ $course->id }}"></label>
    </div>
@endif
