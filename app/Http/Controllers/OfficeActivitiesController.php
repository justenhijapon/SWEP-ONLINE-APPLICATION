<?php

namespace App\Http\Controllers;


use App\Core\Helpers\GlobalHelpers;
use App\Core\Services\CommitteeMembersService;
//use App\Core\Services\MillDistrictService;
//use App\Http\Requests\CommitteeMembers\CommitteeMembersFormRequest;
use App\Http\Requests\OfficeActivities\OfficeActivitiesFormRequest;
use App\Models\OfficeActivities;
use Illuminate\Support\Str;
use Yajra\DataTables\DataTables;
use Yajra\DataTables\Html\Builder;
//use Illuminate\Http\Request;



class OfficeActivitiesController extends Controller{


    protected $committee_members;

    public function __construct(CommitteeMembersService $committee_members){

        $this->committee_members = $committee_members;
    
    }


    
    public function index(Builder $builder){
        $html = $builder->parameters([
            'rowGroup'=> [
                'dataSrc' => ['mill_district']
            ]
        ]);
        $request = request();


        if(request()->ajax()){
            if(request()->ajax()){
                $data = request();
                $office_activities = OfficeActivities::query();
                return DataTables::of($office_activities)
                    ->addColumn('action',function($data){
                        $button = '<div class="btn-group">';
                        $destroy_route = "'".route("dashboard.office_activities.destroy","slug")."'";
                        $slug = "'".$data->slug."'";

                        if($data->has_participants == 1){
                            $button = $button.'<button type="button" class="btn btn-default btn-sm participants_btn" data="'.$data->slug.'" data-toggle="modal" data-target ="#participants_modal" title="Participants" data-placement="left">
                                    <i class="fa fa-users"></i>
                                </button>';
                        }

                        $button = $button.'<button type="button" class="btn btn-default btn-sm show_other_btn" data="'.$data->slug.'" data-toggle="modal" data-target ="#show_scholars_modal" title="View more" data-placement="left">
                                    <i class="fa fa-file-text"></i>
                                </button>
                                <button type="button" data="'.$data->slug.'" class="btn btn-default btn-sm edit_office_act_btn" data-toggle="modal" data-target="#edit_other_modal" title="Edit" data-placement="top">
                                    <i class="fa fa-edit"></i>
                                </button>
                                <button type="button" data="'.$data->slug.'" class="btn btn-sm btn-danger" onclick="delete_data('.$slug.','.$destroy_route.')" data-toggle="tooltip" title="Delete" data-placement="top">
                                    <i class="fa fa-trash"></i>
                                </button>
                            </div>';
                        return $button;
                    })
                    ->editColumn('date',function($data){
                        return date('M. d, Y',strtotime($data->date));
                    })
                    ->editColumn('utilized_fund',function($data){
                        return number_format($data->utilized_fund,2);
                    })
                    ->escapeColumns([])
                    ->setRowId('slug')
                    ->toJson();
            }


            if(!empty($request->get('query'))){
                $query = $request->get('query');
                return $this->committee_members->fetchEmployees($query);
            }

            if(!empty($request->get('find_employee'))){
                $employee_slug = $request->get('find_employee');
                $committee_members = $this->committee_members->findEmployee($employee_slug);
                return $committee_members;
            }
        }


        
    

        
        $search = '';
        if(!empty(request()->get('search'))){
            $search = request()->get('search');
        }


        return view('dashboard.office_activities.index', compact('html'))->with([
                        'search' => $search
        ]);





    }

    public function store(OfficeActivitiesFormRequest $request){
        $oa = new OfficeActivities;
        $oa->slug = Str::random(16);
        $oa->activity = $request->activity;
        $oa->date = $request->date;
        $oa->project_code = $request->project_code;
        $oa->utilized_fund = GlobalHelpers::sanitize_autonum($request->utilized_fund);
        $oa->venue = $request->venue;
        $oa->details = $request->details;
        $oa->has_participants = $request->has_participants;

        if($oa->save()){
            return $oa->only('slug');
        }

        abort(503,'Error saving data.');
    }


    public function create(){
        

    }

    private function findBySlug($slug){
        $oa = OfficeActivities::query()->where('slug','=',$slug)->first();
        if(empty($oa)){
            abort(503,'Activity not found');
        }
        return $oa;
    }

    public function show($slug){
        $committee_member = $this->committee_members->show($slug);
        return view('dashboard.committee_members.show')->with([
            'committee_member' => $committee_member
        ]);
    }

    public function edit($slug){
        $oa = $this->findBySlug($slug);
        return view('dashboard.office_activities.edit')->with([
            'oa' => $oa,
        ]);
    }

    public function update(OfficeActivitiesFormRequest $request, $slug){

        $oa = $this->findBySlug($slug);
        $oa->activity = $request->activity;
        $oa->date = $request->date;
        $oa->project_code = $request->project_code;
        $oa->utilized_fund = GlobalHelpers::sanitize_autonum($request->utilized_fund);
        $oa->venue = $request->venue;
        $oa->details = $request->details;
        $oa->has_participants = $request->has_participants;

        if($oa->update()){
            return $oa->only('slug');
        }

        abort(503,'Error saving data.');
    }
    

    public function destroy($slug){
        $oa = $this->findBySlug($slug);
        if($oa->delete()){
            return 1;
        }
        abort( 503,'Error deleting data.');
    }


}
