<?php namespace Roman\Store\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableCreateRomanStoreCatefories extends Migration
{
    public function up()
    {
        Schema::create('roman_store_catefories', function($table)
        {
            $table->increments('id')->unsigned();
            $table->string('name', 255);
            $table->string('slug', 255);
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('roman_store_catefories');
    }
}
