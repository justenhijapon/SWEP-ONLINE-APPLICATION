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
        Schema::create('shipping_permits', function (Blueprint $table) {
            $table->increments('id');
            $table->string('slug');
            $table->integer('sp_no')->nullable(true);
            $table->date('sp_date')->nullable(true);
            $table->date('sp_edd_etd')->nullable(true);
            $table->date('sp_eda_eta')->nullable(true);
            $table->string('sp_port_of_origin')->nullable(true);
            $table->string('sp_port_of_destination')->nullable(true);
            $table->string('sp_vessel')->nullable(true);
            $table->string('sp_ship_operator')->nullable(true);
            $table->string('sp_freight')->nullable(true);
            $table->string('sp_plate_no')->nullable(true);
            $table->string('sp_remarks')->nullable(true);
            $table->string('sp_ref_sp_no')->nullable(true);
            $table->string('sp_mill')->nullable(true);
            $table->string('sp_sugar_class')->nullable(true);
            $table->integer('sp_volume')->nullable(true);
            $table->string('sp_uom')->nullable(true);
            $table->string('sp_or_no')->nullable(true);
            $table->integer('sp_amount')->nullable(true);
            $table->string('sp_status')->nullable(true);
            $table->string('sp_markings')->nullable(true);
            $table->string('sp_shipper')->nullable(true);
            $table->string('sp_shipper_add')->nullable(true);
            $table->integer('sp_shipper_tin')->nullable(true);
            $table->string('sp_consignee')->nullable(true);
            $table->string('sp_consignee_add')->nullable(true);
            $table->integer('sp_consignee_tin')->nullable(true);
            $table->string('sp_collecting_officer')->nullable(true);
            $table->timestamps();
            $table->string('user_created')->nullable(true);
            $table->string('user_updated')->nullable(true);
            $table->string('ip_created')->nullable(true);
            $table->string('ip_updated')->nullable(true);
        });
        \App\Models\Menu::insert([

            [
                'slug' => 'mFBKQja3PNmX9faz',
                'menu_id' => 'M10016',
                'category' => 'Shipping Permit',
                'name' => 'Shipping Permit',
                'route' => 'dashboard.shipping_permits.*',
                'icon' => 'fa-archive',
                'is_menu' => '1',
                'is_dropdown' => '1',
            ],

        ]);
        \App\Models\Submenu::insert([

            [
                'slug' => 'foQ31iIWvGd62Iba',
                'submenu_id' => 'gbWmfSnzLcb',
                'menu_id' => 'M10016',
                'is_nav' => 1,
                'nav_name' =>'Manage',
                'name' => 'Index',
                'route' => 'dashboard.shipping_permits.index',
            ],
            [
                'slug' => 'gE03nLSLmVdesbdc',
                'submenu_id' => 'tjfiFO1M7ed',
                'menu_id' => 'M10016',
                'is_nav' => 0,
                'nav_name' =>'',
                'name' => 'Store',
                'route' => 'dashboard.shipping_permits.store',
            ],
            [
                'slug' => 'JJszfMqeDHI3EXfe',
                'submenu_id' => '0E0QTLm23gf',
                'menu_id' => 'M10016',
                'is_nav' => 0,
                'nav_name' =>'',
                'name' => 'Edit',
                'route' => 'dashboard.shipping_permits.edit',
            ],
            [
                'slug' => 'FO6FByJz7qSucyhg',
                'submenu_id' => '5fwCoeI1wih',
                'menu_id' => 'M10016',
                'is_nav' => 0,
                'nav_name' =>'',
                'name' => 'Update',
                'route' => 'dashboard.shipping_permits.update',
            ],
            [
                'slug' => 'k18UHt4wz4ZTrcji',
                'submenu_id' => 'GKlEZyoSrkj',
                'menu_id' => 'M10016',
                'is_nav' => 0,
                'nav_name' =>'',
                'name' => 'Destroy',
                'route' => 'dashboard.shipping_permits.destroy',
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
        Schema::dropIfExists('shipping_permits');
    }
};
