<?php

namespace App\Core\ViewComposers;


use App\Core\Interfaces\MenuInterface;
use App\Core\Interfaces\UserSubmenuInterface;
use View;
use Auth;
use App\Core\Interfaces\UserMenuInterface;


class SidenavComposer{



    protected $menu_repo;
    protected $user_submenu_repo;
    protected $auth;




    public function __construct(MenuInterface $menu_repo, UserSubmenuInterface $user_submenu_repo){

        $this->menu_repo = $menu_repo;
        $this->user_submenu_repo = $user_submenu_repo;
        $this->auth = auth();

    }





    public function compose($view){

        $user_menus = [];

        if($this->auth->check()){
//            $user_menus = $this->user_menu_repo->getAll();
        }

        $menus_db = $this->menu_repo->getAll();
        $user_submenus_db = $this->user_submenu_repo->getAll();
        $menu_tree = [];

        foreach ($user_submenus_db as $user_submenu_db){
            if(!empty($user_submenu_db->subMenu->menu)){
                if($user_submenu_db->subMenu->menu->is_menu != 0){
                    if($user_submenu_db->subMenu->is_nav == 1){
                        $menu_tree[$user_submenu_db->subMenu->menu->order.'_'.$user_submenu_db->subMenu->menu->slug][$user_submenu_db->subMenu->name] = [];
                        $menu_tree[$user_submenu_db->subMenu->menu->order.'_'.$user_submenu_db->subMenu->menu->slug]['menu_obj'] = $user_submenu_db->subMenu->menu;
                        $menu_tree[$user_submenu_db->subMenu->menu->order.'_'.$user_submenu_db->subMenu->menu->slug]['submenus'][$user_submenu_db->subMenu->name]['submenu_obj'] = $user_submenu_db->subMenu;
                    }
                }
            }
       }

        ksort($menu_tree);
//        dd($menu_tree);
        $view->with(['global_user_menus' => $user_menus, 'global_menu_tree' => $menu_tree ,'user_submenus' => $user_submenus_db]);
    }






}