<?php


namespace App\Http\Requests\OfficeActivities;


use Illuminate\Foundation\Http\FormRequest;

class OfficeActivitiesFormRequest extends FormRequest
{
    public function authorize(){
        return true;
    }

    public function rules(){
        $rules = [
            'activity' => 'required|string|max:255',
            'venue' => 'required|string|max:255',
            'details' => 'nullable|string|max:1000',
            'project_code' => 'required|string|max:45|exists:projects,project_code',
            'utilized_fund' => 'required|string|max:20',
            'date' => 'required|date_format:"Y-m-d"',
        ];

        return $rules;
    }
}