<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DataPasien extends Model
{
    protected $fillable = [
        'norekammedik', 'nama', 'tanggallahir', 'umur', 'alamat', 'kodediagnosa', 'kodedx', 'terapi', 'dosis', 'pmo' 
    ];

    public function jadwal_minums()
    {
        return $this->hasMany(JadwalMinum::class);
    }

    public function jadwal_obats()
    {
        return $this->hasMany(JadwalObat::class);
    }
}
