<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class GeneralJournal extends Model
{
    protected $guarded = ['id'];

    public function details(): HasMany
    {
        return $this->hasMany(GeneralJournalDetail::class, 'general_journal_reff', 'reff');
    }

    public function getFormattedDateAttribute()
    {
        return Carbon::parse($this->date)->format('d M Y');
    }
}
