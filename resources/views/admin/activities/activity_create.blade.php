<div class="modal-dialog modal-sm">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title mt-0">Add New Activity</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <form method="POST" action="{{route('activities.store')}}" id="activity-form" novalidate>
            @csrf
            <div class="modal-body">
                <div class="form-group">
                    <label for="input-name">Name</label>
                    <input type="text" name="name" class="form-control" id="input-name" required>
                    <div class="invalid-feedback" id="name-error"></div>
                </div>
                <div class="form-group">
                    <label for="input-subject-id">Subject</label>
                    <select class="selectize" name="subject_id" id="input-subject-id">
                        @foreach($subjects as $subject)
                            <option value="{{$subject->id}}">{{$subject->name}}</option>
                        @endforeach
                    </select>
                    <div class="invalid-feedback" id="subject-id-error"></div>
                </div>
                <div class="form-group">
                    <label for="input-name">Max Score</label>
                    <input type="number" name="max_score" class="form-control" id="input-max-score" value="100" required>
                    <div class="invalid-feedback" id="max-score-error"></div>
                </div>
            </div>
            <div class="modal-footer d-flex justify-content-between">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary" data-loading-text="Adding...">Add</button>
            </div>
        </form>
    </div><!-- /.modal-content -->
</div>
