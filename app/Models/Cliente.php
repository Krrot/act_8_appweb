<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    use HasFactory;

    protected $table = 'clientes';

    public $timestamps = false;

    protected $fillable = [
        'numeroCliente',
        'telefono',
        'correoElectronico',
        'activo',
        'registroFecha',
        'direccionesId',
    ];

    public function direccion()
    {
        return $this->belongsTo(Direccion::class, 'direccionesId');
    }

    public function pedidos()
    {
        return $this->hasMany(Pedido::class, 'clienteId');
    }

    public function facturas()
    {
        return $this->hasMany(ClienteFactura::class, 'clienteId');
    }
}