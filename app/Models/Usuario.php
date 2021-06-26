<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Usuario extends Authenticatable
{
    use HasFactory;
    public $table = "usuario";
    public $primaryKey = "id_usuario";
    //public $timestamps=false;
    protected $fillable = [
        'nombres', 'usuario', 'password', 'correo','estado','foto'
    ];
}
