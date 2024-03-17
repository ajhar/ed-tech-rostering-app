$(document).ready(function () {
    $('select').selectize();
});

$(document).on('submit', '#user-form', async function (e) {
    e.preventDefault();
    try {
        let response = await doFormPost($(this));
        alertify.success(response.message);
    } catch (e) {
        displayErrors($(this), e);
    }
});
