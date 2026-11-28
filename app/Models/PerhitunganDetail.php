<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PerhitunganDetail extends Model
{
    protected $table = 'perhitungan_detail';
    protected $guarded = [];
    public $timestamps = false;

    public function aset() { return $this->belongsTo(Aset::class)->withTrashed(); }
    public function kriteria() { return $this->belongsTo(Kriteria::class); }
}
