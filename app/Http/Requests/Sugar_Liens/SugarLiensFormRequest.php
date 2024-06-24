<?php

namespace App\Http\Requests\Sugar_Liens;

use Illuminate\Foundation\Http\FormRequest;

class SugarLiensFormRequest extends FormRequest{




    public function authorize(){

        return true;

    }




    public function rules(){

        $rules = [
            'sl_description' => 'required|string',
            'sl_factor' => 'required|int'




        ];


        return $rules;

    }







}
