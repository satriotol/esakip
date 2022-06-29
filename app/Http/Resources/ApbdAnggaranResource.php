<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class ApbdAnggaranResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $year = Carbon::now()->year;
        return [
            'id_skpd' => $this->id_skpd,
            'nama_skpd' => $this->nama_skpd,
            'tahun' => $year,
            'anggaran' => $this->apbd_anggarans->where('tahun', $year)->sum('anggaran'),
            'anggaran_pergeseran' => $this->apbd_anggarans->where('tahun', $year)->sum('anggaran_pergeseran'),
            'anggaran_perubahan' => $this->apbd_anggarans->where('tahun', $year)->sum('anggaran_perubahan'),
        ];
    }
}
