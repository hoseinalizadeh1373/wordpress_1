<?php

namespace App\ApiServices;

class EventsService{

    private $tableName = 'simo_events';
    
    public function store($request){
        global $wpdb;
        
        $wpdb->insert($this->tableName,array(
        'event_name'=>$request['event_name'],
        'src'=>$request['src'],
        'dst'=>$request['dst'],
        'type'=>$request['type'],
        'disposition'=>$request['disposition'],
        'originated_call_id'=>$request['originated_call_id'],
        ));

        return $request['event_name'];
    }

    public function get(){
        global $wpdb;

        $results = $wpdb->get_results('select * from '.$this->tableName.' order by id desc');
        return $results;
    }
}