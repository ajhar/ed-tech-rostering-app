<div class="modal-dialog modal-sm">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title mt-0">Update Score</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <form method="PUT"
              action="{{route('teachers.update-student-score',['studentId'=>$student_activity->student_id,'activityId'=>$student_activity->activity_id])}}"
              id="teacher-form" novalidate>
            @csrf
            <div class="modal-body">
                <div class="form-group">
                    <label for="input-score">{{$student_activity->activity->name}}</label>
                    <input type="number" name="score" class="form-control" id="input-score"
                           value="{{$student_activity->score}}" required>
                    <div class="invalid-feedback" id="score-error"></div>
                </div>
                <div class="alert alert-danger mb-0 mt-2" id="message" style="display: none"></div>
            </div>
            <div class="modal-footer d-flex justify-content-between">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary" data-loading-text="Updating...">Update</button>
            </div>
        </form>
    </div><!-- /.modal-content -->
</div>
