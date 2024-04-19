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
        Schema::create('official_reciept', function (Blueprint $table) {
            $table->increments('id');
            $table->string('slug');
            $table->integer('or_no')->nullable(true);
            $table->date('or_date')->nullable(true);
            $table->string('or_payor')->nullable(true);
            $table->year('or_crop_year')->nullable(true);
            $table->string('or_mill')->nullable(true);
            $table->string('or_sugar_class')->nullable(true);
            $table->string('or_utilization')->nullable(true);
            $table->string('or_drawee_bank')->nullable(true);
            $table->integer('or_chk_acct_no')->nullable(true);
            $table->integer('or_chk_no')->nullable(true);
            $table->date('or_chk_date')->nullable(true);
            $table->integer('or_cash_amount')->nullable(true);
            $table->integer('or_check_amount')->nullable(true);
            $table->integer('or_money_order')->nullable(true);
            $table->integer('or_total_paid')->nullable(true);
            $table->string('or_cancellation')->nullable(true);
            $table->string('or_shut_out')->nullable(true);
            $table->string('or_transhipment')->nullable(true);
            $table->string('or_shipping_permit')->nullable(true);
            $table->integer('or_other_fees')->nullable(true);
            $table->integer('or_total_amount')->nullable(true);
            $table->string('or_report_no')->nullable(true);
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
        Schema::dropIfExists('official_reciept');
    }
};
