<?php


namespace App\Http\Controllers;


use App\Core\Repositories\OtherActivitiesRepository;
use App\Core\Services\OtherActivitiesService;
use App\Http\Requests\OtherActivities\OtherActivitiesFormRequest;
use App\Models\OtherActivities;
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
                    return view('dashboard.other_activities.dtActions')->with([
                        'data' => $data,
                    ]);
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

    public function destroy($slug){

        $other_activities = OtherActivities::query()
            ->where('slug', $slug)
            ->first();
            $other_activities ?? abort(404,'Seminar not found.');
        if($other_activities->delete()){
            return 1;
        }
    }
}