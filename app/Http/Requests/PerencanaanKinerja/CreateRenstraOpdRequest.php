<?php

namespace App\Http\Requests\PerencanaanKinerja;

use Illuminate\Foundation\Http\FormRequest;

class CreateRenstraOpdRequest extends FormRequest
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
            'opd_id' => 'required',
            'file' => 'required|max:500000',
            'periode_renstra_opd_id' => 'nullable',
        ];
    }
}
