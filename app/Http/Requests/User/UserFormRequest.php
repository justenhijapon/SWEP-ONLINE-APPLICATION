<?php

namespace App\Http\Requests\User;


use Illuminate\Foundation\Http\FormRequest;


class UserFormRequest extends FormRequest{



    public function authorize(){

        return true;
        
    }


    
    public function rules(){

        $rules = [
            
            'employee_sync'=>'nullable|string|max:45',
            'firstname'=>'required|string|max:90',
            'middlename'=>'required|string|max:90',
            'lastname'=>'required|string|max:90',
            'email'=>'required|string|email|max:90',
            'position'=>'required|string|max:90',
            'username'=>'sometimes|required|string|max:45|unique:users,username,'.$this->route('user').',slug',
            'password'=>'sometimes|required|string|min:6|max:45|confirmed|same:password_confirmation',
            'password_confirmation'=>'sometimes|required|string|min:6|max:45',
            'user_access' => 'required|string',
        ];

        // if(!empty($this->request->get('menu'))){

        //     if(!empty($this->request->get('menu'))){
        //         foreach($this->request->get('menu') as $key => $value){
        //             $rules['menu.'.$key] = 'required|string';
        //         } 
        //     }

        //     if(!empty($this->request->get('submenu'))){
        //         foreach($this->request->get('submenu') as $key => $value){
        //             $rules['submenu.'.$key] = '';
        //         }
        //     }

        // }

        return $rules;

    }





}
