<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
class CreateRecipientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('recipients', function (Blueprint $table) {
            $table->increments('id');
            $table->string('slug',24);
            $table->string('lastname',45);
            $table->string('firstname',45);
            $table->string('middlename',45);
            $table->date('birthday');
            $table->string('sex',10);
            $table->string('appointment_status',45);
            $table->string('phone',45);
            $table->string('afd_slug',45);
            $table->string('user_created',45);
            $table->string('user_updated',45);
            $table->timestamps();
        });

        if(Schema::hasTable('su_menus')){
            $base_route = 'dashboard.recipients.';
            $menu_id = Str::random(10);

            $menus = DB::table('su_menus')
                ->where('menu_id','=',$menu_id)
                ->first();
            if(empty($menus)){

                DB::table('su_menus')->insert(array(
                    'slug' => 'zcC7wK1hpef2jQRo',
                    'menu_id' => $menu_id,
                    'name' => 'Recipients',
                    'route' => $base_route.'*',
                    'icon' => 'fa-times',
                    'is_menu' => 1,
                    'is_dropdown' => 1,
                    'order' => 10,
                    'created_at' => \Carbon\Carbon::now(),
                    'user_created' => 'system',
                ));
            }

            DB::table('su_submenus')->insert([
                [
                    'submenu_id' => Str::random(10),
                    'menu_id' => $menu_id,
                    'is_nav' => 1,
                    'name' => 'Recipients Index',
                    'nav_name' => 'Manage',
                    'route'=> $base_route.'index',
                ],
                [
                    'submenu_id' => Str::random(10),
                    'menu_id' => $menu_id,
                    'is_nav' => 0,
                    'name' => 'Recipients Store',
                    'nav_name' => '',
                    'route'=> $base_route.'store',
                ]
                ,
                [
                    'submenu_id' => Str::random(10),
                    'menu_id' => $menu_id,
                    'is_nav' => 0,
                    'name' => 'Recipients Edit',
                    'nav_name' => '',
                    'route'=> $base_route.'edit',
                ],
                [
                    'submenu_id' => Str::random(10),
                    'menu_id' => $menu_id,
                    'is_nav' => 0,
                    'name' => 'Recipients Update',
                    'nav_name' => '',
                    'route'=> $base_route.'update',
                ],
                [
                    'submenu_id' => Str::random(10),
                    'menu_id' => $menu_id,
                    'is_nav' => 0,
                    'name' => 'Recipients Show',
                    'nav_name' => '',
                    'route'=> $base_route.'show',
                ],
                [
                    'submenu_id' => Str::random(10),
                    'menu_id' => $menu_id,
                    'is_nav' => 0,
                    'name' => 'Recipients Destroy',
                    'nav_name' => '',
                    'route'=> $base_route.'destroy',
                ]
            ]);
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('recipients');
    }
}
