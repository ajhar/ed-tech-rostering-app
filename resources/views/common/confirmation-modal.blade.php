<div class="modal-dialog modal-sm">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title mt-0"></h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <form method="" action="" id="" novalidate>
            @csrf
            <div class="modal-body">
                <div id="content"></div>
                <div class="alert alert-danger mb-0 mt-2" id="message" style="display: none"></div>
            </div>
            <div class="modal-footer d-flex justify-content-between">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn"></button>
            </div>
        </form>
    </div>
</div>

