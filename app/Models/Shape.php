<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Shape extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $guarded = [];

    public function trips(): BelongsTo
    {
        return $this->belongsTo(Route::class, 'shape_id', 'shape_id');
    }
}
