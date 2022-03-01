<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOfficeActivitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('office_activities', function (Blueprint $table) {
            $table->increments('id');
            $table->string('slug');
            $table->string('activity');
            $table->date('date');
            $table->string('project_code')->nullable(true);
            $table->decimal('utilized_fund',15,2);
            $table->string('venue')->nullable('true');
            $table->mediumText('details')->nullable(true);
            $table->integer('has_participants')->nullable(true);
            $table->timestamps();
            $table->string('user_created')->nullable(true);
            $table->string('user_updated')->nullable(true);
            $table->string('ip_created')->nullable(true);
            $table->string('ip_updated')->nullable(true);
        });
        Schema::create('office_activities_participants', function (Blueprint $table) {
            $table->increments('id');
            $table->string('slug');
            $table->string('office_activity');
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
                'slug' => '5XpsbG747CKt5KE3',
                'submenu_id' => 'WM0JYQY',
                'menu_id' => 'M10006',
                'is_nav' => 0,
                'nav_name' =>'',
                'name' => 'Office Activities Edit',
                'route' => 'dashboard.office_activities.edit',
            ],
            [
                'slug' => 't7nUrSAtH1zisPp6',
                'submenu_id' => 'R0QKCMC',
                'menu_id' => 'M10006',
                'is_nav' => 0,
                'nav_name' =>'',
                'name' => 'Office Activities Update',
                'route' => 'dashboard.office_activities.update',
            ],
            [
                'slug' => 'YzDZcsZ2Zo2ETzH6',
                'submenu_id' => 'QVHLQVS',
                'menu_id' => 'M10006',
                'is_nav' => 0,
                'nav_name' =>'',
                'name' => 'Office Activities Destroy',
                'route' => 'dashboard.office_activities.destroy',
            ],
        ]);


        \App\Models\Submenu::insert([
            [
                'slug' => 'C6jrQ1Y27G13NM83',
                'submenu_id' => 'CVFFPMX',
                'menu_id' => 'M10006',
                'is_nav' => 0,
                'nav_name' =>'',
                'name' => 'Office Activities Participants Store',
                'route' => 'dashboard.office_activities_participants.store',
            ],
            [
                'slug' => 'pWkRgkkkodPK8dL4',
                'submenu_id' => 'N50QZLF',
                'menu_id' => 'M10006',
                'is_nav' => 0,
                'nav_name' =>'',
                'name' => 'Office Activities Participants Index',
                'route' => 'dashboard.office_activities_participants.index',
            ],
            [
                'slug' => 'TtsTv6xx1G1JTOYt',
                'submenu_id' => 'FLZKVNU',
                'menu_id' => 'M10006',
                'is_nav' => 0,
                'nav_name' =>'',
                'name' => 'Office Activities Participants Edit',
                'route' => 'dashboard.office_activities_participants.edit',
            ],
            [
                'slug' => '18irVVlIfxPqXOtU',
                'submenu_id' => 'OSSEQDA',
                'menu_id' => 'M10006',
                'is_nav' => 0,
                'nav_name' =>'',
                'name' => 'Office Activities Participants Update',
                'route' => 'dashboard.office_activities_participants.update',
            ],
            [
                'slug' => '7m9OavdY1oIkkmJe',
                'submenu_id' => 'VDCZBQQ',
                'menu_id' => 'M10006',
                'is_nav' => 0,
                'nav_name' =>'',
                'name' => 'Office Activities Participants Destroy',
                'route' => 'dashboard.office_activities_participants.destroy',
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
        Schema::dropIfExists('office_activities');
        Schema::dropIfExists('office_activities_participants');
        $sm = \App\Models\Submenu::query()->where('slug','=','5XpsbG747CKt5KE3')->first();
        if(!empty($sm)){
            $sm->delete();
        }
        $sm = \App\Models\Submenu::query()->where('slug','=','t7nUrSAtH1zisPp6')->first();
        if(!empty($sm)){
            $sm->delete();
        }
        $sm = \App\Models\Submenu::query()->where('slug','=','YzDZcsZ2Zo2ETzH6')->first();
        if(!empty($sm)){
            $sm->delete();
        }
        
        $sm = \App\Models\Submenu::query()->where('slug','=','C6jrQ1Y27G13NM83')->first();
        if(!empty($sm)){
            $sm->delete();
        }
        
        $sm = \App\Models\Submenu::query()->where('slug','=','pWkRgkkkodPK8dL4')->first();
        if(!empty($sm)){
            $sm->delete();
        }
        
        $sm = \App\Models\Submenu::query()->where('slug','=','TtsTv6xx1G1JTOYt')->first();
        if(!empty($sm)){
            $sm->delete();
        }

        $sm = \App\Models\Submenu::query()->where('slug','=','18irVVlIfxPqXOtU')->first();
        if(!empty($sm)){
            $sm->delete();
        }
        
        $sm = \App\Models\Submenu::query()->where('slug','=','7m9OavdY1oIkkmJe')->first();
        if(!empty($sm)){
            $sm->delete();
        }

    }
}
