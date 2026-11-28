<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PerhitunganHasil extends Model
{
    protected $table = 'perhitungan_hasil';
    protected $guarded = [];
    public $timestamps = false;

    public function aset() { return $this->belongsTo(Aset::class)->withTrashed(); }

}
