<?php namespace Roman\Store\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableCreateRomanStoreProductsSizes extends Migration
{
    public function up()
    {
        Schema::create('roman_store_products_sizes', function($table)
        {
            $table->increments('id')->unsigned();
            $table->integer('product_id');
            $table->integer('size_id');
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('roman_store_products_sizes');
    }
}