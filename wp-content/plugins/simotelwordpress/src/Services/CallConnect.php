<?php

namespace App\Services;

use GuzzleHttp\Client;

class CallConnect
{
    public function callAct($address,$token,$caller,$callee,$trunk,$context)
    {
        $client = new Client();
        $data = $client->post($address.'api/v4/call/originate/act', [
            'headers' => [
                'X-APIKEY' => $token,
                'Content-Type' => 'application/json',
            ],
            'json' => [
                "caller" => $caller,
                "callee" => $callee,
                "context" => $context,
                "caller_id" => $callee,
                "trunk_name" => $trunk,
                "timeout" => "30"
            ]
       ]);
       $data_incoming =json_decode($data->getBody()->getContents());
       
       return wptexturize( $data_incoming->data->originated_call_id);
    }

}

?>