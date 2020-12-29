<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class JadwalMinum extends Model
{
    protected $fillable = [
        'terapi', 'dosis', 'jadwalminum', 'data_pasien_id',
    ];

    public function data_pasiens()
    {
        return $this->belongsTo(DataPasien::class);
    }
}
