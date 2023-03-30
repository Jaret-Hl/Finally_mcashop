<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Marcas extends Model
{
    protected $table = 'cat_marcas';
    public $timestamps = false;
    protected $primaryKey = 'mar_id';

    protected $fillable = ['mar_logotipo'];

}
