$(document).ready(function () {
    let columns = [
        {data: 'DT_RowIndex', name: 'DT_RowIndex', searchable: false, sortable: false},
        {data: 'registration_number'},
        {data: 'user.name'},
        {data: 'user.email'},
        {data: 'address', name: 'address'},
        {data: 'class_room.name'},
        {data: 'activities', name: 'studentActivities.name'},
        {data: 'actions', searchable: false, sortable: false},
    ];

    initDataTable($('table#students-table'), columns);
});

$(document).on('submit', '#student-form', async function (e) {
    e.preventDefault();
    try {
        let response = await doFormPost($(this));
        $(this).closest('.modal').modal('hide');
        alertify.success(response.message);
        $('table').DataTable().ajax.reload();
    } catch (e) {
        displayErrors($(this), e);
    }
});

$(document).on('click', '.delete', function (e) {
    e.preventDefault();
    let url = $(this).attr('data-url');

    let confirmationModal = $('#confirmation-modal');
    confirmationModal.find('h5').html(`Delete Student`);

    confirmationModal.find('form')
        .attr('id', 'student-form')
        .attr('method', 'DELETE')
        .attr('action', url);
    confirmationModal.find('form .modal-body #content').html(`Are you sure want to delete?`);
    confirmationModal.find('form button[type=submit]')
        .addClass(`btn-danger`)
        .html('Delete');

    confirmationModal.modal('show');
});
