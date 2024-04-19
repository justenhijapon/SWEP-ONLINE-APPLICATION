<?php

namespace App\Http\Controllers;


use App\Core\Services\MenuService;
use App\Http\Requests\Menu\MenuFormRequest;
use App\Http\Requests\Menu\MenuFilterRequest;
use App\Models\Menu;
use Illuminate\Http\Request;



class MenuController extends Controller{


    protected $menu;



    public function __construct(MenuService $menu){

        $this->menu = $menu;

    }


    
    public function index(){
        
       if(request()->ajax())
        {      
            $data = request();
            return datatables()->of($this->menu->fetchTable($data))
            ->addColumn('action', function($data) {
                return view('dashboard.menu.dtAction')->with([
                    'data' => $data,
                ]);
            })
            ->editColumn('is_menu',function($data){
                if($data->is_menu == 1){
                    return '<center><span class="bg-green badge"><i class="fa fa-check"></i></span></center>';
                }elseif($data->is_menu == 0){
                    return '<center><span class="bg-red badge"><i class="fa fa-times"></i></span></center>';
                }else{
                    return $data->sex;
                }
                
            })
            ->editColumn('is_dropdown',function($data){
                if($data->is_dropdown == 1){
                    return '<center><span class="bg-green badge"><i class="fa fa-check"></i></span></center>';
                }elseif($data->is_dropdown == 0){
                    return '<center><span class="bg-red badge"><i class="fa fa-times"></i></span></center>';
                }else{
                    return $data->sex;
                }
                
            })
            ->editColumn('submenus', function($data){
                $ret = '';

                foreach ($data->submenu as $key => $value) {
                    $value->name = str_replace($data->name, '', $value->name);
                    $ret = $ret . $value->name .' | ';
                }
                return substr_replace($ret ,"", -2);
            }) 
            ->editColumn('icon', function($data){
                return '<center><span><i class="fa '.$data->icon.'"></i></span></center>';
            })         
            ->escapeColumns([])
            ->setRowId('slug')
            ->make(true);
        }

        return view('dashboard.menu.index');

    }

    public function getMenus(){
        $menus =  $this->menu->getAll();

        return view('dashboard.menu.reorder_menu')->with(['menus'=> $menus]);
    }

    public function get_meunus(){
        $menus =  $this->menu->getAll();

        return view('dashboard.menu.reorder_menu')->with(['menus'=> $menus]);
    }



    public function reorderMenus(Request $request){
        $array = $request->get('array');
        $menus =  $this->menu->reorderMenus($array);
        return $menus;
    }

    public function create(){
        
        return view('dashboard.menu.create');

    }

   

    public function store(MenuFormRequest $request){
        
        return $this->menu->store($request);

    }




    public function edit($slug){

        $menu = Menu::query()
            ->where('slug', $slug)
            ->first();
            $menu ?? abort(404,'Origin not found.');
        return view('dashboard.menu.edit')->with([
            'menu'=>$menu,
        ]);
    }




    public function update(MenuFormRequest $request, $slug){
        
        return $this->menu->update($request, $slug);

    }




    public function destroy($slug){

        $menu = Menu::query()
            ->where('slug', $slug)
            ->first();
            $menu ?? abort(404,'Menu not found.');
        if($menu->delete()){
            $menu->submenu()->delete();
            return 1;
        }
    }



    
}
