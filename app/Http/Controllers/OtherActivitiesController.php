<?php


namespace App\Http\Controllers;


use App\Core\Repositories\OtherActivitiesRepository;
use App\Core\Services\OtherActivitiesService;
use App\Http\Requests\OtherActivities\OtherActivitiesFormRequest;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use function foo\func;

class OtherActivitiesController extends Controller
{
    protected $other_activities_service;
    protected $other_activities_repo;
    public  function __construct(OtherActivitiesService $other_activities_service,OtherActivitiesRepository $other_activities_repo)
    {
        $this->other_activities_service = $other_activities_service;
        $this->other_activities_repo = $other_activities_repo;
    }

    public function index(){
        if(request()->ajax()){
            $data = request();
            return DataTables::of($this->other_activities_repo->fetchTable($data))
                ->addColumn('action',function($data){
                    $button = '<div class="btn-group">';

                    if($data->has_participants == 1){
                        $button = $button.'<button type="button" class="btn btn-default btn-sm participants_btn" data="'.$data->slug.'" data-toggle="modal" data-target ="#participants_modal" title="Participants" data-placement="left">
                                    <i class="fa fa-users"></i>
                                </button>';
                    }

                    $button = $button.'<button type="button" class="btn btn-default btn-sm show_other_btn" data="'.$data->slug.'" data-toggle="modal" data-target ="#show_scholars_modal" title="View more" data-placement="left">
                                    <i class="fa fa-file-text"></i>
                                </button>
                                <button type="button" data="'.$data->slug.'" class="btn btn-default btn-sm edit_other_btn" data-toggle="modal" data-target="#edit_other_modal" title="Edit" data-placement="top">
                                    <i class="fa fa-edit"></i>
                                </button>
                                <button type="button" data="'.$data->slug.'" class="btn btn-sm btn-danger delete_other_btn" data-toggle="tooltip" title="Delete" data-placement="top">
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
                ->make(true);
        }

        return view('dashboard.other_activities.index');
    }

    public function store(OtherActivitiesFormRequest $request){
        return $this->other_activities_service->store($request);
    }

    public function edit($id){
        $other_activity = $this->other_activities_repo->findBySlug($id);
        return view('dashboard.other_activities.edit')->with(['other_activity'=>$other_activity]);
    }

    public function update(OtherActivitiesFormRequest $request,$id){
        return $this->other_activities_service->update($request,$id);
    }

    public function destroy($id){
        return $this->other_activities_repo->destroy($id);
    }
}