<?php

namespace App\Http\Requests\Consignee;

use Illuminate\Foundation\Http\FormRequest;

class ConsigneeFormRequest extends FormRequest{




    public function authorize(){

        return true;

    }




    public function rules(){

        $rules = [
            'consignee_id'=>'required',
            'consignee_name'=>'required|string|',
            'consignee_address'=>'required|string|',
            'consignee_tin'=>'required|',


        ];


        return $rules;

    }







}
