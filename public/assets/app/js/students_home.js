$(document).ready(function () {
    let columns = [
        {data: 'DT_RowIndex', name: 'DT_RowIndex', searchable: false, sortable: false},
        {data: 'activity.subject.name'},
        {data: 'activity.name'},
        {data: 'student_score'},
        {data: 'grade'},
    ];

    initDataTable($('table#activities-table'), columns);
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
