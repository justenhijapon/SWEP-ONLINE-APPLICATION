<?php

namespace App\Http\Controllers;

use App\Core\Helpers\Arrays;
use App\Core\Helpers\Helpers;
use App\Models\ActivityLogs;
use App\Models\Menu;
use App\Models\Submenu;
use App\Models\User;
use App\Models\UserSubmenu;
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
            ->addColumn('user_access', function($data){
                if($data->user_access == 'super_user'){
                    return '<span class="label bg-yellow col-md-12">SUPER USER</span>';
                }else if($data->user_access == 'admin'){
                    return '<span class="label bg-blue col-md-12">ADMIN</span>';
                }else if($data->user_access == 'user'){
                    return '<span class="label bg-gray col-md-12">USER</span>';
                }
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

        return
            view('dashboard.user.index')->with(['menus'=>$menus]);

    }

    


    public function create(){

        return view('dashboard.user.create');
    }


    public function submenuIdsByAccess($accessLevel) {
        $submenuIdsByAccess = [
            'super_user' => [
                /**User**/
                'SM10000002','SM10000003', 'SM10000004', 'SM10000005', 'SM10000006', 'SM10000007', 'SM10000008', 'SM10000009', 'SM10000010', 'SM10000011', 'SM10000012', 'SM10000102','K04E9hEHWz',

                /**Menu**/
                'SM10000152', 'SM10000153', 'SM10000154', 'SM10000155', 'SM10000156', 'SM10000184', 'SM10000185', 'SM10000186', 'SM10000187', 'SM10000188', 'SM10000190', 'SM10000193',

                /**Submenu**/
                'SM10000186', 'SM10000187', 'SM10000188', 'SM10000190', 'SM10000193',

                /**Port**/
                '8hnH1fC2krs', 'X8w0sPHBoRP', 'Ns67fqYteWf', '4sIKUOHKoN9', 'a1DApPdiaFt', 'OyPAeSODnw', 'vPMCMZzzCI', 'ftHrFiYAVA', 'U0pcz0VpLs',

                /**Mills**/
                'OtfNQHIKVj', 'xDSqa8usVB', 'aLbdr29RoC', 'WADw1e6sNX', 'l2dDCxPiSo',

                /**Trader**/
                'gbWmfSnzLKR', 'tjfiFO1M7Yw', '0E0QTLm23Cs', '5fwCoeI1wkZ', 'GKlEZyoSriM',

                /**Consignee**/
                'gbWmfSnzLKb', 'tjfiFO1M7Yd', '0E0QTLm23Cf', '5fwCoeI1wkh', 'GKlEZyoSrij',

                /**Vessel**/
                'gPCrnd3HxM', 'fHgIyxMDkq', 'jjIOBiqpO4', 'whQCgI3FX0', 'GqGHRm5qlr',

                /**Sugar Liens**/
                'DmlxY7LOnX', '9AEhq8vJmT', '1vTts47iBh', 'QD9f2t91Cp', 'Ayy8O0jNrA',

                /**Profile**/
                'SM10000101','SM10000102','SM10000103','SM10000104','SM10000206',

                /**Shipping Permit**/
                'gbWmfSnzLcb', 'tjfiFO1M7ed', '0E0QTLm23gf', '5fwCoeI1wih',
                'GKlEZyoSrkj', 'c4mhfJNF8u', 'OyPAeSODnw', 'wEzWgB7wwN', 'U0pcz0VpLs',

                /**official receipts**/
                'aE9MYeK0iD', '6UJjGRkhD9', 'BaLBlpqjKW', 'osIF8P1IYv', 'yBbuPbRi8X',
                'dA0fili6Gy', 'vPMCMZzzCI', 'ftHrFiYAVA',
            ],
            'admin' => [
                /**Port**/
                '8hnH1fC2krs', 'X8w0sPHBoRP', 'Ns67fqYteWf', '4sIKUOHKoN9', 'a1DApPdiaFt', 'OyPAeSODnw', 'vPMCMZzzCI', 'ftHrFiYAVA', 'U0pcz0VpLs',

                /**Mills**/
                'OtfNQHIKVj', 'xDSqa8usVB', 'aLbdr29RoC', 'WADw1e6sNX', 'l2dDCxPiSo',

                /**Trader**/
                'gbWmfSnzLKR', 'tjfiFO1M7Yw', '0E0QTLm23Cs', '5fwCoeI1wkZ', 'GKlEZyoSriM',

                /**Consignee**/
                'gbWmfSnzLKb', 'tjfiFO1M7Yd', '0E0QTLm23Cf', '5fwCoeI1wkh', 'GKlEZyoSrij',

                /**Vessel**/
                'gPCrnd3HxM', 'fHgIyxMDkq', 'jjIOBiqpO4', 'whQCgI3FX0', 'GqGHRm5qlr',

                /**Sugar Liens**/
                'DmlxY7LOnX', '9AEhq8vJmT', '1vTts47iBh', 'QD9f2t91Cp', 'Ayy8O0jNrA',

                /**Profile**/
                'SM10000101','SM10000102','SM10000103','SM10000104','SM10000206',

                /**Shipping Permit**/
                'gbWmfSnzLcb', 'tjfiFO1M7ed', '0E0QTLm23gf', '5fwCoeI1wih',
                'GKlEZyoSrkj', 'c4mhfJNF8u', 'OyPAeSODnw', 'wEzWgB7wwN', 'U0pcz0VpLs',

                /**official receipts**/
                'aE9MYeK0iD', '6UJjGRkhD9', 'BaLBlpqjKW', 'osIF8P1IYv', 'yBbuPbRi8X',
                'dA0fili6Gy', 'vPMCMZzzCI', 'ftHrFiYAVA',
            ],
            'user' => [
                /**Profile**/
                'SM10000101','SM10000102','SM10000103','SM10000104','SM10000206',

                /**Shipping Permit**/
                'gbWmfSnzLcb', 'tjfiFO1M7ed', '0E0QTLm23gf', '5fwCoeI1wih',
                'GKlEZyoSrkj', 'c4mhfJNF8u', 'OyPAeSODnw', 'wEzWgB7wwN', 'U0pcz0VpLs',

                /**official receipts**/
                'aE9MYeK0iD', '6UJjGRkhD9', 'BaLBlpqjKW', 'osIF8P1IYv', 'yBbuPbRi8X',
                'dA0fili6Gy', 'vPMCMZzzCI', 'ftHrFiYAVA',
            ],
        ];

        return $submenuIdsByAccess[$accessLevel] ?? [];
    }

    public function store(UserFormRequest $request) {
        // Create a new User instance and populate it with data from the request
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
        $user->user_access = $request->user_access;
        $user->created_at = Carbon::now();
        $user->updated_at = Carbon::now();
        $user->ip_created = request()->ip();
        $user->ip_updated = request()->ip();

        // Save the user to the database
        if ($user->save()) {
            // Initialize an empty array to hold UserSubmenu records
            $usersubmenuArray = [];

            // Get the submenu IDs for the user's access level
            $submenuIds = $this->submenuIdsByAccess($request->user_access);

            // Populate the $usersubmenuArray with individual submenu entries
            foreach ($submenuIds as $submenuId) {
                $usersubmenuArray[] = [
                    'user_id' => $user->user_id,
                    'submenu_id' => $submenuId,
                    'is_nav' => 0,
                ];
            }

            // Insert the UserSubmenu records into the database
            UserSubmenu::insert($usersubmenuArray);

            // Return the slug of the newly created user
            return $user->only('slug');
        }

        // Handle the case where the user could not be saved
        return response()->json(['error' => 'User could not be created'], 500);
    }






    public function show($slug){
        // Fetch the user with the given slug
        $user = User::where('slug', $slug)->firstOrFail();

        // Get the user_id from the fetched user
        $user_id = $user->user_id;

        // Fetch userSubmenus associated with the user_id
        $userSubmenus = UserSubmenu::where('user_id', $user_id)->with('subMenu')->get();

        // Pass the fetched data to the user_service's show method
        return $this->user_service->show($slug)->with([
            'userSubmenus' => $userSubmenus
        ]);
    }

    public function activity($slug){
        // Fetch the user with the given slug
        $user = User::where('slug', $slug)->firstOrFail();

        // Get the user_id from the fetched user
        $user_id = $user->user_id;

        // Fetch userSubmenus associated with the user_id
        $userActivity = ActivityLogs::where('user_id', $user_id)->get();

        // Pass the fetched data to the user_service's show method
        return view('dashboard.user.activity')->with([
            'userActivity' => $userActivity,
            'user' => $user
        ]);
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
