<?php namespace Roman\Store\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateRomanStoreProducts2 extends Migration
{
    public function up()
    {
        Schema::table('roman_store_products', function($table)
        {
            $table->integer('size_id');
        });
    }
    
    public function down()
    {
        Schema::table('roman_store_products', function($table)
        {
            $table->dropColumn('size_id');
        });
    }
}
