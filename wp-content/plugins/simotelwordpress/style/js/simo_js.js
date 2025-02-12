jQuery(document).ready(function($) {
    $('#formcall').on('submit', function(e) {
        e.preventDefault();


        var formData = $(this).serialize();

        $.ajax({
            url: '/wp-json/simotel/api/store/phone',
            type: 'POST',
            data: formData,
            success: function(response) {
               console.log(response);
            },
            error: function(xhr, status, error) {
                // خطا در ثبت
				console.log(error);
            }
        });
    });
	
	//for configurable
	 $('#formconfig').on('submit', function(e) {
        e.preventDefault();


        var formData = $(this).serialize();

        $.ajax({
            url: '/wp-json/simotel/api/store/config',
            type: 'POST',
            data: formData,
            success: function(response) {
               console.log("s");
            },
            error: function(xhr, status, error) {
                // خطا در ثبت
				console.log(error);
            }
        });
    });
});