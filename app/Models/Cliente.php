<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    use HasFactory;

    protected $fillable = ['cedula','nombre', 'telefono', 'direccion'];

    public function mascotas(){
        return $this -> hasMany(Mascota :: class, 'id');
    }
}
