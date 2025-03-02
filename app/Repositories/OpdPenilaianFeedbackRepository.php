<?php

namespace App\Repositories;

use App\Models\OpdPenilaianFeedback;

class OpdPenilaianFeedbackRepository
{
    public function get($request)
    {
        $query = OpdPenilaianFeedback::query();
        return $query;
    }
    public function validate($data)
    {
        $rules = [
            'opd_penilaian_id' => 'required',
            'feedback' => 'required|min:50',
        ];

        $messages = [
            'opd_penilaian_id.required' => 'Field OPD Penilaian wajib diisi.',
            'feedback.required' => 'Field Feedback wajib diisi.',
            'feedback.min' => 'Field Feedback harus memiliki minimal 50 karakter.',
        ];

        return validator($data, $rules, $messages);
    }
    public function store($data)
    {
        $data = $this->validate($data);
        $data['user_id'] = auth()->user()->id;
        dd($data);
        OpdPenilaianFeedback::updateOrCreate([
            'opd_penilaian_id' => $data['opd_penilaian_id'],
        ], $data);
    }
}
