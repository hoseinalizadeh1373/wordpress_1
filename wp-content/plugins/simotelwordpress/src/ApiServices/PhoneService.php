<?php

namespace App\ApiServices;

use App\ApiServices\SimotelService;
use App\Services\CallConnect;

class PhoneService {

    private $tableName='simo_phones';

    public function store($request){
        

            
         

            $simotel = new SimotelService();
            $data= $simotel->get();
            $call = new CallConnect();

           $og =  $call->callAct(
                $data[0]->address,
                $data[0]->token,
                $request['form_fields']['mobile'],
                $data[0]->number,
                $data[0]->trunk,
                $data[0]->context,
            );

            $this->insert($request['form_fields']['mobile'],$og);

            return $og;
        
    }

    public function insert($mobile,$og){
        global $wpdb;
        
        $wpdb->insert(
            $this->tableName,
            array(
                'mobile'=>$mobile,
                'og_id'=>$og,
            ));
    }

    public function get(){
        global $wpdb;

        $results = $wpdb->get_results('select * from '.$this->tableName.' order by id desc');
        return $results;

    }

}