<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Klasifikasi extends Model
{
    protected $guarded = ['id'];

    public function getFullCodeAttribute()
    {
        return $this->group_code . $this->code;
    }

    public function group(): BelongsTo
    {
        return $this->belongsTo(Group::class, 'group_code', 'code')->withDefault();
    }
}
