$(document).ready(function() {
    var name = $("#jw-name").val();
    var namefield = $('#jw-name'); namefield.val('');
    var email = $('#jw-email');email.val('');
    var tel = $('#jw-tel');tel.val('');
    var message = $('#jw-message');message.val('');
    
    swal({
        title: "Thankyou "+name+"!",
        text: "Your message has been sent, someone will be in touch soon.",
        type: "success",
        confirmButtonColor: "#1c8a60",
        confirmButtonText: "OK"
    })
});
