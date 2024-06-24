<?php

namespace App\Http\Requests\Shipping_Permit;

use Illuminate\Foundation\Http\FormRequest;

class ShippingPermitFormRequest extends FormRequest{




    public function authorize(){

        return true;

    }




    public function rules(){

        $rules = [
            'sp_no' => 'required|integer|max:9999999',
            'sp_edd_etd' => 'required|date_format:"Y-m-d"',
            'sp_date' => 'required|date_format:"Y-m-d"',
            'sp_eda_eta' => 'required|date_format:"Y-m-d"',
            'sp_port_of_origin' => 'required|string|max:255',
//            'sp_mill' => 'required|string|max:255',
            'sp_port_of_destination' => 'required|string|max:255',
            'sp_sugar_class' => 'required|string|max:255',
            'sp_vessel' => 'required|string|max:255',
            'sp_volume' => 'required|integer',
            'sp_ship_operator' => 'required|string|max:255',
//            'sp_uom' => 'required|string|max:255',
            'sp_freight' => 'required|string|max:255',
            'sp_plate_no' => 'required|string|max:255',
            'sp_or_no' => 'required|integer',
//            'sp_remarks' => 'required|string|max:255',
//            'sp_amount' => 'required|decimal',
//            'sp_ref_sp_no' => 'required|integer',
            'sp_status' => 'required|string|max:255',
//            'sp_markings' => 'required|string|max:255',
            'sp_collecting_officer'=> 'required|string|max:255',
            'sp_collecting_officer_position' => 'required|string|max:255',
            'sp_shipper' => 'required|string|max:255',
            'sp_shipper_add' => 'required|string|max:255',
            'sp_shipper_tin' => 'required|integer',
            'sp_consignee' => 'required|string|max:255',
            'sp_consignee_add' => 'required|string|max:255',
            'sp_consignee_tin' => 'required|integer',




        ];


        return $rules;

    }







}
