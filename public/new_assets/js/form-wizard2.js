$(function() {
	'use strict'
	
	$('#wizard2').steps({
		headerTag: 'h3',
		bodyTag: 'section',
		autoFocus: true,
		titleTemplate: '<span class="number">#index#<\/span> <span class="title">#title#<\/span>',
		onStepChanging: function(event, currentIndex, newIndex) {
			if (currentIndex < newIndex) {
				// Step 1 form validation
				if (currentIndex === 0) {
					// var id_client = $('#id_client').parsley();
					// var lname = $('#lastname').parsley();
					// if (id_client.isValid() && lname.isValid()) {
					// 	return true;
					// } else {
					// 	id_client.validate();
					// 	lname.validate();
					// }

					var id_client = $('#id_client').parsley();
					if (id_client.isValid()) {
						return true;
					} else {
						id_client.validate();
					}


				}
				// Step 2 form validation
				if (currentIndex === 1) {

					var outside_price = $('#outside_price').parsley();
					// var email = $('#email').parsley();
					if (outside_price.isValid()) {
						return true;
					} else {
						outside_price.validate();
					}
				}
				// Always allow step back to the previous step even if the current step is not valid.
			} else {
				return true;
			}
		},
		onFinishing: function(event, currentIndex) {
            // Step 3 form validation
            if (currentIndex === 2) {
                var form = $(this);
                form.parsley().validate();
                if (form.parsley().isValid()) {
                    // Formulir valid, Anda dapat melakukan pengiriman formulir di sini
                    form.submit(); // Mengirimkan formulir secara langsung
                    // Atau Anda dapat melakukan pengiriman formulir dengan AJAX
                    /*
                    $.ajax({
                        url: 'submit-url',
                        type: 'POST',
                        data: form.serialize(),
                        success: function(response) {
                            // Handle success response
                        },
                        error: function(xhr, status, error) {
                            // Handle error response
                        }
                    });
                    */
                }
            }
            return false; // Untuk mencegah proses penyelesaian (finishing) otomatis
        }
	});
	
});