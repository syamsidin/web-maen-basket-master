<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHistoryStatusItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('history_status_items', function (Blueprint $table) {
            $table->foreignUuid('item_id');
            $table->foreign('item_id')->references('id')->on('items');
            $table->foreignId('status_id');
            $table->foreign('status_id')->references('id')->on('status_items');
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
        Schema::dropIfExists('history_status_items');
    }
}
