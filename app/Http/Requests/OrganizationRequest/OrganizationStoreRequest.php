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
    		'name' => 'required|min:1|unique:' . $this->table . ',name',
            'abbreviation' => 'required|min:1',
            'parent_id' => 'nullable|exists:' . $this->table . ',id',
        ];
    }
}
