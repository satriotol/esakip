<?php

namespace App\Http\Requests\EvaluasiKinerja;

use Illuminate\Foundation\Http\FormRequest;

class CreateEvaluasiKinerjaRequest extends FormRequest
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
            'opd_id.*' => 'required|numeric',
            // 'value.*' => 'nullable',
            // 'evaluasi_kinerja_year_id' => 'nullable',
        ];
    }
}
