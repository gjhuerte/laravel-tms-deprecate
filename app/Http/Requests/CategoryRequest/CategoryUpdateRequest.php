<?php

namespace App\Http\Requests\CategoryRequest;

use Illuminate\Foundation\Http\FormRequest;

class CategoryUpdateRequest extends FormRequest
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
        $category = Category::findOrFail($this->category);
        return [
            'name' => 'required|max:100|string|unique;categories,name,' . $category->name . ',name',
            'description' => 'nullable|string|max:256',
            'parent_category' => 'nullable|exists:categories,id',
        ];
    }

    public function validationData()
    {
        if (method_exists($this->route(), 'parameters')) {
            $this->request->add($this->route()->parameters('id'));
            $this->query->add($this->route()->parameters('id'));

            return array_merge($this->route()->parameters(), $this->all());
        }

        return $this->all();
    }
}
