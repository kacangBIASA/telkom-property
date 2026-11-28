<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Aset extends Model
{
    use SoftDeletes;

    protected $table = 'aset';
    protected $guarded = [];

    public function gambar()
    {
        return $this->hasMany(AsetGambar::class);
    }

    public function wilayah()
    {
        return $this->belongsTo(Wilayah::class);
    }

    /** C1: luas ruang idle sesuai jenis aset. */
    public function getLuasIdleAttribute(): float
    {
        return (float) ($this->jenis === 'gedung' ? $this->space_idle_gedung : $this->luas_lahan_idle);
    }

    public function getPersenIdleAttribute(): float
    {
        $dasar = (float) ($this->jenis === 'gedung' ? $this->luas_gedung : $this->luas_tanah);

        return $dasar > 0 ? $this->luas_idle / $dasar * 100 : 0;
    }

    /** Foto utama; aset tanpa foto unggahan memakai gambar contoh. */
    public function getFotoAttribute(): string
    {
        return asset($this->gambar->first()?->path ?? 'images/aset-default.png');
    }

    public function scopeAlternatif($q)
    {
        return $q->whereIn('status_utilisasi', ['kosong', 'sebagian']);
    }
}
