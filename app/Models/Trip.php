<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Trip extends Model
{
    use HasFactory;

    protected $primaryKey = 'trip_id'; //Si la clé primaire n'est pas id

    public $timestamps = false;

    public function route(): BelongsTo
    {
        return $this->belongsTo(Route::class, 'route_id', 'route_id');
    }

    public function shapes(): HasMany 
    {
        return $this->hasMany(Shape::class, 'shape_id', 'shape_id');
    }

    public function stops(): BelongsToMany
    {
        return $this->belongsToMany(Route::class, 'stops_trips', 'stop_id', 'trip_id');
    }

}
