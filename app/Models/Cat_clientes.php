<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cat_clientes extends Model
{
    protected $table = 'cat_clientes';
    public $timestamps = false;
    protected $primaryKey = 'cli_id';
}
