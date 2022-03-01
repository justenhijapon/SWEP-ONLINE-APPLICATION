<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddMenuOtherParticipants extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('other_activities_participants', function (Blueprint $table){
            $table->increments('id');
            $table->string('slug');
            $table->string('other_activity');
            $table->string('lastname');
            $table->string('firstname');
            $table->string('middlename')->nullable(true);
            $table->string('sex');
            $table->integer('age')->nullable('true');
            $table->string('group')->nullable(true);
            $table->timestamps();
            $table->string('user_created')->nullable(true);
            $table->string('user_updated')->nullable(true);
            $table->string('ip_created')->nullable(true);
            $table->string('ip_updated')->nullable(true);
        });
        \App\Models\Submenu::insert([
            [
                'slug' => 'dbDQGJigNgRmoR48',
                'submenu_id' => 'SW19QYJ',
                'menu_id' => 'M10006',
                'is_nav' => 0,
                'nav_name' =>'',
                'name' => 'Other Activities Participants Store',
                'route' => 'dashboard.other_activities_participants.store',
            ],
            [
                'slug' => 'obPrWmfrc7BcwtaF',
                'submenu_id' => 'ER5TIHD',
                'menu_id' => 'M10006',
                'is_nav' => 0,
                'nav_name' =>'',
                'name' => 'Other Activities Participants Index',
                'route' => 'dashboard.other_activities_participants.index',
            ],
            [
                'slug' => '1AZ5q6RdbpsD07pz',
                'submenu_id' => 'PAMGAR0',
                'menu_id' => 'M10006',
                'is_nav' => 0,
                'nav_name' =>'',
                'name' => 'Other Activities Participants Edit',
                'route' => 'dashboard.other_activities_participants.edit',
            ],
            [
                'slug' => 'iZN6G26FQcz9k0FD',
                'submenu_id' => 'KGDSZVH',
                'menu_id' => 'M10006',
                'is_nav' => 0,
                'nav_name' =>'',
                'name' => 'Other Activities Participants Update',
                'route' => 'dashboard.other_activities_participants.update',
            ],
            [
                'slug' => '7mbCEzJUIOQAcGKH',
                'submenu_id' => 'TG3GXGA',
                'menu_id' => 'M10006',
                'is_nav' => 0,
                'nav_name' =>'',
                'name' => 'Other Activities Participants Destroy',
                'route' => 'dashboard.other_activities_participants.destroy',
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
        Schema::drop('other_activities_participants');
        $sm = \App\Models\Submenu::query()->where('slug','=','dbDQGJigNgRmoR48')->first();
        if(!empty($sm)){
            $sm->delete();
        }
        
        $sm = \App\Models\Submenu::query()->where('slug','=','obPrWmfrc7BcwtaF')->first();
        if(!empty($sm)){
            $sm->delete();
        }
        $sm = \App\Models\Submenu::query()->where('slug','=','1AZ5q6RdbpsD07pz')->first();
        if(!empty($sm)){
            $sm->delete();
        }
        $sm = \App\Models\Submenu::query()->where('slug','=','iZN6G26FQcz9k0FD')->first();
        if(!empty($sm)){
            $sm->delete();
        }
        $sm = \App\Models\Submenu::query()->where('slug','=','7mbCEzJUIOQAcGKH')->first();
        if(!empty($sm)){
            $sm->delete();
        }
    }
}
