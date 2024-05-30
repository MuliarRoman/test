<?php namespace Roman\Store\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateRomanStoreOrder3 extends Migration
{
    public function up()
    {
        Schema::table('roman_store_order', function($table)
        {
            $table->string('card_number', 255);
            $table->date('card_expiry');
            $table->string('card_csv', 255);
        });
    }
    
    public function down()
    {
        Schema::table('roman_store_order', function($table)
        {
            $table->dropColumn('card_number');
            $table->dropColumn('card_expiry');
            $table->dropColumn('card_csv');
        });
    }
}
