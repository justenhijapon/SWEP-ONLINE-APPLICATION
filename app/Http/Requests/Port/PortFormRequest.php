<?php

namespace App\Http\Requests\Port;

use Illuminate\Foundation\Http\FormRequest;

class PortFormRequest extends FormRequest{




    public function authorize(){

        return true;

    }




    public function rules(){

        $rules = [

            'category'=>'required|string|max:45',
            'port_name'=>'required|string|max:45',


        ];


        return $rules;

    }







}
