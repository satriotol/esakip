<?php

namespace App\Http\Requests\PengukuranKinerja;

use Illuminate\Foundation\Http\FormRequest;

class CreateIkuKotaRequest extends FormRequest
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
            'file' => 'required|file|max:500000',
        ];
    }
}
