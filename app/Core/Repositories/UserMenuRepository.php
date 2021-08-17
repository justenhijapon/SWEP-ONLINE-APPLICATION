<?php

namespace App\Core\Repositories;
 
use App\Core\BaseClasses\BaseRepository;
use App\Core\Interfaces\UserMenuInterface;

use Route;
use App\Models\UserMenu;
use App\Models\Menu;

class UserMenuRepository extends BaseRepository implements UserMenuInterface {
	


    protected $user_menu;
    protected $menu;


	public function __construct(UserMenu $user_menu, Menu $menu){

        $this->user_menu = $user_menu;
        $this->menu = $menu;
        parent::__construct();

    }






    public function store($user, $menu){

        $user_menu = new UserMenu;
        $user_menu->user_menu_id = $this->getUserMenuIdInc();
        $user_menu->user_id = $user;
        $user_menu->menu_id = $menu;
     //    $user_menu->name = $menu->name;
     //    $user_menu->category = $menu->category;
     //    $user_menu->route = $menu->route;
     //    $user_menu->icon = $menu->icon;
     //    $user_menu->is_menu = $menu->is_menu;
     //    $user_menu->is_dropdown = $menu->is_dropdown; 
        $user_menu->save();

        return $user_menu;
        
    }








    public function getByCategory($cat){

        $user_menus = $this->cache->remember('user_menus:getByCategory:'. $this->auth->user()->user_id .':'.$cat.'', 240, function() use ($cat){
          return $this->user_menu->where('user_id', $this->auth->user()->user_id)
                                 ->where('category', $cat)
                                 ->with('userSubMenu')
                                 ->get();
        });

        return $user_menus;
        
    }








    public function getAll(){
        return $user_menus = $this->user_menu->where('user_id','=', $this->auth->user()->user_id)->get();
//        $user_menus = $this->user_menu
//        ->leftJoin('su_menus','su_user_menus.menu_id', '=', 'su_menus.menu_id')
//        ->where('user_id', $this->auth->user()->user_id)
//        ->orderBy('su_menus.order','asc')
//        ->with('userSubMenu')
//        ->get();
//
//        return $user_menus;
        
    }








    public function isExist() {

        $user_id = $this->auth->user()->user_id;
        $route_name = Route::currentRouteName();

        $menu = $this->menu->where('route',$route_name)->first();

        if(!empty($menu)){
            $um = $this->user_menu->where('menu_id', $menu->menu_id)
                                  ->where('user_id', $user_id)
                                  ->exists();
            return $um;
        }


        // $user_menu = $this->cache->remember('nav:user_menus:byUserId:'. $user_id .':byRoute:'. $route_name, 240, function() use($user_id, $route_name){
        //     $um = $this->user_menu->where('route', $route_name)
        //                           ->where('user_id', $user_id)
        //                           ->exists();
        //     return $um;
        // });

        // return $user_menu;

    }







    private function getUserMenuIdInc(){

        $id = 'UM10000001';

        $usermenu = $this->user_menu->select('user_menu_id')->orderBy('user_menu_id', 'desc')->first();

        if($usermenu != null){
            $num = str_replace('UM', '', $usermenu->user_menu_id) + 1;
            $id = 'UM' . $num;
        }
        
        return $id;
        
    }








}