<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PerhitunganBobot extends Model
{
    protected $table = 'perhitungan_bobot';
    protected $guarded = [];
    public $timestamps = false;

    public function kriteria() { return $this->belongsTo(Kriteria::class); }

}
