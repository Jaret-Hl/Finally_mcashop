<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Articulos extends Model
{
    protected $table = 'cat_articulos';
    public $timestamps = false;
    protected $primaryKey = 'art_id';
}
