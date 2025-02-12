<?php
/**
 * Plugin Name: Simotel Call
 * Description: A simple plugin to Originate Call with Simotel
 * Version: 1.0
 * Author: Hosein Alizadeh
 */

// جلوگیری از دسترسی مستقیم
if ( ! defined( 'ABSPATH' ) ) {
    exit; 
}

// اضافه کردن شورتکد
function my_simotel_call_shortcode() {
    ob_start();
    ?>
    <form id="number-sender-form" style="margin: 15px; padding: 5px; max-width: 220px; display: flex; flex-direction: column; align-items: center;" method="post">
        <input type="number" name="number1" style="margin: 10px 0; padding: 10px; width: 100%; border: 1px solid #ccc; border-radius: 5px; -moz-appearance: textfield;" placeholder="شماره اول" required>
        <input type="number" name="number2" style="margin: 10px 0; padding: 10px; width: 100%; border: 1px solid #ccc; border-radius: 5px; -moz-appearance: textfield;" placeholder="شماره دوم" required>
        <button type="submit" style="margin: 10px 0; padding: 10px; width: 100%; background-color: #4CAF50; color: white; border: none; border-radius: 5px; cursor: pointer;">تماس</button>
    </form>

    <!-- جایی برای نمایش پاسخ از سرور -->
    <div id="response"></div>

    <style>
        /* مخفی کردن کلیدهای بالا و پایین */
        input[type=number]::-webkit-inner-spin-button,
        input[type=number]::-webkit-outer-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }
    </style>
    <?php
    return ob_get_clean();
}
add_shortcode( 'simotel_call', 'my_simotel_call_shortcode' );

// بارگذاری اسکریپت‌های جاوااسکریپت
// بارگذاری اسکریپت‌های جاوااسکریپت و CSS
function simotel_enqueue_scripts() {
    // بارگذاری اسکریپت جاوااسکریپت
    wp_enqueue_script('simotel-ajax-script', plugin_dir_url(__FILE__) . 'js/simotel-ajax.js', array('jquery'), null, true);
    
    // بارگذاری فایل CSS
    wp_enqueue_style('simotel-style', plugin_dir_url(__FILE__) . 'css/style.css');

    // ارسال متغیرهای وردپرس به اسکریپت جاوااسکریپت
    wp_localize_script('simotel-ajax-script', 'simotel_ajax_object', array(
        'ajax_url' => admin_url('admin-ajax.php'), // URL برای ارسال درخواست AJAX
    ));
}
add_action('wp_enqueue_scripts', 'simotel_enqueue_scripts');

add_action('wp_enqueue_scripts', 'simotel_enqueue_scripts');

// تابع برای ارسال داده‌ها با cURL
function my_send_numbers($number1, $number2) {
    $curl = curl_init();

    curl_setopt_array($curl, array(
        CURLOPT_URL => 'http://185.141.215.62:8029/api/v4/call/originate/act',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS => json_encode(array(
            "caller" => $number1,
            "callee" => $number2,
            "context" => "simotel_test",
            "caller_id" => $number1,
            "trunk_name" => "2191305906",
            "timeout" => 30,
            "call_limit" => 60
        )),
        CURLOPT_HTTPHEADER => array(
            'X-APIKEY: UCujRTssUUgRX6ND8Ep3GSMDIzFYFt4j6wAXtdlsBYQNBim5Bp',
            'Content-Type: application/json'
        ),
    ));

    $response = curl_exec($curl);

    curl_close($curl);
    return $response;
}

// اکشن برای پردازش درخواست AJAX
function process_simotel_call() {
    if ( isset($_POST['number1']) && isset($_POST['number2']) ) {
        $number1 = sanitize_text_field($_POST['number1']);
        $number2 = sanitize_text_field($_POST['number2']);
        
        // فراخوانی تابع ارسال داده ها
        $response = my_send_numbers($number1, $number2);
        
        // ارسال پاسخ به جاوااسکریپت
        echo $response;
    } else {
        echo 'داده‌ها به درستی ارسال نشده است.';
    }

    // قطع اجرای کد وردپرس
    wp_die();
}

// ثبت اکشن برای پردازش درخواست
add_action('wp_ajax_process_call', 'process_simotel_call');
add_action('wp_ajax_nopriv_process_call', 'process_simotel_call');
