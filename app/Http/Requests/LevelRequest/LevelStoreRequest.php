<?php

namespace App\Http\Requests\LevelRequest;

use Illuminate\Foundation\Http\FormRequest;

class LevelStoreRequest extends FormRequest
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
            'name' => 'required|string|max:100|unique:levels,name',
            'details' => 'nullable|string|max:256',
        ];
    }
}
