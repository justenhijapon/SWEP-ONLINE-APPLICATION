<?php


namespace App\Http\Controllers;


use App\Core\Repositories\ProjectsRepository;
use App\Core\Services\ProjectsService;
use App\Http\Controllers\Controller;
use App\Http\Requests\Projects\ProjectFormRequest;
use Illuminate\Http\Request;
use Yajra\DataTables\Html\Builder;
use function foo\func;

class ProjectsController extends Controller
{
    protected $project_service;
    protected $project_repo;
    public function  __construct(ProjectsService $project_service, ProjectsRepository $project_repo)
    {
        $this->project_service = $project_service;
        $this->project_repo = $project_repo;
    }

    public function index(){
        if(request()->ajax()){
            $data = request();

            return datatables()->of($this->project_repo->fetchTable($data))
                ->editColumn('budget',function($data){
                    return number_format($data->budget,2);
                })
                ->addColumn('balance', function ($data){
                    $allocation = $data->budget;
                    $utilized = $data->seminars->sum('utilized_fund')+$data->OtherActivities->sum('utilized_fund');
                    $data->utilized = $utilized;
                    return number_format($allocation-$utilized,2);
                })
                ->addColumn('percentage',function($data){
                    $allocation = $data->budget;
                    $percentage = ($data->utilized/$allocation*100);
                    return number_format($percentage,2).'%';
                })
                ->addColumn('action', function($data){
                    $button = '<div class="btn-group">
                                <button type="button" class="btn btn-default btn-sm show_project_btn" data="'.$data->slug.'" data-toggle="modal" data-target ="#show_project_modal" title="View more" data-placement="left">
                                    <i class="fa fa-file-text"></i>
                                </button>
                                <button type="button" data="'.$data->slug.'" class="btn btn-default btn-sm edit_project_btn" data-toggle="modal" data-target="#edit_project_modal" title="Edit" data-placement="top">
                                    <i class="fa fa-edit"></i>
                                </button>
                                <button type="button" data="'.$data->slug.'" class="btn btn-sm btn-danger delete_project_btn" data-toggle="tooltip" title="Delete" data-placement="top">
                                    <i class="fa fa-trash"></i>
                                </button>
                            </div>';
                    return $button;
                })
                ->escapeColumns([])
                ->setRowId('slug')
                ->setRowAttr([
                    'is_excess' => function($data) {
                        if($data->utilized > $data->budget){
                            return 1;
                        }else{
                            return 0;
                        }
                    },
                ])
                ->make(true);
        }
        return view('dashboard.projects.index');
    }

    public function store(ProjectFormRequest $request){
        return $this->project_service->store($request);
    }

    public function edit($id){
        $project = $this->project_repo->findBySlug($id);
        return  view('dashboard.projects.edit')->with(['project'=>$project]);
    }

    public function update(ProjectFormRequest $request,$id){
        return $this->project_service->update($request,$id);
    }
}