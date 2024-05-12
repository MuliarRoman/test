<?php namespace Roman\Store\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateRomanStoreCategories extends Migration
{
    public function up()
    {
        Schema::rename('roman_store_catefories', 'roman_store_categories');
    }
    
    public function down()
    {
        Schema::rename('roman_store_categories', 'roman_store_catefories');
    }
}
