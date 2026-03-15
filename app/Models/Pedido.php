<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    use HasFactory;

    protected $table = 'pedidos';

    protected $fillable = [
        'numeroFactura',
        'clienteId',
        'fechaPedido',
        'notas',
        'estadoId',
        'usuarioId',
        'activo',
        'creacionEn',
    ];

    public function cliente()
    {
        return $this->belongsTo(Cliente::class, 'clienteId');
    }

    public function usuario()
    {
        return $this->belongsTo(User::class, 'usuarioId');
    }

    public function evidencias()
    {
        return $this->hasMany(EvidenciaFotografica::class, 'pedidoId');
    }

    public function getStatusAttribute()
    {
        $statuses = [
            1 => 'Ordered',
            2 => 'In process',
            3 => 'In route',
            4 => 'Delivered',
        ];
        return $statuses[$this->estadoId] ?? 'Unknown';
    }
}