<?php namespace Roman\Store\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateRomanStoreProducts extends Migration
{
    public function up()
    {
        Schema::table('roman_store_products', function($table)
        {
            $table->integer('category_id');
        });
    }
    
    public function down()
    {
        Schema::table('roman_store_products', function($table)
        {
            $table->dropColumn('category_id');
        });
    }
}
