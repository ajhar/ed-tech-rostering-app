<div class="modal-dialog modal-sm">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title mt-0">Edit Activity</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <form method="PUT" action="{{route('activities.update',$activity->id)}}" id="activity-form" novalidate>
            @csrf
            <div class="modal-body">
                <div class="form-group">
                    <label for="input-name">Name</label>
                    <input type="text" name="name" class="form-control" id="input-name" value="{{$activity->name}}"
                           required>
                    <div class="invalid-feedback" id="name-error"></div>
                </div>
                <div class="form-group">
                    <label for="input-subject-id">Subject</label>
                    <select class="selectize" name="subject_id" id="input-subject-id">
                        @foreach($subjects as $subject)
                            <option
                                value="{{$subject->id}}" {{$activity->subject->id == $subject->id? 'selected':''}}>
                                {{$subject->name}}
                            </option>
                        @endforeach
                    </select>
                    <div class="invalid-feedback" id="subject-id-error"></div>
                </div>
                <div class="form-group">
                    <label for="input-name">Max Score</label>
                    <input type="number" name="max_score" class="form-control" id="input-max-score"
                           value="{{$activity->max_score}}" required>
                    <div class="invalid-feedback" id="max-score-error"></div>
                </div>
                {{--<div class="alert alert-danger mb-0" role="alert">
                    A simple danger alert with <a href="#" class="alert-link">an example link</a>. Give it a click if you like.
                </div>--}}
            </div>
            <div class="modal-footer d-flex justify-content-between">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary" data-loading-text="Updating...">Update</button>
            </div>
        </form>
    </div><!-- /.modal-content -->
</div>
