<?php namespace Roman\Store\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableCreateRomanStoreProducts extends Migration
{
    public function up()
    {
        Schema::create('roman_store_products', function($table)
        {
            $table->increments('id')->unsigned();
            $table->string('title', 255);
            $table->text('desc')->nullable();
            $table->double('price', 10, 0);
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('roman_store_products');
    }
}
