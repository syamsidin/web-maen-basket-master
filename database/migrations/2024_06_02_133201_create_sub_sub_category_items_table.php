<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubSubCategoryItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sub_sub_category_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('sub_sub_category_id')->nullable();
            $table->foreign('sub_sub_category_id')->references('id')->on('sub_sub_categories');
            $table->string('code')->nullable();
            $table->string('name');
            $table->integer('usage_life')->nullable();
            $table->boolean('is_deleted')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sub_sub_category_items');
    }
}
