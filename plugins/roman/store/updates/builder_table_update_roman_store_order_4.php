<?php namespace Roman\Store\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateRomanStoreOrder4 extends Migration
{
    public function up()
    {
        Schema::table('roman_store_order', function($table)
        {
            $table->renameColumn('firt_name', 'first_name');
        });
    }
    
    public function down()
    {
        Schema::table('roman_store_order', function($table)
        {
            $table->renameColumn('first_name', 'firt_name');
        });
    }
}
