<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetalleFactura extends Model
{
    use HasFactory;

    protected $table = 'detallefacturas';

    protected $fillable = [
        'clienteFacturaId',
        'total',
        'materialesId',
    ];

    public function factura()
    {
        return $this->belongsTo(ClienteFactura::class, 'clienteFacturaId');
    }

    public function material()
    {
        return $this->belongsTo(Material::class, 'materialesId');
    }
}