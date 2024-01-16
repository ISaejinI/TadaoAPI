<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Stop extends Model
{
    use HasFactory;

    protected $primaryKey = 'stop_id';

    public $timestamps = false;

    public function trips(): BelongsTo
    {
        return $this->belongsTo(Route::class, 'trip_id', 'stop_id');
    }

}
