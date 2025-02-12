<?php

namespace App\Database\Migration;

use PinkCrab\Table_Builder\Schema;

class CreateTableConfig {

    public  function up(){
        $schema = new Schema("simo_config", function (Schema $schema) {
            // Set columns
            $schema->column('id')->unsigned_int(11)->auto_increment();
            $schema->column('address')->text(25);
            $schema->column('token')->text();
            $schema->column('trunk')->text();
            $schema->column('usetrunk')->type('boolean');
            $schema->column('context')->text();
            $schema->column('number')->text();
            // Set keys and indexes.
            $schema->index('id')->primary();
        });
        return $schema;
    }
}