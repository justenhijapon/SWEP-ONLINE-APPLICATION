<?php

namespace App\Core\Repositories;
 
use App\Core\BaseClasses\BaseRepository;
use App\Core\Interfaces\MenuInterface;
use App\Models\Menu;

class MenuRepository extends BaseRepository implements MenuInterface {
	


    protected $menu;



	public function __construct(Menu $menu){

        $this->menu = $menu;
        parent::__construct();

    }





    public function fetch($slug){

        $menu = $this->findBySlug($slug);
        return $menu;

    }


    public function fetchTable($data){
        $get = $this->menu;

        if(!empty($data->is_menu)){
            switch ($data->is_menu) {
                case 'yes':
                    $get = $get->where("is_menu", "=", "1");
                    break;
                case 'no':
                    $get = $get->where("is_menu", "=", "0");
                    break;
                default:
                    $get = $get;
                    break;
            }
        }

        if(!empty($data->is_dropdown)){
            switch ($data->is_dropdown) {
                case 'yes':
                    $get = $get->where("is_dropdown", "=", "1");
                    break;
                case 'no':
                    $get = $get->where("is_dropdown", "=", "0");
                    break;
                default:
                    $get = $get;
                    break;
            }
        }


        return $get->latest()->get();


    }

    public function store($request){
        $menu = new Menu;
        $menu->menu_id = $this->getMenuIdInc();
        $menu->slug = $this->str->random(16);
        $menu->name = $request->name;
        $menu->route = $request->route;
        $menu->category = $request->category;
        $menu->icon = $request->icon;
        $menu->is_menu = $request->is_menu;
        $menu->is_dropdown = $request->is_dropdown;
        $menu->created_at = $this->carbon->now();
        $menu->updated_at = $this->carbon->now();
        $menu->ip_created = request()->ip();
        $menu->ip_updated = request()->ip();
        $menu->user_created = $this->auth->user()->user_id;
        $menu->user_updated = $this->auth->user()->user_id;
        $menu->save();
        return $menu;

    }





    public function update($request, $slug){

        $menu = $this->findBySlug($slug);
        $menu->name = $request->name;
        $menu->route = $request->route;
        $menu->category = $request->category;
        $menu->icon = $request->icon;
        $menu->is_menu = $request->is_menu;
        $menu->is_dropdown = $request->is_dropdown;
        $menu->updated_at = $this->carbon->now();
        $menu->ip_updated = request()->ip();
        $menu->user_updated = $this->auth->user()->user_id;
        $menu->save();

        return $menu;


    }





    public function destroy($slug){

        $menu = $this->findBySlug($slug);
        $menu->delete();
        $menu->submenu()->delete();

        return $menu;

    }


    public function findBySlug($slug){


	    return $this->menu->where('slug', $slug)->first();



        // $menu = $this->menu->where('slug', $slug)->first();
        
        if(empty($menu)){ abort(404); }

        return $menu;

    }






    public function findByMenuId($menu_id){

        $menu = $this->cache->remember('menus:findByMenuId:' . $menu_id, 240, function() use ($menu_id){
            return $this->menu->where('menu_id', $menu_id)->first();
        });
        
        if(empty($menu)){ abort(404); }
        
        return $menu;

    }






    public function getAll(){

        $menus =  $this->menu->get();
        return $menus;

    }



    public function getRaw(){

        $menus =  $this->menu;
        return $menus;

    }


    private function getMenuIdInc(){

        $id = 'M10001';
        $menu = $this->menu->select('menu_id')->orderBy('menu_id', 'desc')->first();

        if($menu != null){
            $num = str_replace('M', '', $menu->menu_id) + 1;
            $id = 'M' . $num;
        }
        
        return $id;
        
    }



    public function reorderMenus($slug,$order){
        $menu = $this->findBySlug($slug);
        $menu->order = $order;
        $menu->save();

        return $menu;
    }


    private function search($instance, $key){

        return $instance->where(function ($instance) use ($key) {
                    $instance->where('name', 'LIKE', '%'. $key .'%');        
        });

    }





    private function populate($instance, $entries){

        return $instance->select('name', 'route', 'icon', 'slug')
                        ->sortable()
                        ->orderBy('updated_at', 'desc')
                        ->paginate($entries);

    }






}