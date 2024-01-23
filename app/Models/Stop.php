<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Stop extends Model
{
    use HasFactory;

    protected $primaryKey = 'stop_id';

    public $timestamps = false;

    public function trips(): BelongsToMany
    {
        return $this->belongsToMany(Route::class, 'stop_trip', 'trip_id', 'stop_id'); // la table intermédiaire, la clé étrangère, la clé locale
    }

}
