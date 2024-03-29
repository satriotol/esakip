<?php

namespace App\Http\Requests\Rpjmd;

use Illuminate\Foundation\Http\FormRequest;

class CreateRpjmdRequest extends FormRequest
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
            // 'file' => 'required|max:500000',
            'year' => 'required',
            'name' => 'required',
        ];
    }
}
