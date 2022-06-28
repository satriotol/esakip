<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class LkjipOpdResource extends JsonResource
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
            'file_url' => $this->file_url,
            'opd' => $this->opd->nama_opd,
        ];
    }
}
