<?php


namespace App\Core\Repositories;


use App\Core\BaseClasses\BaseRepository;

use App\Models\Projects;

class ProjectsRepository extends BaseRepository
{
    protected $projects;

    public function __construct(Projects $projects)
    {
        $this->projects = $projects;
        parent::__construct();
    }

    public function fetchTable($data){
        return Projects::with(['seminars','otherActivities']);
    }

    public function store($request){
        $project = New Projects;
        $project->slug = $this->str->random(16);

        foreach ($request->except('_token') as $key => $val) {
            $project->$key = $val;
        }

        if($project->save()){
            return $project->only(['slug']);
        }
    }

    public function findBySlug($id){
        return $this->projects->where('slug',$id)->first();
    }

    public function update($request,$id){
        $project = $this->findBySlug($id);
        foreach ($request->except('_token') as $key => $val) {
            $project->$key = $val;
        }

        if($project->update()){
            return $project->only(['slug']);
        }
    }

    public function getRaw(){
        return $this->projects;
    }
}