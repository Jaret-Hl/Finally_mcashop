<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cat_Clientes_Direccion extends Model
{
    protected $table = 'cat_clientes_direcciones';
    public $timestamps = false;
    protected $primaryKey = 'clidir_id';
}
