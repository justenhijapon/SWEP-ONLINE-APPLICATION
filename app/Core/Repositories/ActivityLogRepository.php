<?php

namespace App\Core\Repositories;
 
use App\Core\BaseClasses\BaseRepository;
use App\Core\Interfaces\ActivityLogInterface;

use App\Models\ActivityLogs;


class ActivityLogRepository extends BaseRepository implements ActivityLogInterface {
	


    protected $activity_log;

	public function __construct(ActivityLogs $activity_log){
        $this->activity_log = $activity_log;
        parent::__construct();
    }

    public function modules(){
        $modules = [
            'Seminars'=>'seminar',
            'Block Farm'=>'block_farm',
            'Scholars'=>'scholar',
            'Committee Members' => 'committee_members'
        ];
        return $modules;
    }   

    public function events(){
        $events = [
            'Add'=>'store',
            'Edit'=>'update',
            'Delete'=>'destroy'
        ];
        return $events;
    }

    public function fetchTableUser($data){

        $user = $this->auth->user()->user_id;
        $get = $this->activity_log;

        $modules = $this->modules();
        $events = $this->events();

        foreach ($modules as $key => $module) {
            if(!empty($data->mod)){
                if ($module == $data->mod) {
                    $get = $get->where("module","=",$module);
                }
            }
        }

        foreach ($events as $key => $event) {
            if(!empty($data->event)){
                if($event == $data->event){
                    $get = $get->where("event","=",$event);
                }
            }
        }

        if(!empty($data->start_date) && !empty($data->end_date)){
            $from = $data->start_date;
            $to = $data->end_date;
            if($to != '' && $from != ''){
                $get = $get->whereBetween('created_at',[$from, $to]);
            }
        }

        return $get->where('user_id',"=",$user);
    }




    public function fetch($request){


    }





    public function store($request){
        $activity_log = new ActivityLogs;
        $activity_log->module = $request->module;
        $activity_log->event = $request->event;
        $activity_log->slug = $request->slug;
        $activity_log->user_id = $this->auth->user()->user_id;
        $activity_log->created_at = $this->carbon->now();

        switch ($request->event) {
            case 'update':    
                $remarks = 'Changes: [ ';

                $is_changed = 0;
                foreach ($request->obj->getChanges() as $key => $value) {
                    if($key != 'updated_at' && $key != 'user_updated'){
                        $remarks = $remarks. " ".$request->original[$key] ." -> ". $value." ,";

                        $is_changed = 1;
                    }
                }
                
                $remarks = substr_replace($remarks ,"", -1);
                $remarks = $remarks." ]";

                if($is_changed == 0){
                    $remarks = '';
                }

                $activity_log->remarks  = $remarks;
                $activity_log->save();
                break;

            case 'store':
                $activity_log->remarks = $request->remarks;
                $activity_log->save();
                break;

            case 'destroy':
                $activity_log->remarks = $request->remarks;
                $activity_log->save();
                break;

            default:
                # code...
                break;
        }

        //return $activity_log;
    }





    public function update($request, $seminar){


    }





    public function destroy($slug){

    }



    public function findBySlug($slug){

        $seminar = $this->seminar->where('slug', $slug)->first();
        
        if(empty($seminar)){ abort(404); }

        return $seminar;

    }







}