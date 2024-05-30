<?php namespace Roman\Store\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateRomanStoreOrder5 extends Migration
{
    public function up()
    {
        Schema::table('roman_store_order', function($table)
        {
            $table->string('card_expiry', 255)->nullable(false)->unsigned(false)->default(null)->comment(null)->change();
        });
    }
    
    public function down()
    {
        Schema::table('roman_store_order', function($table)
        {
            $table->date('card_expiry')->nullable(false)->unsigned(false)->default(null)->comment(null)->change();
        });
    }
}
