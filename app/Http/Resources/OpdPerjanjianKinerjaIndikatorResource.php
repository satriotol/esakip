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
            'is_sakip' => $this->is_sakip,
            'is_iku' => $this->is_iku,
            'is_rb' => $this->is_rb,
            'created_at' => $this->created_at->diffForHumans(),
        ];
    }
}
