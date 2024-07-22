<?php

namespace App\Http\Requests\Official_reciepts;

use Illuminate\Foundation\Http\FormRequest;

class OfficialRecieptsFormRequest extends FormRequest{




    public function authorize(){

        return true;

    }




    public function rules(){

        $rules = [
            'or_no' => 'required|integer|max:9999999',
            'or_date' => 'required|date_format:"Y-m-d"',
        ];


        return $rules;

    }







}
