<?php

namespace App\Services;

use Pusher\Pusher;

class PusherSend {

private $pusher;

    public function __construct() {
        $options = array(
            'cluster' => 'us2',
            'useTLS' => true
          );
          $this->pusher = new Pusher(
            'ee78b89bab3d3590ede6',
            'f23076c618ee3d2f3d28',
            '1677216',
            $options
          );
    }
public function send(){
    $data['message'] = 'hello world';
    $this->pusher->trigger('my-channel', 'my-event', $data);
}


  
}
?>