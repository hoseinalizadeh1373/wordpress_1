<?php

use App\ApiServices\PhoneService;
use App\ApiServices\EventsService;
use App\ApiServices\SimotelService;
use App\Services\PusherSend;

//===================
//api phone route
register_rest_route(
    'simotel/api/store',
    'phone/',
    array(
        'methods'=>'POST',
        'callback'=>array(new PhoneService(),'store'),
    )
);

register_rest_route(
    'simotel/api/get',
    'phone/',
    array(
        'methods'=>'GET',
        'callback'=>array(new PhoneService(),'get'),
    )
);
    
//====================
//api events route 

register_rest_route(
        'simotel/api/store',
        'events',
        array(
            'methods'=>'POST',
            'callback' =>array(new EventsService(),'store'),
        )
);

register_rest_route(
    'simotel/api/get',
    'events',
    array(
        'methods'=>'GET',
        'callback' =>array(new EventsService(),'get'),
    )
);

//======================
//api route config
register_rest_route( 
                    'simotel/api/store',
                    "config",
                    array(
                        'methods' =>'POST',
                        'callback' =>array(new SimotelService(),'store'),
                    )
);
register_rest_route( 
                    'simotel/api/get',
                    "config",
                    array(
                        'methods' =>'GET',
                        'callback' =>array(new SimotelService(),'get'),
                    )
);
//========================
//pusher send
register_rest_route(
    'simotel/api/send',
    'pusher',
    array(
        'methods'=>'POST',
        'callback'=>array(new PusherSend(),'send'),
    )
    );