<?php


namespace App\Http\Requests\Projects;


use Illuminate\Foundation\Http\FormRequest;

class ProjectFormRequest extends FormRequest
{
    public function authorize(){

        return true;

    }




    public function rules(){

        $rules = [


            'project_code' => 'required|string|max:45|unique:projects,project_code,'.$this->route('project').',slug',
            'budget' => 'required|string|max:45',
            'year' => 'required|string|max:60',
            'activity' => 'required|string|max:255',
        ];


        return $rules;

    }
}