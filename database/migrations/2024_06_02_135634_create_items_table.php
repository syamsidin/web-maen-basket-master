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
            $table->string('registration_number');
            $table->foreignUuid('current_repository_id')->nullable();
            $table->foreign('current_repository_id')->references('id')->on('repositories');
            $table->foreignId('sub_sub_category_item_id')->nullable();
            $table->foreign('sub_sub_category_item_id')->references('id')->on('sub_sub_category_items');
            $table->foreignId('item_origin_id')->nullable();
            $table->foreign('item_origin_id')->references('id')->on('item_origins');
            $table->foreignId('item_condition_id')->nullable();
            $table->foreign('item_condition_id')->references('id')->on('item_conditions');
            $table->foreignId('item_unit_id')->nullable();
            $table->foreign('item_unit_id')->references('id')->on('item_units');
            $table->string('entry_year');
            $table->date('entry_date');
            $table->string('price');
            $table->integer('qty');
            $table->string('popular_name');
            $table->string('address')->default('3, Jl. Kolonel Masturi No.KM, RW.5, Cipageran, Kec. Cimahi Utara, Kota Cimahi, Jawa Barat 40511');
            $table->string('user')->default('Badan Pengembangan Sumber Daya Manusia');
            $table->string('owner_user')->default('Sekretariat Badan Pengembangan Sumber Daya Manusia');
            $table->string('pic_name')->nullable();
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
