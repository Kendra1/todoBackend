<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class RegistrationValidator extends FormRequest
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
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'password_confirmation' => 'required|string|min:8',
            'company' => 'required|string|max:255',
        ];
    }
    

    // public function response( array $errors ) {
        
    //     info($errors);

    //     if($errors){
    //         throw new HttpResponseException(response()->json(errors(), 422)); 
    //     }
       

    // }

    protected function failedValidation(Validator $validator) {
        
         throw new HttpResponseException(response()->json($validator->errors(), 422));
    }
}
