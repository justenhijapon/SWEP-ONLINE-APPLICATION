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
        Schema::create('attribution', function (Blueprint $table) {
            $table->increments('id');
            $table->string('slug');
            $table->string('activity');
            $table->date('date');
            $table->string('project_code')->nullable(true);
            $table->string('item')->nullable(true);
            $table->decimal('utilized_fund',15,2)->nullable(true);
            $table->string('venue')->nullable(true);
            $table->mediumText('details')->nullable(true);
            $table->integer('has_participants')->nullable(true);
            $table->timestamps();
            $table->string('user_created')->nullable(true);
            $table->string('user_updated')->nullable(true);
            $table->string('ip_created')->nullable(true);
            $table->string('ip_updated')->nullable(true);
        });

        \App\Models\Submenu::insert([

            [
                'slug' => 'QVjsBiE5q25jHyOV',
                'submenu_id' => 'TtuNL8Z',
                'menu_id' => 'M10016',
                'is_nav' => 1,
                'nav_name' =>'Manage',
                'name' => 'Attributions List',
                'route' => 'dashboard.attributions.index',
            ],
            [
                'slug' => 'i4kRgjXnBqSDjNwK',
                'submenu_id' => 'tCWCmA1',
                'menu_id' => 'M10016',
                'is_nav' => 1,
                'nav_name' =>'Manage',
                'name' => 'Attributions List',
                'route' => 'dashboard.attributions.index',
            ],
            [
                'slug' => 'xIi6UQNxx44h4Chq',
                'submenu_id' => 'nDqfFER',
                'menu_id' => 'M10016',
                'is_nav' => 1,
                'nav_name' =>'Manage',
                'name' => 'Attributions List',
                'route' => 'dashboard.attributions.index',
            ],
            [
                'slug' => 'PUYWqRuZPstXHyWA',
                'submenu_id' => 'LPajiiu',
                'menu_id' => 'M10016',
                'is_nav' => 1,
                'nav_name' =>'Manage',
                'name' => 'Attributions List',
                'route' => 'dashboard.attributions.index',
            ],
            [
                'slug' => '4IWOzI3jRm9rPKMp',
                'submenu_id' => 'Hxi6SPA',
                'menu_id' => 'M10016',
                'is_nav' => 1,
                'nav_name' =>'Manage',
                'name' => 'Attributions List',
                'route' => 'dashboard.attributions.index',
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
