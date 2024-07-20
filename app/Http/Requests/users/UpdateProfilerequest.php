<?php

namespace App\Http\Requests\users;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProfilerequest extends FormRequest
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
            'first_name' => "required",
            'last_name' => "required",
            'email' => 'required',
            'address' => "required",
            'phone_no' => "required",
            'web_address' => 'required',
            'national_id' => "required",
            'profile_picture' => "required",
            'gender' => 'required',
        ];
    }
}
