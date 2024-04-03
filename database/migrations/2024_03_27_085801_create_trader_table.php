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
        Schema::create('trader', function (Blueprint $table) {
            $table->increments('id');
            $table->string('slug');
            $table->string('trader_name')->nullable(true);
            $table->string('trader_address')->nullable(true);
            $table->integer('trader_tin')->nullable(true);
            $table->timestamps();
            $table->string('user_created')->nullable(true);
            $table->string('user_updated')->nullable(true);
            $table->string('ip_created')->nullable(true);
            $table->string('ip_updated')->nullable(true);
        });
        \App\Models\Menu::insert([

            [
                'slug' => 'mFBKQja3PNmX9fkw',
                'menu_id' => 'M10014',
                'category' => 'Trader',
                'name' => 'Trader',
                'route' => 'dashboard.trader.*',
                'icon' => 'fa-users',
                'is_menu' => '1',
                'is_dropdown' => '1',
            ],

        ]);
        \App\Models\Submenu::insert([

            [
                'slug' => 'foQ31iIWvGd62I1s',
                'submenu_id' => 'gbWmfSnzLKR',
                'menu_id' => 'M10014',
                'is_nav' => 1,
                'nav_name' =>'Manage',
                'name' => 'Trader Index',
                'route' => 'dashboard.trader.index',
            ],
            [
                'slug' => 'gE03nLSLmVdesbmp',
                'submenu_id' => 'tjfiFO1M7Yw',
                'menu_id' => 'M10014',
                'is_nav' => 0,
                'nav_name' =>'',
                'name' => 'Trader Store',
                'route' => 'dashboard.trader.store',
            ],
            [
                'slug' => 'JJszfMqeDHI3EX65',
                'submenu_id' => '0E0QTLm23Cs',
                'menu_id' => 'M10014',
                'is_nav' => 0,
                'nav_name' =>'',
                'name' => 'Trader Edit',
                'route' => 'dashboard.trader.edit',
            ],
            [
                'slug' => 'FO6FByJz7qSucyRo',
                'submenu_id' => '5fwCoeI1wkZ',
                'menu_id' => 'M10014',
                'is_nav' => 0,
                'nav_name' =>'',
                'name' => 'Trader Update',
                'route' => 'dashboard.trader.update',
            ],
            [
                'slug' => 'k18UHt4wz4ZTrctR',
                'submenu_id' => 'GKlEZyoSriM',
                'menu_id' => 'M10014',
                'is_nav' => 0,
                'nav_name' =>'',
                'name' => 'Trader Destroy',
                'route' => 'dashboard.trader.destroy',
            ],


        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {

    }
};
