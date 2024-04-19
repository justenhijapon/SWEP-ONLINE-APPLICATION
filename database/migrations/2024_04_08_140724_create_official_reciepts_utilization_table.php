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
        Schema::create('official_reciepts_utilization', function (Blueprint $table) {
            $table->increments('id');
            $table->string('slug');
            $table->string('oru_txn_type')->nullable(true);
            $table->integer('oru_sp_no')->nullable(true);
            $table->integer('oru_volume')->nullable(true);
            $table->integer('oru_amount')->nullable(true);
            $table->timestamps();
            $table->string('user_created')->nullable(true);
            $table->string('user_updated')->nullable(true);
            $table->string('ip_created')->nullable(true);
            $table->string('ip_updated')->nullable(true);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('official_reciepts_utilization');
    }
};
