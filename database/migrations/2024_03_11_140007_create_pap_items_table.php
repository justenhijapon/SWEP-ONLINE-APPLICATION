<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pap_items', function (Blueprint $table) {
            $table->id();
            $table->string('slug')->nullable();
            $table->string('pap_code')->nullable();
            $table->integer('item_no')->nullable();
            $table->string('item')->nullable();
            $table->decimal('unit_cost')->nullable();
            $table->integer('qty')->nullable();
            $table->string('uom')->nullable();
            $table->decimal('total_budget')->nullable();
            $table->string('mop')->nullable();
            $table->timestamps();
            $table->string('user_created')->nullable();
            $table->string('user_updated')->nullable();
            $table->string('ip_created')->nullable();
            $table->string('ip_updated')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pap_items');
    }
};
