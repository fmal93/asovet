$( document ).ready(function(){
    $('#pay-form').submit(function(){
        $(this).find('button[type=submit]').prop('disabled', true);
    });
    $(".pagination li:first-child").addClass("link-show");
    $(".pagination li:last-child").addClass("link-show");

});

