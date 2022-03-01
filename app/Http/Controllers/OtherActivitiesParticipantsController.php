<?php


namespace App\Http\Controllers;


use App\Http\Requests\OtherActivities\OtherActivitiesParticipantsFormRequest;
use App\Models\OtherActivities;
use App\Models\OtherActivitiesParticipants;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Yajra\DataTables\DataTables;

class OtherActivitiesParticipantsController extends Controller
{
    public function index(){
        if(request()->has('draw')){
            $oa_participants = OtherActivitiesParticipants::query()->where('other_activity','=',request('activity'));
            return DataTables::of($oa_participants)
                ->addColumn('action',function ($data){
                    $button = '<div class="btn-group">';
                    $destroy_route = "'".route("dashboard.other_activities_participants.destroy","slug")."'";
                    $slug = "'".$data->slug."'";

                    $button = $button.'
                                <button type="button" data="'.$data->slug.'" class="btn btn-default btn-sm edit_oap_btn" data-toggle="modal" data-target="#edit_oap_modal" title="Edit" data-placement="top">
                                    <i class="fa fa-edit"></i>
                                </button>
                                <button type="button" data="'.$data->slug.'" class="btn btn-sm btn-danger" onclick="delete_data('.$slug.','.$destroy_route.')" data-toggle="tooltip" title="Delete" data-placement="top">
                                    <i class="fa fa-trash"></i>
                                </button>
                            </div>';
                    return $button;
                })
                ->addColumn('fullname', function ($data){
                    return $data->lastname.', '.$data->firstname.' '.$data->middlename;
                })
                ->escapeColumns([])
                ->setRowId('slug')
                ->make(true);
        }
        if(!request()->has('other_activity') || request('other_activity') == null){
            abort(503,'Missing Parameters');
        }
        $oa = OtherActivities::query()->where('slug','=',request('other_activity'))->first();
        if(empty($oa)){
            abort(503,'Activity not found');
        }

        return view('dashboard.other_activities_participants.index')->with([
            'oa' => $oa,
        ]);
    }

    public function store(OtherActivitiesParticipantsFormRequest $request){
        $oa_participant = new OtherActivitiesParticipants;
        $oa_participant->slug = Str::random(16);
        $oa_participant->other_activity = $request->other_activity;
        $oa_participant->lastname = ucfirst($request->lastname);
        $oa_participant->middlename = ucfirst($request->middlename);
        $oa_participant->firstname = ucwords($request->firstname);
        $oa_participant->age = $request->age;
        $oa_participant->sex = $request->sex;
        $oa_participant->group = $request->group;
        $oa_participant->ip_created = $request->ip();

        if($oa_participant->save()){
            return $oa_participant->only('slug');
        }
        abort(503, 'Error saving data.');
    }

    private function findBySlug($slug){
        $oa_participant = OtherActivitiesParticipants::query()->where('slug','=',$slug)->first();
        if(empty($oa_participant)){
            abort(503,'Participant not found.');
        }
        return $oa_participant;
    }

    public function edit($slug){
        $oap = $this->findBySlug($slug);
        return view('dashboard.other_activities_participants.edit')->with([
            'oap' => $oap,
        ]);
    }
    public function update(OtherActivitiesParticipantsFormRequest $request,$slug){
        $oa_participant = $this->findBySlug($slug);
        $oa_participant->lastname = ucfirst($request->lastname);
        $oa_participant->middlename = ucfirst($request->middlename);
        $oa_participant->firstname = ucwords($request->firstname);
        $oa_participant->age = $request->age;
        $oa_participant->sex = $request->sex;
        $oa_participant->group = $request->group;
        if($oa_participant->update()){
            return $oa_participant->only('slug');
        }

        abort(503,'Error saving data.');
    }

    public function destroy($slug){
        $oa_participant = $this->findBySlug($slug);
        if($oa_participant->delete()){
            return 1;
        }
        abort(503,'Error deleting data.');
    }
}