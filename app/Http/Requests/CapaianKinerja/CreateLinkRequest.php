<?php

namespace App\Http\Requests\CapaianKinerja;

use Illuminate\Foundation\Http\FormRequest;

class CreateLinkRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'title' => 'required',
            'url'=> 'required|url',
            'image' => 'required|max:500000',
            'description' => 'nullable',
            'type' => 'required'
        ];
    }
}
