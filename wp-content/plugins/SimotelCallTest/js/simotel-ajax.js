jQuery(document).ready(function($) {
    $('#number-sender-form').on('submit', function(e) {
        e.preventDefault();  // جلوگیری از ارسال فرم به طور معمول (بدون رفرش صفحه)

        var number1 = $('input[name="number1"]').val();
        var number2 = $('input[name="number2"]').val();

        // ارسال درخواست AJAX به سرور
        $.ajax({
            url: simotel_ajax_object.ajax_url, // URL برای درخواست AJAX
            type: 'POST',
            data: {
                action: 'process_call', // اکشن برای شناسایی درخواست
                number1: number1,
                number2: number2
            },
            beforeSend: function() {
                // اینجا می‌توانید انیمیشن لودینگ اضافه کنید
                $('#response').html('<p>در حال ارسال درخواست...</p>').removeClass('success error').addClass('show');
            },
            success: function(response) {
                // نمایش پیام موفقیت
                $('#response').html('<p>پاسخ از سرور: ' + response + '</p>')
                              .removeClass('error')
                              .addClass('success')
                              .addClass('show');
                // مخفی کردن snackbar بعد از 10 ثانیه
                setTimeout(function() {
                    $('#response').removeClass('show');
                }, 10000);  // 10 ثانیه
            },
            error: function() {
                // نمایش پیام خطا
                $('#response').html('<p>خطا در ارسال درخواست. لطفا دوباره تلاش کنید.</p>')
                              .removeClass('success')
                              .addClass('error')
                              .addClass('show');
                // مخفی کردن snackbar بعد از 10 ثانیه
                setTimeout(function() {
                    $('#response').removeClass('show');
                }, 10000);  // 10 ثانیه
            }
        });
    });
});
