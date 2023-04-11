<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    protected $table = 'menu_roles'; 
    public $timestamps = false;
    protected $primaryKey = 'menu_id';
    
    
}
