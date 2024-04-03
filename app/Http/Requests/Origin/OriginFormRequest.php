<?php

namespace App\Http\Requests\Origin;

use Illuminate\Foundation\Http\FormRequest;

class OriginFormRequest extends FormRequest{




    public function authorize(){

        return true;

    }




    public function rules(){

        $rules = [

            'origin'=>'required|string|max:45',
            'source'=>'required|string|max:45',
            'name'=>'required|string|max:45',


        ];


        return $rules;

    }







}
