<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Direccion extends Model
{
    use HasFactory;

    protected $table = 'direcciones';

    protected $fillable = [
        'calle',
        'numeroExterior',
        'numeroInterior',
        'colonia',
        'ciudad',
        'municipio',
        'estado',
        'pais',
        'codigoPostal',
    ];

    public function clientes()
    {
        return $this->hasMany(Cliente::class, 'direccionesId');
    }
}