$(document).on('click','#show-hide-password a',function(e){
    e.preventDefault();
    let input = $(this).closest('.input-group').find('input');
    console.log(input);
    if (input.attr("type") === "text") {
        input.attr('type', 'password');
        $(this).text('Show')
    } else if (input.attr("type") === "password") {
        input.attr('type', 'text');
        $(this).text('Hide')
    }
});
