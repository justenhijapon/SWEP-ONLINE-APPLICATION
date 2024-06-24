<?php

namespace App\Http\Requests\Trader;

use Illuminate\Foundation\Http\FormRequest;

class TraderFormRequest extends FormRequest{




    public function authorize(){

        return true;

    }




    public function rules(){

        $rules = [
            'trader_id'=>'required',
            'trader_name'=>'required|string|max:45',
            'trader_address'=>'required|string|max:45',
            'trader_tin'=>'required|integer',


        ];


        return $rules;

    }







}
