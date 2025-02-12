<?php
$url = home_url().'/wp-json/simotel/api/get/events';

$json_data = file_get_contents($url);

$response_data = json_decode($json_data,true);

?>

<body>
<table class="table wp-list-table widefat striped" style="border: 1px solid gray;border-collapse: collapse">
  <thead>
    <tr>
      <th scope="col" style="border: 1px red;padding:2px">#</th>
      <th scope="col" style="border: 1px whitesmoke;padding:2px">نام رویداد</th>
      <th scope="col" style="border: 1px whitesmoke;padding:2px">منبع</th>
      <th scope="col" style="border: 1px whitesmoke;padding:2px">مقصد</th>
      <th scope="col" style="border: 1px whitesmoke;padding:2px">نوع</th>
      <th scope="col" style="border: 1px whitesmoke;padding:2px">نتیجه</th>
      <th scope="col" style="border: 1px whitesmoke;padding:2px">اوریجین آیدی</th>
    </tr>
  </thead>
  <tbody>
    <tr>
     
      <?php
      foreach ($response_data as $key ){
        echo '<tr>';
        echo "<td style='border: 1px darkblue solid;padding:2px'>".$key['id']."</td>" ;
        echo "<td style='border: 1px darkblue solid;padding:2px'>".$key['event_name']."</td>" ;
        echo "<td style='border: 1px darkblue solid;padding:2px'>".$key['src']."</td>" ;
        echo "<td style='border: 1px darkblue solid;padding:2px'>".$key['dst']."</td>" ;
       
        echo "<td style='border: 1px darkblue solid;padding:2px'>".$key['type']."</td>" ;
        echo "<td style='border: 1px darkblue solid;padding:2px'>".$key['disposition']."</td>" ;
        echo "<td style='border: 1px darkblue solid;padding:2px'>".$key['originated_call_id']."</td>" ;
        echo '</tr>';
      }
      ?>  
    </tr>
    
  </tbody>
</table>
</body>