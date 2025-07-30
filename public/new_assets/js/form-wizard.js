(function($) {
	"use strict";
	
	//accordion-wizard
	var options = {
		mode: 'wizard',
		autoButtonsNextClass: 'btn btn-primary float-end',
		autoButtonsPrevClass: 'btn btn-light',
		stepNumberClass: 'badge rounded-pill bg-primary me-1',
		onSubmit: function() {
		  // alert('Form submitted!');

		  	var formData = new FormData($('#myFormOrders').get(0)); // Menggunakan get(0) untuk mengambil elemen DOM
            
            $.ajax({
                url: '/iso_agency/dashboard/acc_listing_produk/orders_act',
                type: 'POST',
                data: formData,
                processData: false,  // Tidak memproses data secara otomatis
                contentType: false,  // Tidak mengatur tipe konten secara otomatis
                dataType: "JSON",
                success: function(response) {
                	
                    if(response.status === true) //if success close modal and reload ajax table
			        {
		              iziToast.success({
		                  title: 'OK',
		                  position: 'center',
		                  message: 'Selamat ! Transaksi anda berhasil!',
		              });
		              
		              var redirectUrl = response.redirectUrl;
			          // Anda bisa menggunakan window.location.href untuk redirect pengguna
			          window.location.href = redirectUrl;
			        }
			        
                },
                error: function(xhr, status, error) {
                    // Handle error response
                    alert('error submit');
                }
            });
            
            return true;
		}
	}
	$( "#myFormOrders" ).accWizard(options);
		
})(jQuery); 