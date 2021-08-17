<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Core\Services\UserService;
use App\Http\Requests\User\UserFormRequest;
use App\Http\Requests\User\UserFilterRequest;
use App\Http\Requests\User\UserResetPasswordRequest;
use App\Http\Requests\User\UserSyncEmployeeRequest;


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
                if($data->is_active == 0){
                    $a = "Activate";
                    $stat = "inactive";
                }else{
                    $a = "Deactivate";
                    $stat = "active";
                }
                $button = '<div class="btn-group">
                                <button type="button" class="btn btn-default btn-sm view_user_btn" data="'.$data->slug.'" data-toggle="modal" data-target ="#view_user_modal" title="View more" data-placement="left">
                                    <i class="fa fa-file-text"></i>
                                </button>
                               
                                <button type="button" data="'.$data->slug.'" class="btn btn-default btn-sm edit_user_btn" data-toggle="modal" data-target="#edit_user_modal" title="Edit" data-placement="top">
                                    <i class="fa fa-edit"></i>
                                </button>
                                <button type="button" data="'.$data->slug.'" class="btn btn-sm btn-danger delete_user_btn" data-toggle="tooltip" title="Delete" data-placement="top">
                                    <i class="fa fa-trash"></i>
                                </button>
                                <div class="btn-group">
                                  <button type="button" class="btn btn-primary btn-sm dropdown-toggle" data-toggle="dropdown">
                                  <span class="caret"></span></button>
                                  <ul class="dropdown-menu dropdown-menu-right" role="menu">
                                    <li><a href="#" data="'.$data->slug.'" name="'.strtoupper($data->firstname).' '.strtoupper($data->lastname).'" class="ac_dc" status="'.$stat.'" >'.$a.'</a>
                                    </li>
                                    <li><a href="#" class="reset_password_btn" data="'.$data->slug.'" data-toggle="modal" data-target="#reset_password_modal" >Change Username/Password</a></li>
                                  </ul>
                                </div>
                                </div>';
                return $button;
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
        return $request;
        $user = $this->user_service->store($request);

        return json_encode(array('result' => 1, 'slug' => $user->slug)) ;
        
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

        return $this->user_service->destroy($slug);
        
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
