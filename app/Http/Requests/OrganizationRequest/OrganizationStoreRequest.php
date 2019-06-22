<?php

namespace App\Http\Requests\OrganizationRequest;

use Illuminate\Foundation\Http\FormRequest;

class OrganizationStoreRequest extends FormRequest
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
            'name' => "required|bail|min:1|max:250|string|unique:organizations,name",
            'abbreviation' => "required|bail|min:1|max:50|string|unique:organizations,abbreviation",
            'parent_id' => "nullable|bail|integer|exists:organizations,id",
        ];
    }
}
