<?php namespace Roman\Store\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateRomanStoreOrder2 extends Migration
{
    public function up()
    {
        Schema::table('roman_store_order', function($table)
        {
            $table->integer('user_id')->nullable();
        });
    }
    
    public function down()
    {
        Schema::table('roman_store_order', function($table)
        {
            $table->dropColumn('user_id');
        });
    }
}
