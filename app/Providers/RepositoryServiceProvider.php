<?php

namespace App\Providers;
 
use Illuminate\Support\ServiceProvider;
use App\Core\Interfaces\ActivityLogInterface;
use App\Http\Controllers\ProfileController;
use App\Core\Services\ProfileService;

class RepositoryServiceProvider extends ServiceProvider {
	


	public function register(){

		$this->app->bind('App\Core\Interfaces\UserInterface', 'App\Core\Repositories\UserRepository');
		$this->app->bind('App\Core\Interfaces\UserMenuInterface', 'App\Core\Repositories\UserMenuRepository');
		$this->app->bind('App\Core\Interfaces\UserSubmenuInterface', 'App\Core\Repositories\UserSubmenuRepository');

		$this->app->bind('App\Core\Interfaces\MenuInterface', 'App\Core\Repositories\MenuRepository');
		$this->app->bind('App\Core\Interfaces\SubmenuInterface', 'App\Core\Repositories\SubmenuRepository');

		$this->app->bind('App\Core\Interfaces\ProfileInterface', 'App\Core\Repositories\ProfileRepository');
        $this->app->bind('App\Core\Interfaces\ActivityLogInterface',  'App\Core\Repositories\ActivityLogRepository');



    }



}