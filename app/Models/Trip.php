<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Trip extends Model
{
    use HasFactory;

    protected $primaryKey = 'trip_id'; //Si la clé primaire n'est pas id

    public $timestamps = false;

}
