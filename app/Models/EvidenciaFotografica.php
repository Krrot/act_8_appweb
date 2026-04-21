<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EvidenciaFotografica extends Model
{
    use HasFactory;

    protected $table = 'evidenciasfotograficas';

    public $timestamps = false;

    protected $fillable = [
        'pedidoId',
        'usuarioId',
        'tipo',
        'urlFoto',
        'fechaSubida',
        'descripcion',
    ];

    protected function casts(): array
    {
        return [
            'fechaSubida' => 'datetime',
        ];
    }

    public function pedido()
    {
        return $this->belongsTo(Pedido::class, 'pedidoId');
    }

    public function usuario()
    {
        return $this->belongsTo(User::class, 'usuarioId');
    }
}