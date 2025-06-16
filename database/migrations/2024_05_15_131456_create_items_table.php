<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('items', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('current_repository_id')->nullable();
            $table->foreign('current_repository_id')->references('id')->on('repositories');
            $table->foreignId('current_status_id')->nullable();
            $table->foreign('current_status_id')->references('id')->on('status_items');
            $table->foreignId('category_id')->nullable();
            $table->foreign('category_id')->references('id')->on('category_items');
            $table->string('code');
            $table->string('register_number');
            $table->string('name');
            $table->string('year');
            $table->string('owner_name');
            $table->string('pic_name')->nullable();
            $table->text('damage_description')->nullable();
            $table->text('img_filename')->nullable();
            $table->boolean('is_deleted')->default(0);
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
        Schema::dropIfExists('items');
    }
}
