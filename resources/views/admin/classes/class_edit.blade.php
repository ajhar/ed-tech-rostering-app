<div class="modal-dialog modal-sm">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title mt-0">Edit Class</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <form method="PUT" action="{{route('classes.update',$class->id)}}" id="class-form" novalidate>
            @csrf
            <div class="modal-body">
                <div class="form-group">
                    <label for="input-name">Name</label>
                    <input type="text" name="name" class="form-control" id="input-name" value="{{$class->name}}" required>
                    <div class="invalid-feedback" id="name-error"></div>
                </div>
            </div>
            <div class="modal-footer d-flex justify-content-between">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary" data-loading-text="Updating...">Update</button>
            </div>
        </form>
    </div><!-- /.modal-content -->
</div>
