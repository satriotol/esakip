<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class OpdPerjanjianKinerjaIndikatorResource extends JsonResource
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
            'indikator' => $this->indikator,
            'target' => $this->target,
            'satuan' => $this->satuan,
            'created_at' => $this->created_at->diffForHumans(),
        ];
    }
}