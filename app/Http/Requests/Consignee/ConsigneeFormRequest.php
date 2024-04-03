<?php

namespace App\Http\Requests\Consignee;

use Illuminate\Foundation\Http\FormRequest;

class ConsigneeFormRequest extends FormRequest{




    public function authorize(){

        return true;

    }




    public function rules(){

        $rules = [

            'consignee_name'=>'required|string|max:45',
            'consignee_address'=>'required|string|max:45',
            'consignee_tin'=>'required|integer',


        ];


        return $rules;

    }







}
