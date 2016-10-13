$(document).ready(function() {
    $('#example').DataTable( {	
	responsive:true,
  	dom: 'Bfrtip',
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ]
    } );
});

$(function() {
    // Get the form.
    var form = $('#jwright-contactform');
    var name = $('#jw-name');
    var email = $('#jw-email');
    var tel= $('#jw-tel');
    var message= $('#jw-message');
    
    
    // Set up an event listener for the contact form.
    $(form).submit(function(event) {
    // Stop the browser from submitting the form.
    event.preventDefault();

    // Serialize the form data.
    var formData = $(form).serialize();
    
    // Submit the form using AJAX.
$.ajax({
    type: 'POST',
    url: $(form).attr('action'),
    data: formData
})
.done(function(response) {
    
    // Clear the form.
    $(name).val('');
    $(emal).val('');
    $(tel).val(''); 
    $(message).val(''); 
})

.fail(function(data) {
   
});
});
});   
