<?php
 
namespace App\Core\Services;

use App\Core\BaseClasses\BaseService;
use App\Core\Interfaces\UserInterface;
use App\Core\Interfaces\UserMenuInterface;
use App\Core\Interfaces\UserSubmenuInterface;
use App\Core\Interfaces\MenuInterface;
use App\Core\Interfaces\SubmenuInterface;

use App\Models\UserSubmenu;
use Hash;

class UserService extends BaseService{


    protected $user_repo;
    protected $user_menu_repo;
    protected $user_submenu_repo;
    protected $menu_repo;
    protected $submenu_repo;



    public function __construct(UserInterface $user_repo, UserMenuInterface $user_menu_repo, UserSubmenuInterface $user_submenu_repo, MenuInterface $menu_repo, SubmenuInterface $submenu_repo){

        $this->user_repo = $user_repo;
        $this->user_menu_repo = $user_menu_repo;
        $this->user_submenu_repo = $user_submenu_repo;
        $this->menu_repo = $menu_repo;
        $this->submenu_repo = $submenu_repo;

        parent::__construct();

    }



    public function fetchTable($data){
        return $this->user_repo->fetchTable($data);
    }


    public function fetch($request){

        $users = $this->user_repo->fetch($request);
        $request->flash();
        
        return view('dashboard.user.index')->with('users', $users);

    }






    public function store($request){

        $menu = $request->menu;

        $menu['M10001'] = [];
        asort($menu);

        $request->merge(['menu' => $menu]);


        $user = $this->user_repo->store($request);
        $user_id = $user->user_id;
        $user_submenu_to_db = [];
        if(!empty($request->menu)){
            foreach ($request->menu as $key => $menu_itself) {
                $user_menu = $this->user_menu_repo->store($user_id, $key);
                $user_menu_id = $user_menu->user_menu_id;

                foreach ($menu_itself as $key2 => $submenu) {

                    $user_submenu = $this->user_submenu_repo->store($user_id,$submenu, $user_menu_id);
                }
            }
        }
        return $user;

    }






    public function show($slug){
        
        $user = $this->user_repo->findBySlug($slug);  
        $menus = $this->userMenus();
      
        //return $submenus;
        return view('dashboard.user.show')->with(['user' => $user, 'menus' => $menus]);

    }






    public function edit($slug){
    
    	$user = $this->user_repo->findBySlug($slug);  
        $menus = $this->userMenus();


        return view('dashboard.user.edit')->with(['user'=> $user,'menus'=>$menus]);

    }






    public function update($request, $slug){

        $user = $this->user_repo->update($request, $slug);
        $menu = $request->menu;

        $menu['M10001'] = [];
        asort($menu);

        $request->merge(['menu' => $menu]);

        $user_id = $user->user_id;
        $user_submenu_to_db = [];
        if(!empty($request->submenus)){
            foreach ($request->submenus as $submenu){
                $user_submenu = new UserSubmenu();
                $user_submenu->user_id = $user_id;
                $user_submenu->submenu_id =$submenu;
                $user_submenu_to_db[] = $user_submenu->attributesToArray();
            }
        }
        UserSubmenu::insert($user_submenu_to_db);
        return $user->only(['slug']);
//        if(!empty($request->menu)){
//            foreach ($request->menu as $key => $menu_itself) {
//                $user_menu = $this->user_menu_repo->store($user_id, $key);
//                $user_menu_id = $user_menu->user_menu_id;
//                foreach ($menu_itself as $key2 => $submenu) {
//                    $user_sub = new UserSubmenu();
//                    $user_sub->user_menu_id = $user_menu_id;
//                    $user_sub->submenu_id = $submenu;
//                    $user_sub->user_id = $user_id;
//                    //return $user_submenu_to_repo = $user_sub->attributesToArray();
//                    $user_sub = $this->user_submenu_repo->store($user_id,$submenu, $user_menu_id);
//                }
//            }
//        }
        //return $user_submenu_to_repo;
        UserSubmenu::insert($user_submenu_to_db);
        return $user;

    }






    public function destroy($slug){

        $user = $this->user_repo->destroy($slug);

        return $user;

    }






    public function activate($slug){

        $user = $this->user_repo->activate($slug);  

        if($user){
            return json_encode(array('result'=> 1, 'slug'=>$user->slug));
        }

    }






    public function deactivate($slug){

        $user = $this->user_repo->deactivate($slug);  
        
        if($user){
            return json_encode(array('result'=> 2, 'slug'=>$user->slug));
        }

    }






    public function logout($slug){

        $user = $this->user_repo->logout($slug);  

        $this->event->fire('user.logout', $user);
        return redirect()->back();

    }






    public function resetPassword($slug){

        $user = $this->user_repo->findBySlug($slug); 
        return view('dashboard.user.reset_password')->with('user', $user);

    }






    public function resetPasswordPost($request, $slug){

        
        $user = $this->user_repo->findBySlug($slug);  

        if($slug == $this->auth->user()->slug){
            return json_encode(array('result'=>0, 'message'=>'Please refer to profile page if you want to reset your own password.'));

        }else{
            if(Hash::check($request->user_password, $this->auth->user()->password)){
                $checking_username = $this->user_repo->findByUsername($request->username);
                
                if(empty($checking_username)){
                    $instance = $this->user_repo->resetPassword($user, $request);
                    if($instance){
                        return json_encode(array('result'=>1,'slug'=>$instance->slug)) ;
                    }
                }else{
                    if($slug == $checking_username->slug){
                        $instance = $this->user_repo->resetPassword($user, $request);
                        if($instance){
                            return json_encode(array('result'=>1,'slug'=>$instance->slug)) ;
                        }

                    }else{
                        return json_encode(array('result'=>-1, 'message'=>'Username already exists', 'target'=>'username'));
                    }
                }
            }else{
                return json_encode(array('result'=>-1, 'message'=>'Your password is incorrect', 'target'=>'user_password'));
            }
        }
 

        
        
    }




    public function userMenus(){
        $menus = $this->menu_repo->getAll();
        return $menus;
    }




}