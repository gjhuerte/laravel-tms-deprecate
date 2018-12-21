<?php

namespace App\Http\Requests\OrganizationRequest;

use Illuminate\Foundation\Http\FormRequest;

class OrganizationUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|min:1|unique:' . $this->table . ',name,' . $this->name . ',name',
            'abbreviation' => 'required|min:1',
            'parent_id' => 'nullable|exists:' . $this->table . ',id',
        ];
    }
}
