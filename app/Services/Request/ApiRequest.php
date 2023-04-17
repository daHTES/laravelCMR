<?php


namespace App\Services\Request;


use App\Services\Response\ResponseServices;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\ValidationException;

class ApiRequest extends FormRequest {

    /**
     * Handle a failed validation attempt.
     *
     * @param  \Illuminate\Contracts\Validation\Validator  $validator
     * @return void
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    protected function failedValidation(Validator $validator) {

        $errors = (new ValidationException($validator))->errors();

        throw new HttpResponseException(
                ResponseServices::sendJSONResponse(
                    false,
                    JsonResponse::HTTP_FORBIDDEN,
                    $errors
                )
        );
    }

}
