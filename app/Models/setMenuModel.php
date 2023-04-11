<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class setMenuModel extends Model
{
    protected $table = 'menu';
    public $timestamps = false;
    protected $primaryKey = ['rol_id','menu_id','menu_rutas'];

}
