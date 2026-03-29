<?php
namespace Database\Seeders;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
class DatabaseSeeder extends Seeder {
    public function run(): void { // Creamos un usuario administrador fijo al ejecutar el seeder, permitiendo que tengamos un usuario inicial para entrar al sistema
        User::factory()->create([
            'dni' => '74877861',
            'first_name' => 'Mauro Fernando',
            'paternal_surname' => 'Caritas',
            'maternal_surname' => 'Borja',
            'phone' => '987590855',
            'email' => 'mfcaritasbdos@gmail.com',
            'password' => Hash::make('mauro0175'), // La contraseña se guarda encriptada
            'role' => 'admin', // Este usuario será administrador
            'status' => 'active', // El usuario está activo
            'cal_number' => null, // el administrador no tiene colegiatura
        ]);
    }
}
