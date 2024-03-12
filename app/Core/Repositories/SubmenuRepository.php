<?php

namespace App\Core\Repositories;
 
use App\Core\BaseClasses\BaseRepository;
use App\Core\Interfaces\SubmenuInterface;


use App\Models\Submenu;
use Illuminate\Support\Str;


class SubmenuRepository extends BaseRepository implements SubmenuInterface {
	



    protected $submenu;




	public function __construct(Submenu $submenu){

        $this->submenu = $submenu;
        parent::__construct();

    }






    public function store($request){


        $submenu = new Submenu;
        $submenu->slug = $this->str->random(16);
        $submenu->submenu_id = $this->getSubmenuIdInc();
        $submenu->menu_id = $request->menu;
        $submenu->name = $request->name;
        $submenu->route = $request->route;
        $submenu->is_nav = $request->is_nav;
        $submenu->save();
        
        return $submenu;

    }






    public function findBySubmenuId($submenu_id){

        $submenu = $this->cache->remember('submenus:findBySubmenuId:' . $submenu_id, 240, function() use ($submenu_id){
            return $this->submenu->where('submenu_id', $submenu_id)->first();
        });
        
        if(empty($submenu)){ abort(404); }
        
        return $submenu;

    }

    public function findBySlug($slug){
        return $this->submenu->where('slug', $slug)->first();
    }






    public function getSubmenuIdInc(){

        $id = 'SM100001';
        $submenu = $this->submenu->select('submenu_id')->orderBy('submenu_id', 'desc')->first();

        if($submenu != null){
            $id = Str::random(10);
        }
        
        return $id;
        
    }






    public function getAll(){

        $submenus = $this->cache->remember('submenus:getAll', 240, function(){
            return $this->submenu->select('menu_id','submenu_id', 'name', 'is_nav')
                                 ->orderBy('submenu_id', 'asc')
                                 ->get();
        });
        
        return $submenus;

    }






    public function getByMenuId($menu_id){

        $submenu = $this->cache->remember('submenus:getByMenuId:'. $menu_id .'', 240, function() use ($menu_id){

            return $this->submenu->select('submenu_id', 'name')
                                 ->where('menu_id', $menu_id)
                                 ->orderBy('submenu_id', 'asc')
                                 ->get();

        });

        return $submenu;

    }



    public function edit($slug){
    }
    
    public function update($request, $slug){
        $submenu = $this->findBySlug($slug);
        $submenu->name = $request->name;
        $submenu->route = $request->route;
        $submenu->nav_name = $request->nav_name;
        $submenu->is_nav = $request->is_nav;
        $submenu->save();
        return $submenu;
    }   

    public function destroy($slug){
        $submenu = $this->findBySlug($slug);
        $submenu->delete();
        return $submenu;
    }





}