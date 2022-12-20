<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class OpdPenilaianResource extends JsonResource
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
            'opd_id' => $this->opd_id,
            'kode_opd' => $this->opd->kode_opd,
            'data_unit_id' => $this->opd->data_unit_id,
            'master_unit_kerja_id' => $this->opd->master_unit_kerja_id,
            'year' => $this->year,
            'name' => $this->name ?? 'TAHUNAN',
            'opd_name' => $this->opd->nama_opd,
            'opd_category' => $this->opd_category->name,
            'status' => $this->status,
            'nilai_akhir' => $this->totalAkhir(),
            'nilai_akhir_predikat' => $this->totalAkhirPredikat(),
        ];
    }
}
