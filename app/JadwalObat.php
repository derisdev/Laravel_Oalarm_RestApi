<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class JadwalObat extends Model
{
    protected $fillable = [
        'tanggalambil', 'tanggalkembali', 'keluhan', 'data_pasien_id'
    ];

    public function data_pasiens()
    {
        return $this->belongsTo(DataPasien::class);
    }
}
