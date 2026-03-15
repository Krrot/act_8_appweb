<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClienteFactura extends Model
{
    use HasFactory;

    protected $table = 'clientefacturas';

    protected $fillable = [
        'clienteId',
        'numeroFactura',
        'nombreRazonSocial',
        'RFC',
        'regimenFiscal',
        'fechaFactura',
    ];

    public function cliente()
    {
        return $this->belongsTo(Cliente::class, 'clienteId');
    }

    public function detalles()
    {
        return $this->hasMany(DetalleFactura::class, 'facturaId');
    }
}