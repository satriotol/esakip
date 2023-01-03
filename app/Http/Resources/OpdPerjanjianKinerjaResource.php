<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class OpdPerjanjianKinerjaResource extends JsonResource
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
            'year' => $this->year,
            'kode_opd' => $this->opd->kode_opd,
            'opd_name' => $this->opd->nama_opd,
            'type' => $this->type,
            'file_url' => $this->file_url,
            'created_at' => $this->created_at->diffForHumans(),
            'sasaran' => OpdPerjanjianKinerjaSasaranResource::collection($this->opd_perjanjian_kinerja_sasarans)
        ];
    }
}
