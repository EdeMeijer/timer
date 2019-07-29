<?php

namespace App;

use DateTimeInterface;
use Eloquent;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @mixin Eloquent
 *
 * @property int $user_id
 * @property string $description
 * @property DateTimeInterface $start_date
 * @property DateTimeInterface|null $end_date
 */
class TimerEntry extends Model
{
    use SoftDeletes;

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }
}
