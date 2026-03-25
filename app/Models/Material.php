<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Material extends Model
{
    use HasFactory;

    protected $table = 'materiales';

    protected $fillable = [
        'claveMaterial',
        'descripcionMaterial',
        'precioUnitario',
        'cantidadMinima',
        'nombre',
        'descripcion',
        'stock',
    ];

    public function detallesFactura()
    {
        return $this->hasMany(DetalleFactura::class, 'materialesId');
    }
}