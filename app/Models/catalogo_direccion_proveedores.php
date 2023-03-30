<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class catalogo_direccion_proveedores extends Model
{
    protected $table = 'cat_proveedores_direcciones';
    public $timestamps = false;
    protected $primaryKey = 'prodir_id';
}
