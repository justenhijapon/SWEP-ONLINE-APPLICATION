<?php

namespace App\Http\Controllers;

use App\Core\Helpers\Arrays;
use App\Core\Helpers\Helpers;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Core\Services\UserService;
use App\Http\Requests\User\UserFormRequest;
use App\Http\Requests\User\UserFilterRequest;
use App\Http\Requests\User\UserResetPasswordRequest;
use App\Http\Requests\User\UserSyncEmployeeRequest;
use Illuminate\Support\Str;
use Hash;


class UserController extends Controller{

       

    protected $user_service; 



    public function __construct(UserService $user_service){

        $this->user_service = $user_service;

    }




    public function index(UserFilterRequest $request){

        if(request()->ajax())
        {   

            $data = request();
            return datatables()->of($this->user_service->fetchTable($data))
            ->addColumn('action', function($data){
                return view('dashboard.user.dtAction')->with([
                    'data' => $data,
                ]);
            })
            ->addColumn('fullname', function($data){
                return $data->firstname .' '. $data->lastname;
            })
            ->addColumn('online', function($data){
                if($data->is_online == 1){
                    return '<span class="label bg-green col-md-12">ONLINE</span>';
                }else if($data->is_online == 0){
                    return '<span class="label bg-gray col-md-12">OFFLINE</span>';
                }
            })
            ->addColumn('active', function($data){
                if($data->is_active == 1){
                    return '<span class="label bg-green col-md-12">ACTIVE</span>';
                }else if($data->is_active == 0){
                    return '<span class="label bg-red col-md-12">INACTIVE</span>';
                }
                
            })
            ->escapeColumns([])
            ->rawColumns(['action'])
            ->setRowId('slug')
            ->make();
        }

        $menus = $this->user_service->userMenus();
        return view('dashboard.user.index')->with(['menus'=>$menus]);

    }

    


    public function create(){

        return view('dashboard.user.create');
    }


    public function store(UserFormRequest $request){
        $user = new User();
        $user->slug = Str::random(16);
        $user->user_id = Str::random(11);
        $user->email = $request->email;
        $user->username = $request->username;
        $user->password = Hash::make($request->password);
        $user->remember_token = Str::random(60);
        $user->color = Str::of('sidebar-mini skin-yellow');
        $user->lastname = $request->lastname;
        $user->middlename = $request->middlename;
        $user->firstname = $request->firstname;
        $user->position = $request->position;
        $user->created_at = Carbon::now();
        $user->updated_at = Carbon::now();
        $user->ip_created = request()->ip();
        $user->ip_updated = request()->ip();

        if($user->save()){
            return $user->only('slug');
        }
    }

    


    public function show($slug){
        

        return $this->user_service->show($slug);

    }

    


    public function edit($slug){

        return $this->user_service->edit($slug);

    }

    


    public function update(UserFormRequest $request, $slug){

        return $this->user_service->update($request, $slug);
        
    }




    public function destroy($slug){

        $user = User::query()
            ->where('slug', $slug)
            ->first();
            $user ?? abort(404,'User not found.');
        if($user->delete()){
            $user->userMenu()->delete();
            $user->userSubmenu()->delete();
            return 1;
        }
    }




    public function activate($slug){
        return $this->user_service->activate($slug);
    }





    public function deactivate($slug){
        return $this->user_service->deactivate($slug);  
    }




    public function logout($slug){

        return $this->user_service->logout($slug);
        
    }




    public function resetPassword($slug){

        return $this->user_service->resetPassword($slug);
        
    }




    public function resetPasswordPost(UserResetPasswordRequest $request, $slug){

        return $this->user_service->resetPasswordPost($request, $slug);
        
    }




    public function syncEmployee($slug){

        return $this->user_service->syncEmployee($slug);
        
    }




    public function syncEmployeePost(UserSyncEmployeeRequest $request, $slug){

        return $this->user_service->syncEmployeePost($request, $slug);
        
    }




    public function unsyncEmployee($slug){

        return $this->user_service->unsyncEmployee($slug);
        
    }




}
