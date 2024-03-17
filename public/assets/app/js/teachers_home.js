$(document).ready(function () {
    let columns = [
        {data: 'DT_RowIndex', name: 'DT_RowIndex', searchable: false, sortable: false},
        {data: 'registration_number'},
        {data: 'class_room.name'},
        {data: 'user.name'},
        {data: 'address', name: 'userAttribute.address', sortable: false},
        {data: 'activities', name: 'studentActivities.name', sortable: false},
    ];

    initDataTable($('table#students-table'), columns);
});

$(document).on('submit', '#teacher-form', async function (e) {
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
