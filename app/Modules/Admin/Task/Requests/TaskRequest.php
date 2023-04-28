<?php

namespace App\Modules\Admin\Task\Requests;

use App\Services\Request\ApiRequest;
use Illuminate\Foundation\Http\FormRequest;

class TaskRequest extends ApiRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'text'=>'string|required',
            'responsible_id'=>'required',
        ];
    }
}
