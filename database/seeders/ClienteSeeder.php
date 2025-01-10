<?php

namespace Database\Seeders;

use App\Models\Cliente;
use Illuminate\Database\Seeder;

class ClienteSeeder extends Seeder
{
    public function run()
    {
        $nombres = ['Juan', 'María', 'Pedro', 'Ana', 'Luis', 'Carmen', 'José', 'Paula', 'Diego', 'Laura'];
        $apellidos = ['García', 'Rodríguez', 'Martínez', 'López', 'González', 'Pérez', 'Sánchez', 'Ramírez', 'Torres', 'Flores'];

        for ($i = 1; $i <= 40; $i++) {
            Cliente::create([
                'nombre' => $nombres[array_rand($nombres)],
                'apellido' => $apellidos[array_rand($apellidos)],
                'rut' => rand(10000000, 99999999) . '-' . rand(0, 9)
            ]);
        }
    }
}
