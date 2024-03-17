const base_url = $('meta[name="base_url"]').attr('content');
const csrf_token = $('meta[name="csrf_token"]').attr('content');

$(document).on('click', '.load-modal', function () {
    let url = $(this).data('url');
    loadModal('modal', url);
});

let isEmpty = str => {
    return (!str || str.length === 0 || str === '' || str.length === 0 || typeof str === undefined || str === null);
};

let loadModal = (modalId, url, data = {}, method = "GET") => {
    return new Promise(function (resolve, reject) {
        modalId = '#' + modalId;
        if (method === "POST") {
            $(modalId).load(url, data, function (response, status) {
                initializeSelectizeInModal($(modalId));
                $(modalId).modal('show');
                resolve(true);
            });
        } else {
            $(modalId).load(url, function (response, status) {
                initializeSelectizeInModal($(modalId));
                $(modalId).modal('show');
                resolve(true);
            });
        }
    });
};

function initializeSelectizeInModal(modal) {
    modal.find('select').each(function () {
        if (!$(this).hasClass('selectized')) {
            $(this).selectize();
        }
    });
}

let doFormPost = async (form) => {
    let url = form.attr('action');
    let method = form.attr('method');
    let isFile = form.attr('data-file') === undefined ? false : form.attr('data-file');

    let data = isFile ? new FormData(form[0]) : form.serialize();
    let btn = form.find('button[type=submit]');
    let btnOriginalText = btn.html();

    form.find('.invalid-feedback').empty();
    form.find('.is-invalid').removeClass('is-invalid');
    try {
        buttonLoad(btn);
        let response = await doPost(url, method, data, isFile);
        buttonLoad(btn, 'reset', btnOriginalText);
        return response;
    } catch (err) {
        buttonLoad(btn, 'reset', btnOriginalText);
        throw err;
    }
}

let buttonLoad = (btn, status = 'load', originalText = 'Submit') => {
    let loadingText = btn.attr('data-loading-text');
    if (status === 'reset') {
        btn.prop('disabled', false);
        btn.html(originalText);
    } else {
        btn.prop('disabled', true);
        btn.html('<span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span>');
    }
}

let displayErrors = (form, errors) => {
    if (typeof errors === 'string') {
        form.find('#message').css('display', 'block').html(errors);
    }else{
        $.each(errors, (name, value) => {
            let errorElemId = name.replace('_', '-');
            form.find('[name^="' + name + '"]').addClass('is-invalid');
            form.find('#' + errorElemId + '-error').html(value[0]);
        });
    }
}

$('#confirmation-modal').on('hidden.bs.modal', function () {
    $(this).find('#message').css('display', 'none').html('');
});
