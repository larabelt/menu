<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class BeltUpdateMenuItemsTable2 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // SQLlite doesn't doesn't support multiple calls to renameColumn, dropColumn in single modification...

        Schema::table('menu_items', function (Blueprint $table) {
            $table->renameColumn('driver', 'template');
        });

        Schema::table('menu_items', function (Blueprint $table) {
            $table->dropColumn('menuable_id');
        });

        Schema::table('menu_items', function (Blueprint $table) {
            $table->dropColumn('menuable_type');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('menu_items', function (Blueprint $table) {
            $table->renameColumn('template', 'driver');
            $table->string('menuable_type', 100)->nullable();
            $table->integer('menuable_id')->nullable();
        });
    }
}
