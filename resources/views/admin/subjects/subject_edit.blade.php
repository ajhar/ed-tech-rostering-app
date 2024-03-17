<div class="modal-dialog modal-sm">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title mt-0">Edit Subject</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <form method="PUT" action="{{route('subjects.update',$subject->id)}}" id="subject-form" novalidate>
            @csrf
            <div class="modal-body">
                <div class="form-group">
                    <label for="input-code">Code</label>
                    <input type="text" name="code" class="form-control" id="input-code" value="{{$subject->code}}"
                           required>
                    <div class="invalid-feedback" id="code-error"></div>
                </div>
                <div class="form-group">
                    <label for="input-name">Name</label>
                    <input type="text" name="name" class="form-control" id="input-name" value="{{$subject->name}}" required>
                    <div class="invalid-feedback" id="name-error"></div>
                </div>
                {{--<div class="alert alert-danger mb-0" role="alert">
                    A simple danger alert with <a href="#" class="alert-link">an example link</a>. Give it a click if you like.
                </div>--}}
            </div>
            <div class="modal-footer d-flex justify-content-between">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary" data-loading-text="Adding...">Add</button>
            </div>
        </form>
    </div><!-- /.modal-content -->
</div>
