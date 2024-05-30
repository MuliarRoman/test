<?php namespace Roman\Store\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateRomanStoreOrder6 extends Migration
{
    public function up()
    {
        Schema::table('roman_store_order', function($table)
        {
            $table->string('email', 255)->nullable()->change();
        });
    }
    
    public function down()
    {
        Schema::table('roman_store_order', function($table)
        {
            $table->string('email', 255)->nullable(false)->change();
        });
    }
}
