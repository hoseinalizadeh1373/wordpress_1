<?php

namespace App\Database\Migration;

use PinkCrab\Table_Builder\Schema;

class CreateTableEvents {

    public  function up(){
        $schema = new Schema("simo_events", function (Schema $schema) {
            // Set columns
            $schema->column('id')->unsigned_int(11)->auto_increment();
            $schema->column('event_name')->text(11);
            $schema->column('src')->text(11);
            $schema->column('dst')->text(11);
            $schema->column('type')->text(11);
            $schema->column('disposition')->text(11);
            $schema->column('originated_call_id')->text(11);
            // Set keys and indexes.
            $schema->index('id')->primary();
        });
        return $schema;
    }
}