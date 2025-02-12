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

<style>
    /* مخفی کردن کلیدهای بالا و پایین */
    input[type=number]::-webkit-inner-spin-button,
    input[type=number]::-webkit-outer-spin-button {
        -webkit-appearance: none;
        margin: 0;
    }
</style>

    <?php
    if ( isset( $_POST['number1'] ) && isset( $_POST['number2'] ) ) {
        $number1 = sanitize_text_field( $_POST['number1'] );
        $number2 = sanitize_text_field( $_POST['number2'] );

        // ارسال داده ها با cURL
        $response = my_send_numbers($number1, $number2);
        echo '<p>پاسخ از سرور: ' . esc_html($response) . '</p>';
    }
    return ob_get_clean();
}
add_shortcode( 'simotel_call', 'my_simotel_call_shortcode' );

// تابع برای ارسال داده ها با cURL
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
