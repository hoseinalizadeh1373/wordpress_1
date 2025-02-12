<?php

namespace App\Database;

use PinkCrab\Table_Builder\Schema;
use PinkCrab\DB_Migration\Database_Migration;
use  PinkCrab\Table_Builder\Builder;
use PinkCrab\Table_Builder\Engines\WPDB_DB_Delta\DB_Delta_Engine;
use App\Database\Migration\createTableEvents;
use App\Database\Migration\CreateTablePhones;



class RunMigrate {
    public function __construct() {
        if(!defined('ABSPATH'))exit;
        require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
    }

    public function createTable($tableName){
        global $wpdb;
        $engine =new DB_Delta_Engine($wpdb);
        $builder = new Builder($engine);

        $tb = 'App\Database\Migration\\'.$tableName;
        $instance =new $tb;

        try{
            $rep = $builder->create_table($instance->up());
        }catch  (\Exception $e) {
            echo $e;
        }

    }
}