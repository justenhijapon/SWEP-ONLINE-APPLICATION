<?php

namespace App\Http\Requests\BlockFarm;

use Illuminate\Foundation\Http\FormRequest;

class BlockFarmFormRequest extends FormRequest{


    public function authorize(){

        return true;
    
    }



    public function rules(){

        $rules =  [
            
            // 'doc_file' => 'nullable|mimes:pdf|max:50000',
            'date' => 'required|date_format:"m/d/Y"',
            'mill_district' => 'required|string|max:255',
//            'fund_source' => 'required|string|max:255',
            'block_farm_name' => 'required|string|max:255',
//            'enrolee_name' => 'required|string|max:255',
//            'address' => 'required|string|max:255',
//            'educ_att' => 'required|string|max:32',
//            'sex' => 'required|string|max:6',
//            'age' => 'required|int|max:130',
//            'civil_status' => 'required|string|max:20',
//            'religion' => 'required|string|max:30',
//            'occupation' => 'required|string|max:30',
//            'annual_income' => 'required|numeric|max:1000000',
//            'annual_expense' => 'required|numeric|max:1000000',
//            'years_sugarcane_farming' => 'required|int|max:130',
//            'male_family' => 'required|int|max:50',
//            'female_family' => 'required|int|max:50',
//            'plant_total_area' => 'nullable|numeric|max:100000',
//            'plant_lkg_tc' => 'nullable|numeric|max:100000',
//            'plant_tc_ha' => 'nullable|numeric|max:100000',
//            'plant_lkg_ha' => 'nullable|numeric|max:100000',
//            'ratoon_total_area' => 'nullable|numeric|max:100000',
//            'ratoon_lkg_tc' => 'nullable|numeric|max:100000',
//            'ratoon_tc_ha' => 'nullable|numeric|max:100000',
//            'ratoon_lkg_ha' => 'nullable|numeric|max:100000',
//            'specify_problem' => 'nullable|string|max:500',

        ];


        // if(!empty($this->request->get('row'))){
        //     foreach($this->request->get('row') as $key => $value){
        //         $rules['row.'.$key.'.spkr_fullname'] = 'required|string|max:255';
        //         $rules['row.'.$key.'.spkr_topic'] = 'nullable|string|max:255';
        //     } 
        // }

        return $rules;
    
    }


    protected function prepareForValidation()
    {

        function rawCurrency($value){
            $value = str_replace(',', '', $value);
            $value = str_replace('₱', '', $value);
            return $value;
        }

        $this->merge([
            'annual_income' => rawCurrency($this->annual_income),
            'annual_expense' => rawCurrency($this->annual_expense),
        ]);        
    }

    



}
