<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class catalogo_proveedores extends Model
{
    protected $table = 'cat_proveedores';
    public $timestamps = false;
    protected $primaryKey = 'pro_id';
}
