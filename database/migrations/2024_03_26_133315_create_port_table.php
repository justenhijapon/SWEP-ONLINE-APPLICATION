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
        Schema::create('port', function (Blueprint $table) {
            $table->increments('id');
            $table->string('slug');
            $table->string('category')->nullable(true);
            $table->string('port_name')->nullable(true);
            $table->string('ship')->nullable(true);
            $table->string('vessel')->nullable(true);
            $table->timestamps();
            $table->string('user_created')->nullable(true);
            $table->string('user_updated')->nullable(true);
            $table->string('ip_created')->nullable(true);
            $table->string('ip_updated')->nullable(true);
        });
        \App\Models\Menu::insert([

            [
                'slug' => 'mIRkFTIu8N2eD7L6',
                'menu_id' => 'M10012',
                'category' => 'Port',
                'name' => 'Port',
                'route' => 'dashboard.port.*',
                'icon' => 'fa-ship',
                'is_menu' => '1',
                'is_dropdown' => '1',
            ],

        ]);
        \App\Models\Submenu::insert([

            [
                'slug' => '0GhFePu6UtvnizOU',
                'submenu_id' => '8hnH1fC2krs',
                'menu_id' => 'M10012',
                'is_nav' => 1,
                'nav_name' =>'Manage',
                'name' => 'Port Index',
                'route' => 'dashboard.port.index',
            ],
            [
                'slug' => 'rEpGaPLo5yCMOyLk',
                'submenu_id' => 'X8w0sPHBoRP',
                'menu_id' => 'M10012',
                'is_nav' => 0,
                'nav_name' =>'',
                'name' => 'Port Store',
                'route' => 'dashboard.port.store',
            ],
            [
                'slug' => 'rWCdV5BVlZbCrfEk',
                'submenu_id' => 'Ns67fqYteWf',
                'menu_id' => 'M10012',
                'is_nav' => 0,
                'nav_name' =>'',
                'name' => 'Port Edit',
                'route' => 'dashboard.port.edit',
            ],
            [
                'slug' => '6zx7LARQKboIvYjn',
                'submenu_id' => '4sIKUOHKoN9',
                'menu_id' => 'M10012',
                'is_nav' => 0,
                'nav_name' =>'',
                'name' => 'Port Update',
                'route' => 'dashboard.port.update',
            ],
            [
                'slug' => 'H4AVikywfOLbXb8k',
                'submenu_id' => 'a1DApPdiaFt',
                'menu_id' => 'M10012',
                'is_nav' => 0,
                'nav_name' =>'',
                'name' => 'Port Destroy',
                'route' => 'dashboard.port.destroy',
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
