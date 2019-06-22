<?php

namespace App\Http\Requests\TicketRequest\TagRequest;

use App\Models\Ticket\Tag;
use Illuminate\Foundation\Http\FormRequest;

class TagUpdateRequest extends FormRequest
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
        $tag = Tag::findOrFail($this->tag);

        return [
            'name' => "required|max:100|string|unique:tags,name,{$tag->name},name",
            'description' => 'nullable|string|max:256',
        ];
    }
}
