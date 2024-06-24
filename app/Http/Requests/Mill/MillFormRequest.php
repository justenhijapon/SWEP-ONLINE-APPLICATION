<?php

namespace App\Http\Requests\mill;

use Illuminate\Foundation\Http\FormRequest;

class MillFormRequest extends FormRequest{




    public function authorize(){

        return true;

    }




    public function rules(){

        $rules = [
            'mill_code' => 'required|string',
            'mill_name' => 'required|string',
            'mill_address' => 'required|string'




        ];


        return $rules;

    }







}
