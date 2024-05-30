<?php namespace Roman\Store\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableCreateRomanStoreOrder extends Migration
{
    public function up()
    {
        Schema::create('roman_store_order', function($table)
        {
            $table->increments('id')->unsigned();
            $table->text('cart');
            $table->string('firt_name', 255);
            $table->string('last_name', 255);
            $table->string('email', 255);
            $table->string('address', 255);
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('roman_store_order');
    }
}
