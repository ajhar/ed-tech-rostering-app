let doPost = (url, method, data, file) => {
    return new Promise(function (resolve, reject) {
        $.ajax({
            type: method || "POST",
            url: url,
            dataType: 'json',
            contentType: file ? false : 'application/x-www-form-urlencoded; charset=UTF-8',
            enctype: file ? 'multipart/form-data' : '',
            processData: file ? false : '',
            data: data || {},
            success: function (data) {
                resolve(data);
            },
            error: function (jqXHR, exception) {
                let msg = '';
                if (jqXHR.status === 0) {
                    msg = 'Not connect.Verify Network.';
                    console.log('Not connect.Verify Network.');
                } else if (jqXHR.status === 404) {
                    console.log('Requested page not found. [404]');
                    msg = 'Requested page not found';
                } else if (jqXHR.status === 422) {
                    console.log('Requested page status. [422]');
                    if (jqXHR.hasOwnProperty('responseJSON')) {
                        if(jqXHR.responseJSON.hasOwnProperty('errors')){
                            msg = jqXHR.responseJSON.errors;
                        }else{
                            msg = jqXHR.responseJSON.message
                        }
                    }
                } else if (jqXHR.status === 500) {
                    msg = 'Internal Server Error [500].';
                } else if (exception === 'parsererror') {
                    msg = 'Requested JSON parse failed.';
                    // location.reload();
                } else if (exception === 'timeout') {
                    msg = 'Time out error.';
                } else if (exception === 'abort') {
                    msg = 'Ajax request aborted.';
                } else if (jqXHR.responseJSON.hasOwnProperty('message') && jqXHR.responseJSON.message === 'CSRF token mismatch.') {
                    console.log('CSRF token mismatched');
                } else {
                    msg = 'Uncaught Error.\n' + jqXHR.responseText;
                }
                reject(msg);
            },
        });
    });
}
