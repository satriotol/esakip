<?php

namespace App\Http\Requests\PerencanaanKinerjaRkpd;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePerencanaanKinerjaRkpd extends FormRequest
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
            'name' => 'required',
            // 'file' => 'nullable|file|max:5000',
            'year' => 'required|digits:4|integer|min:1900|max:' . (date('Y') + 1),
        ];
    }
}
