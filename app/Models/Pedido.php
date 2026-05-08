<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    use HasFactory;

    protected $table = 'pedidos';

    public $timestamps = false;

    protected $fillable = [
        'numeroFactura',
        'clienteId',
        'fechaPedido',
        'notas',
        'estadoId',
        'usuarioId',
        'routeUsuarioId',
        'activo',
        'creacionEn',
    ];

    protected $casts = [
        'fechaPedido' => 'datetime',
        'creacionEn' => 'datetime',
        'activo' => 'boolean',
    ];

    public function cliente()
    {
        return $this->belongsTo(Cliente::class, 'clienteId');
    }

    public function usuario()
    {
        return $this->belongsTo(User::class, 'usuarioId');
    }

    public function routeUsuario()
    {
        return $this->belongsTo(User::class, 'routeUsuarioId');
    }

    public function evidencias()
    {
        return $this->hasMany(EvidenciaFotografica::class, 'pedidoId');
    }

    public function getStatusAttribute()
    {
        $statuses = [
            1 => __('ordered'),
            2 => __('in_process'),
            3 => __('in_route'),
            4 => __('delivered'),
        ];
        return $statuses[$this->estadoId] ?? 'Unknown';
    }
}