let initDataTable = (table, columns, formId, aaSorting = [], columnDefs = []) => {
    let url = table.attr('data-url');
    return new Promise(function (resolve, reject) {
        let t = table.DataTable({
            processing: true,
            serverSide: true,
            retrieve: true,
            columnDefs: columnDefs,
            autoWidth: false,
            ajax: {
                url: url, data: function (d) {
                    d.form_data = $('#' + formId).serialize()
                }
            },
            pageLength: 50,
            lengthMenu: [[50, 100, 500, 1000], [50, 100, 500, 1000]],
            aaSorting: aaSorting,
            columns: columns,
            language: {
                searchPlaceholder: 'Search...',
            },
            responsive: true,
            initComplete: function () {
                resolve(t);
            },
        });
    });
}
