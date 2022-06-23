<?php

namespace App\Http\Requests\PengukuranKinerja;

use Illuminate\Foundation\Http\FormRequest;

class UpdateIkuKotaRequest extends FormRequest
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
            'file' => 'nullable|file|max:50000',
        ];
    }
}
