<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHistoryRepositoryItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('history_repository_items', function (Blueprint $table) {
            $table->foreignUuid('item_id');
            $table->foreign('item_id')->references('id')->on('items');
            $table->foreignUuid('repository_id');
            $table->foreign('repository_id')->references('id')->on('repositories');
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
        Schema::dropIfExists('history_repository_items');
    }
}
