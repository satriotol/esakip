<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class ARealisasiKeunganResource extends JsonResource
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
            'anggaran' => $this->a_realisasi_keuangans->where('tahun', $year)->sum('anggaran'),
            'perubahan' => $this->a_realisasi_keuangans->where('tahun', $year)->sum('perubahan'),
            'januari' => $this->a_realisasi_keuangans->where('tahun', $year)->sum('januari'),
            'februari' => $this->a_realisasi_keuangans->where('tahun', $year)->sum('februari'),
            'maret' => $this->a_realisasi_keuangans->where('tahun', $year)->sum('maret'),
            'april' => $this->a_realisasi_keuangans->where('tahun', $year)->sum('april'),
            'mei' => $this->a_realisasi_keuangans->where('tahun', $year)->sum('mei'),
            'juni' => $this->a_realisasi_keuangans->where('tahun', $year)->sum('juni'),
            'juli' => $this->a_realisasi_keuangans->where('tahun', $year)->sum('juli'),
            'agustus' => $this->a_realisasi_keuangans->where('tahun', $year)->sum('agustus'),
            'september' => $this->a_realisasi_keuangans->where('tahun', $year)->sum('september'),
            'oktober' => $this->a_realisasi_keuangans->where('tahun', $year)->sum('oktober'),
            'november' => $this->a_realisasi_keuangans->where('tahun', $year)->sum('november'),
            'desember' => $this->a_realisasi_keuangans->where('tahun', $year)->sum('desember'),
            'jml_realisasi' => $this->a_realisasi_keuangans->where('tahun', $year)->sum('jml_realisasi'),
        ];
    }
}
