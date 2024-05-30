<?php namespace Roman\Store\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateRomanStoreOrder extends Migration
{
    public function up()
    {
        Schema::table('roman_store_order', function($table)
        {
            $table->string('phone', 255);
        });
    }
    
    public function down()
    {
        Schema::table('roman_store_order', function($table)
        {
            $table->dropColumn('phone');
        });
    }
}
