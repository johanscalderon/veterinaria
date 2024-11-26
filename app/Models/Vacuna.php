<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vacuna extends Model
{
    use HasFactory;

    protected $fillable = ['mascotas_id', 'nombre_vacuna', 'lote', 'fecha_aplicacion', 'fecha_proxima_dosis'];

    public function mascotas(){
        return $this -> belongsTo(Mascota :: class, 'mascotas_id');
    }
}