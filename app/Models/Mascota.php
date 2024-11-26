<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mascota extends Model
{
    use HasFactory;

    protected $fillable = ['clientes_id','documento', 'nombre', 'razas_id', 'tipo', 'sexo', 'edad', 'image_path'];

    public function clientes(){
        return $this -> belongsTo(Cliente :: class, 'clientes_id');
    }

    public function razas(){
        return $this -> belongsTo(Raza :: class, 'razas_id');
    }

    public function vacunas(){
        return $this -> hasMany(Mascota :: class, 'id');
    }

    public function getImageUrlAttribute(){
        return $this->image_path ? asset('storage/mascotas/' . $this->image_path) : null;
    }
    
}

