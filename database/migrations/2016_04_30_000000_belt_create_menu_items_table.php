<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Kalnoy\Nestedset\NestedSet;

class BeltCreateMenuItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('menu_items', function (Blueprint $table) {
            $table->increments('id');
            NestedSet::columns($table);
            $table->integer('menu_group_id')->index();
            $table->string('menuable_type', 100)->nullable();
            $table->integer('menuable_id')->nullable();
            $table->string('label');
            $table->string('slug')->index();
            $table->string('url')->nullable();
            $table->string('target')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('menu_items');
    }
}
