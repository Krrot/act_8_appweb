<?php

namespace Database\Seeders;

use App\Models\Cliente;
use App\Models\Pedido;
use Illuminate\Database\Seeder;

class TestDataSeeder extends Seeder
{
    public function run()
    {
        // Crear cliente de prueba
        $cliente = Cliente::create([
            'numeroCliente' => 'CLI001',
            'telefono' => '555-1234',
            'correoElectronico' => 'cliente@example.com',
            'activo' => true,
            'registroFecha' => now(),
        ]);

        // Crear pedido de prueba con estado "Delivered"
        $pedido = Pedido::create([
            'numeroFactura' => 'INV001',
            'clienteId' => $cliente->id,
            'fechaPedido' => now(),
            'estadoId' => 4, // Delivered
            'usuarioId' => 1, // Admin user
            'activo' => true,
            'creacionEn' => now(),
        ]);

        echo "Cliente de prueba creado: {$cliente->numeroCliente}\n";
        echo "Pedido de prueba creado: {$pedido->numeroFactura}\n";
    }
}
