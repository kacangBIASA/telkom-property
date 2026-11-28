<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Perhitungan extends Model
{
    protected $table = 'perhitungan';
    protected $guarded = [];

    public function wilayah() { return $this->belongsTo(Wilayah::class, 'filter_wilayah_id'); }
    public function bobot() { return $this->hasMany(PerhitunganBobot::class); }
    public function detail() { return $this->hasMany(PerhitunganDetail::class); }
    public function hasil() { return $this->hasMany(PerhitunganHasil::class)->orderBy('peringkat'); }
}
