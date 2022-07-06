<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class OpdPerjanjianKinerjaSasaranResource extends JsonResource
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
            'sasaran' => $this->sasaran,
            'created_at' => $this->created_at->diffForHumans(),
            'indikator' => OpdPerjanjianKinerjaIndikatorResource::collection($this->opd_perjanjian_kinerja_indikators)
        ];
    }
}
