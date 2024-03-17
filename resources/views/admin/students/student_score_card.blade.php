@foreach ($student_activities as $student_activity)
    @if(!empty($student_activity->activity))
        @if(auth()->user()->role == \App\Enums\UserRoleEnum::TEACHER->value)
            <a href="javascript:;" class="load-modal"
               data-url="{{route('teachers.edit-student-score',['studentId'=>$student_activity->student_id,'activityId'=>$student_activity->activity_id])}}"
               title="Update Score"> {{ $student_activity->activity->name}}
            </a>
        @else
            {{ $student_activity->activity->name}}
        @endif
        @if(!empty($student_activity->score))
            <span
                class="text-primary">({{$student_activity->score}} Out of {{$student_activity->activity->max_score}})
            </span>
        @endif
        <br>
    @endif
@endforeach
