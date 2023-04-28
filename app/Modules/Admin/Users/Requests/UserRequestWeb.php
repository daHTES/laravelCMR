<?php


namespace App\Modules\Admin\Users\Requests;


use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class UserRequestWeb extends FormRequest {

    public function authorize(){
        return Auth::user()->userPermissionSet(['Root_Admin', 'USERS_ACCESS']);
    }

    protected function getValidatorInstance(){

        $validator = parent::getValidatorInstance();

        $validator->sometimes('password', ['required'], function($input){
            if(!empty($input->password) || (empty($input->password) && ($this->route()->getName() != 'users.update'))) {
                return true;
            }
            return false;
        });
    return $validator;
    }

    public function rules()
    {
        return [
            'firstname'=>'required',
            'lastname'=>'required',
            'email'=>'required',
            'phone'=>'required',
            'role_id'=>'required',
        ];
    }

}
