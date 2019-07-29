<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @mixin Eloquent
 *
 * @property int $id
 * @property string $description
 */
class Tag extends Model
{
    use SoftDeletes;

    public function timerEntries()
    {
        return $this->belongsToMany(TimerEntry::class);
    }

    public static function getByUser(User $user): Collection
    {
        return Tag::where('user_id', $user->id)
            ->orderBy('description', 'asc')
            ->get();
    }

    public function __toString()
    {
        return $this->description;
    }
}
