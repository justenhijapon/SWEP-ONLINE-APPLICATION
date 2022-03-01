<?php


namespace App\Http\Requests\OtherActivities;


use Illuminate\Foundation\Http\FormRequest;

class OtherActivitiesParticipantsFormRequest extends FormRequest
{
    public function authorize(){
            return true;
    }

    public function rules(){
        return [
            'lastname' => 'required|string|max:90',
            'firstname' => 'required|string|max:90',
            'middlename' => 'nullable|string|max:90',
            'age' => 'required|int|max:150',
            'sex' => 'required|string|max:10',
            'group' => 'nullable|string|max:20',
        ];
    }
}