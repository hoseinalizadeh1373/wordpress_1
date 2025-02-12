<?php

echo  is_user_logged_in(  );
$url = home_url().'/wp-json/simotel/api/get/config';

// Read JSON file
$json_data = file_get_contents($url);

// Decode JSON data into PHP array
$response_data = json_decode($json_data);

?>

<body>
<span class="badge rounded-pill bg-secondary">اطلاعات سیموتل خود را وارد کنید</span>
<br>
<br>

<form id="formconfig" class="container" >
<input type="hidden" name="id" value="<?php echo empty($response_data) ? "": $response_data[0]->id ?>">
<div class="mb-3">
  <label for="address" class="form-label">آدرس سیموتل</label>
  <input type="text" class="form-control" id="simo_address" name="simo_address" value="<?php echo empty($response_data) ? "":  $response_data[0]->address  ?>" placeholder="http://192.168.1.1">
</div>
<div class="mb-3">
  <label for="token" class="form-label"> api keyتوکن</label>
  <input type="text" class="form-control" id="simo_token" name="simo_token" value="<?php echo empty($response_data) ? "": $response_data[0]->token ?>" placeholder="xxxxxxxxxxxxxxxxxxx">
</div>
 یک داخلی متصل شود به 
<input type="checkbox" name="simo_usetrunk" id="simo_usetrunk" value="1" <?php echo empty($response_data) ? "" : "checked"?> >
<div class="mb-3">
  <label for="trunk" class="form-label">ترانک</label>
  <input type="text" class="form-control" id="simo_trunk" name="simo_trunk" value="<?php echo empty($response_data) ? "": $response_data[0]->trunk ?>" placeholder="trunk1">
</div>
<div class="mb-3">
  <label for="context" class="form-label">context</label>
  <input type="text" class="form-control" id="simo_context" name="simo_context" value="<?php echo empty($response_data) ? "": $response_data[0]->context ?>" placeholder="main_routing">
</div>
<div class="mb-3">
  <label for="number" class="form-label">شماره</label>
  <input type="number" class="form-control" id="simo_number" name="simo_number" value="<?php echo empty($response_data) ? "": $response_data[0]->number ?>" placeholder="100">
</div>
<button type="submit" class="btn">ذخیره</button>
 </form>
<script >
    jQuery(document).ready(function($) {
        $('#formconfig').on('submit', function(e) {
        e.preventDefault();
        var formData = $(this).serialize();

        $.ajax({
            url: '/wp-json/simotel/api/store/config',
            type: 'POST',
            data: formData,
            success: function(response) {
               console.log(formData);
            },
            error: function(xhr, status, error) {
                // خطا در ثبت
				console.log(error);
            }
        });
    });
});
</script>
 </body>