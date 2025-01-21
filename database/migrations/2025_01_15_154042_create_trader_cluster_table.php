<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTraderClusterTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trader_cluster', function (Blueprint $table) {
            $table->id('id');
            $table->string('slug')->unique();
            $table->string('tc_id')->nullable();
            $table->string('trader_slug');
            $table->string('tc_marking')->nullable();
            $table->string('tc_name')->nullable();
            $table->text('tc_address')->nullable();
            $table->string('tc_tin')->nullable();
            $table->timestamps();
            $table->unsignedBigInteger('user_created');
            $table->ipAddress('ip_created');
            $table->ipAddress('ip_updated')->nullable();

            // Optional: Add foreign keys if needed
            // $table->foreign('user_created')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('trader_cluster');
    }
}
