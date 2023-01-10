<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class EvaluasiKinerjaResource extends JsonResource
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
            'year' => $this->evaluasi_kinerja_year->year ?? '',
            'value' => $this->value,
            'category_color' => $this->category_name['color'] ?? '',
            'category_name' => $this->category_name['name'] ?? "",
            'category_font' => $this->category_name['font_color'] ?? '',
        ];
    }
}
