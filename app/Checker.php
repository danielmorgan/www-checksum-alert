<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Checker
 *
 * @property-read \App\User $user
 * @mixin \Eloquent
 */
class Checker extends Model
{
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
