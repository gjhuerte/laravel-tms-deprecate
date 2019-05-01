<?php

namespace App\Http\Requests\UserRequest;

use Illuminate\Foundation\Http\FormRequest;

class UserUpdateRequest extends FormRequest
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
            'lastname' => 'required|max:30',
            'username' => 'required|max:30',
            'firstname' => 'required|max:30',
            'middlename' => 'nullable|max:30',
            'mobile' => 'nullable|max:30',
            'email' => 'required|email',
            'organization_id' => 'nullable|exists:organizations,id',
        ];
    }
}
