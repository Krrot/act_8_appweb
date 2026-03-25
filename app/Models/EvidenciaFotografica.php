<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EvidenciaFotografica extends Model
{
    use HasFactory;

    protected $table = 'evidenciasfotograficas';

    protected $fillable = [
        'pedidoId',
        'usuarioId',
        'tipo',
        'urlFoto',
        'fechaSubida',
        'descripcion',
        'rutaImagen',
    ];

    public function pedido()
    {
        return $this->belongsTo(Pedido::class, 'pedidoId');
    }

    public function usuario()
    {
        return $this->belongsTo(User::class, 'usuarioId');
    }
}