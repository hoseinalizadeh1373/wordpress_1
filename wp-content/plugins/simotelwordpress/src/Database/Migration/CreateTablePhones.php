<?php

namespace App\Database\Migration;

use PinkCrab\Table_Builder\Schema;

class CreateTablePhones {

    public function up(){
        $schema = new Schema("simo_phones", function (Schema $schema) {
            // Set columns
            $schema->column('id')->unsigned_int(11)->auto_increment();
            $schema->column('mobile')->varchar(11);
            $schema->column('og_id')->varchar(100);
            // Set keys and indexes.
            $schema->index('id')->primary();
        });
        return $schema;
    }

}