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
        Schema::create('consignee', function (Blueprint $table) {
            $table->increments('id');
            $table->string('slug');
            $table->string('consignee_name')->nullable(true);
            $table->string('consignee_address')->nullable(true);
            $table->integer('consignee_tin')->nullable(true);
            $table->timestamps();
            $table->string('user_created')->nullable(true);
            $table->string('user_updated')->nullable(true);
            $table->string('ip_created')->nullable(true);
            $table->string('ip_updated')->nullable(true);
        });
        \App\Models\Menu::insert([

            [
                'slug' => 'mFBKQja3PNmX9fkz',
                'menu_id' => 'M10015',
                'category' => 'Consignee',
                'name' => 'Consignee',
                'route' => 'dashboard.consignee.*',
                'icon' => 'fa-user',
                'is_menu' => '1',
                'is_dropdown' => '1',
            ],

        ]);
        \App\Models\Submenu::insert([

            [
                'slug' => 'foQ31iIWvGd62I1a',
                'submenu_id' => 'gbWmfSnzLKb',
                'menu_id' => 'M10015',
                'is_nav' => 1,
                'nav_name' =>'Manage',
                'name' => 'Consignee Index',
                'route' => 'dashboard.consignee.index',
            ],
            [
                'slug' => 'gE03nLSLmVdesbmc',
                'submenu_id' => 'tjfiFO1M7Yd',
                'menu_id' => 'M10015',
                'is_nav' => 0,
                'nav_name' =>'',
                'name' => 'Consignee Store',
                'route' => 'dashboard.consignee.store',
            ],
            [
                'slug' => 'JJszfMqeDHI3EX6e',
                'submenu_id' => '0E0QTLm23Cf',
                'menu_id' => 'M10015',
                'is_nav' => 0,
                'nav_name' =>'',
                'name' => 'Consignee Edit',
                'route' => 'dashboard.consignee.edit',
            ],
            [
                'slug' => 'FO6FByJz7qSucyRg',
                'submenu_id' => '5fwCoeI1wkh',
                'menu_id' => 'M10015',
                'is_nav' => 0,
                'nav_name' =>'',
                'name' => 'Consignee Update',
                'route' => 'dashboard.consignee.update',
            ],
            [
                'slug' => 'k18UHt4wz4ZTrcti',
                'submenu_id' => 'GKlEZyoSrij',
                'menu_id' => 'M10015',
                'is_nav' => 0,
                'nav_name' =>'',
                'name' => 'Consignee Destroy',
                'route' => 'dashboard.consignee.destroy',
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
        Schema::dropIfExists('consignee');
    }
};
