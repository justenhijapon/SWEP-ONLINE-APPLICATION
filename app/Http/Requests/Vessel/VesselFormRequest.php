<?php

namespace App\Http\Requests\vessel;

use Illuminate\Foundation\Http\FormRequest;

class VesselFormRequest extends FormRequest{




    public function authorize(){

        return true;

    }




    public function rules(){

        $rules = [
            'vessel_id' => 'required|int',
            'vessel_description' => 'required|string',
            'vessel_ship_operator' => 'required|string'




        ];


        return $rules;

    }







}
