<?php

namespace App\Http\Requests\LevelRequest;

use Illuminate\Foundation\Http\FormRequest;

class LevelUpdateRequest extends FormRequest
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
        $name = Level::findOrFail($this->level);
        
        return [
            'name' => 'required|string|max:100|unique:levels,name,' . $level->name . ',name',
            'details' => 'nullable|string|max:256',
        ];
    }
}
