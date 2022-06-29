<?php

namespace App\Http\Resources;

use App\Models\EvaluasiKinerja\EvaluasiKinerjaYear;
use App\Models\Opd;
use Illuminate\Http\Resources\Json\JsonResource;

class EvaluasiResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->nama_opd,
            'hasil' => EvaluasiKinerjaResource::collection($this->evaluasi_kinerjas->sortBy('evaluasi_kinerja_year.year')),
        ];
    }
}
