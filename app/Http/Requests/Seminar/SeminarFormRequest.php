<?php

namespace App\Http\Requests\Seminar;

use Illuminate\Foundation\Http\FormRequest;

class SeminarFormRequest extends FormRequest{


    public function authorize(){

        return true;
    
    }



    public function rules(){

        $rules =  [
            
            'doc_file' => 'nullable|mimes:pdf|max:50000',
            'title' => 'required|string|max:255',
            'sponsor' => 'nullable|string|max:255',
            'venue' => 'required|string|max:255',
            'mill_district' => 'required|string|max:255',
            'date_covered_from' => 'required|date_format:"Y-m-d"',
            'date_covered_to' => 'required|date_format:"Y-m-d"',
//            'project_code' => 'required|string|max:45|exists:projects,project_code',
//            'utilized_fund' => 'required|string|max:45',

        ];


        if(!empty($this->request->get('row'))){
            foreach($this->request->get('row') as $key => $value){
                $rules['row.'.$key.'.spkr_fullname'] = 'required|string|max:255';
                $rules['row.'.$key.'.spkr_topic'] = 'nullable|string|max:255';
            } 
        }

        return $rules;
    
    }


}
