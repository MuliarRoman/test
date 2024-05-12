<?php namespace Roman\Store\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateRomanStoreProducts3 extends Migration
{
    public function up()
    {
        Schema::table('roman_store_products', function($table)
        {
            $table->string('slug', 255);
        });
    }
    
    public function down()
    {
        Schema::table('roman_store_products', function($table)
        {
            $table->dropColumn('slug');
        });
    }
}
