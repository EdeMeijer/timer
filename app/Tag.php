<?php

namespace App;

use Eloquent;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @mixin Eloquent
 *
 * @property int $user_id
 * @property string $description
 */
class Tag extends Model
{
    use SoftDeletes;

    public function timerEntries()
    {
        return $this->belongsToMany(TimerEntry::class);
    }
}
