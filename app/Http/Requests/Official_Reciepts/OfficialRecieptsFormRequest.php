<?php

namespace App\Http\Requests\Official_reciepts;

use Illuminate\Foundation\Http\FormRequest;

class OfficialRecieptsFormRequest extends FormRequest{




    public function authorize(){

        return true;

    }




    public function rules(){

        $rules = [
            'or_no' => 'required|integer',
            'or_date' => 'required|date_format:"Y-m-d"',
            'or_mill' => 'required|string',
            'or_payor' => 'required|string',
            'or_date' => 'required|string',
        ];


        return $rules;

    }







}
