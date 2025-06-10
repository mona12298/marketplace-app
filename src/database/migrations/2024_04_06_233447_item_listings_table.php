<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ItemListingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('item_listings', function (Blueprint $table) {
        $table->id();
        $table->foreignId('user_id')->constrained()->cascadeOnDelete();
        $table->unsignedTinyInteger('condition')->comment('0=良好, 1=目立った傷や汚れなし, 2=やや傷や汚れあり, 3=状態が悪い');
        $table->string('item_name', 255);
        $table->string('brand_name', 255)->nullable();
        $table->text('description');
        $table->integer('price');
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
        Schema::dropIfExists('item_listings');
    }
}
