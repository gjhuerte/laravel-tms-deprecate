<?php

namespace App\Http\Requests\OrganizationRequest;

use Illuminate\Foundation\Http\FormRequest;

class OrganizationStoreRequest extends FormRequest
{

    /**
     * Table name to be used for requesting
     *
     * @var string
     */
    private $table = 'organizations';

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
            'name' => "required|bail|min:1|max:250|string|unique:{$this->table},name",
            'abbreviation' => "required|bail|min:1|max:50|string|unique:{$this->table},abbreviation",
            'parent_id' => "nullable|bail|integer|exists:{$this->table},id",
        ];
    }
}
