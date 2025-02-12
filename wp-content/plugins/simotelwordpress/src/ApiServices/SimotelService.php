<?php

namespace App\ApiServices;

class SimotelService {

    private $tableName = 'simo_config';

    public function store($request){
        global $wpdb;        

        if($wpdb->get_var("select * from ".$this->tableName." where id =".$request['id']."")){
            $this->update($request);
        }
        else{
            $this->insert($request);
        }
        return $request['simo_token'];
    }
    public function get(){
        global $wpdb;

        $results = $wpdb->get_results("select * from ".$this->tableName);
        return $results;
    }

    public function insert ($request){
        global $wpdb;
        
        // return json_encode(array("blablabla"=>$request['simo_address'])) ;

        $wpdb->insert($this->tableName,array(
            'address'=>$request['simo_address'],
            'trunk'=>$request['simo_trunk'],
            'context'=>$request['simo_context'],
            'token'=>$request['simo_token'],
            'usetrunk'=>$request['simo_usetrunk'],
            'number'=>$request['simo_number'],
            ));
    }

    public function update($request){
        global $wpdb;

        $wpdb->update(
            $this->tableName,
            array(
                'address'=>$request['simo_address'],
                'trunk'=>$request['simo_trunk'],
                'context'=>$request['simo_context'],
                'token'=>$request['simo_token'],
                'number'=>$request['simo_number'],
                'usetrunk'=>$request['simo_usetrunk'],
            ),
            array(
                'id'=>$request['id'],
            )
        );
    }

}