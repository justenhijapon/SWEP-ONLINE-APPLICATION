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
        Schema::create('origin', function (Blueprint $table) {
            $table->increments('id');
            $table->string('slug');
            $table->string('origin')->nullable(true);
            $table->string('source')->nullable(true);
            $table->string('name')->nullable(true);
            $table->timestamps();
            $table->string('user_created')->nullable(true);
            $table->string('user_updated')->nullable(true);
            $table->string('ip_created')->nullable(true);
            $table->string('ip_updated')->nullable(true);
        });
        \App\Models\Menu::insert([

            [
                'slug' => 'CDBbDXnHdvVdQ1St',
                'menu_id' => 'M10013',
                'category' => 'Origin',
                'name' => 'Origin',
                'route' => 'dashboard.origin.*',
                'icon' => 'fa-map-marker',
                'is_menu' => '1',
                'is_dropdown' => '1',
            ],

        ]);
        \App\Models\Submenu::insert([

            [
                'slug' => 'xkABsO2ZrTWZr3C4',
                'submenu_id' => 'qZA6lFCuYjI',
                'menu_id' => 'M10013',
                'is_nav' => 1,
                'nav_name' =>'Manage',
                'name' => 'Origin Index',
                'route' => 'dashboard.origin.index',
            ],
            [
                'slug' => '9yOlNiM4Lbhw38Gi',
                'submenu_id' => 'KTnNw0CvtHC',
                'menu_id' => 'M10013',
                'is_nav' => 0,
                'nav_name' =>'',
                'name' => 'Origin Store',
                'route' => 'dashboard.origin.store',
            ],
            [
                'slug' => 'mLatr8YyKr3sFTLS',
                'submenu_id' => 'tbarmdqG3nL',
                'menu_id' => 'M10013',
                'is_nav' => 0,
                'nav_name' =>'',
                'name' => 'Origin Edit',
                'route' => 'dashboard.origin.edit',
            ],
            [
                'slug' => 'u9Cfk3Dk2ugK44gx',
                'submenu_id' => 'bjBHU5oxiLh',
                'menu_id' => 'M10013',
                'is_nav' => 0,
                'nav_name' =>'',
                'name' => 'Origin Update',
                'route' => 'dashboard.origin.update',
            ],
            [
                'slug' => 'kz2NkMoP5QSacJCZ',
                'submenu_id' => 'G1rx8arfRjt',
                'menu_id' => 'M10013',
                'is_nav' => 0,
                'nav_name' =>'',
                'name' => 'Origin Destroy',
                'route' => 'dashboard.origin.destroy',
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
