<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    protected $table = 'menu'; 
    public $timestamps = false;
    protected $primaryKey = 'menu_id';
    
    public function scopeRoles($query,$parametro)
    {
            return $query->where('role_id','=', $parametro);
     
    }
    
}
