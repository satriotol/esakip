<?php

namespace App\Http\Requests\OpdPerjanjianKinerjaIndikator;

use Illuminate\Foundation\Http\FormRequest;

class CreateOpdPerjanjianKinerjaIndikatorRequest extends FormRequest
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
            'addMoreInputFields.*.opd_perjanjian_kinerja_sasaran_id' => 'required',
            'addMoreInputFields.*.indikator' => 'required',
            'addMoreInputFields.*.target' => 'required',
            'addMoreInputFields.*.satuan' => 'nullable',
            'addMoreInputFields.*.is_iku' => 'nullable',
            'addMoreInputFields.*.is_sakip' => 'nullable',
        ];
    }
}
