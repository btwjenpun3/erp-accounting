<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Account extends Model
{
    protected $guarded = ['id'];

    public function getFullCodeAttribute()
    {
        return $this->subKlasifikasi->full_code . $this->code;
    }

    public function subKlasifikasi(): BelongsTo
    {
        return $this->belongsTo(SubKlasifikasi::class, 'sub_klasifikasi_code', 'code')->withDefault();
    }
}
