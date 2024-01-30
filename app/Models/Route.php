<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Route extends Model
{
    use HasFactory;

    protected $primaryKey = 'route_id';

    public $timestamps = false;

    protected $guarded = [];

    public function trips(): HasMany 
    {
        return $this->hasMany(Trip::class, 'route_id', 'route_id'); // la clé étrangère, la clé locale
    }
}
