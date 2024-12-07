<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SubKlasifikasi extends Model
{
    protected $guarded = ['id'];

    public function getFullCodeAttribute()
    {
        return $this->klasifikasi->full_code . $this->code;
    }

    public function klasifikasi(): BelongsTo
    {
        return $this->belongsTo(Klasifikasi::class, 'klasifikasi_code', 'code')->withDefault();
    }
}
