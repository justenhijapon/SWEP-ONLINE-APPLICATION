<?php

namespace App\Core\Repositories;
 
use App\Core\BaseClasses\BaseRepository;
use App\Core\Interfaces\UserSubmenuInterface;

use Route;
use App\Models\UserSubmenu;
use App\Models\Submenu;

class UserSubmenuRepository extends BaseRepository implements UserSubmenuInterface {
	



    protected $user_submenu;
    protected $submenu;



	public function __construct(UserSubmenu $user_submenu, Submenu $submenu){

        $this->user_submenu = $user_submenu;
        $this->submenu = $submenu;
        parent::__construct();

    }






    public function store($user, $submenu_id, $user_menu_id){

        $user_submenu = new UserSubMenu;
        $user_submenu->user_menu_id = $user_menu_id;
        $user_submenu->submenu_id = $submenu_id;
        $user_submenu->user_id = $user;
        // $user_submenu->is_nav = $submenu->is_nav;
        // $user_submenu->name = $submenu->name;
        // $user_submenu->nav_name = $submenu->nav_name;
        // $user_submenu->route = $submenu->route;
        $user_submenu->save();

        return $user_submenu;

    }






    public function isExist() {

        $user_id = $this->auth->user()->user_id;
        $route_name = Route::currentRouteName();

        $submenu = $this->submenu->where('route',$route_name)->first();

        if(!empty($submenu)){
            $usm = $this->user_submenu->where('submenu_id', $submenu->submenu_id)->where('user_id', $user_id)->exists();
            return $usm;
        }

        // $user_submenu = $this->cache->remember('nav:user_submenus:byUserId:' . $user_id .':byRoute:'. $route_name, 240, function() use($user_id, $route_name){
        //     $usm = $this->user_submenu->where('route', $route_name)->where('user_id', $user_id)->exists();
        //     return $usm;
        // });

        // return $user_submenu;

    }

    public function getAll(){
	    $user_submenus = $this->user_submenu->with(['subMenu.menu','subMenu'])->where('user_id','=',$this->auth->user()->user_id)->get();
	    return $user_submenus;
    }






}