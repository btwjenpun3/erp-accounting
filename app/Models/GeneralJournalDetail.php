<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class GeneralJournalDetail extends Model
{
    protected $guarded = ['id'];

    public function journal(): BelongsTo
    {
        return $this->belongsTo(GeneralJournal::class, 'general_journal_reff', 'reff')->withDefault();
    }
}
