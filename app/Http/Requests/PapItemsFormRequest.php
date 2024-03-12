<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PapItemsFormRequest extends FormRequest
{
    public function authorize(){
        return true;
    }
    
    public function rules(){
        return [
           'item_no' => 'required|integer',
            'item' => 'required|string',
            'unit_cost' => 'required|string',
            'qty' => 'required|string',
            'uom' => 'required|string',
            'total_budget' => 'required|string',
            'mop' => 'required|string',

        ];
    }
}