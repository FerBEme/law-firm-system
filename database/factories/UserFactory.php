<?php
namespace Database\Factories;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
class UserFactory extends Factory {
    public function definition(): array { // Define los valores por defecto de un usuario falso
        return [
            'dni' => $this->faker->numerify('########'), // DNI simulado de 8 dígitos
            'first_name' => $this->faker->name(), // Nombre falso
            'paternal_surname' => $this->faker->lastName(), // Apellido paterno falso
            'maternal_surname' => $this->faker->lastName(), // Apellido materno falso
            'phone' => $this->faker->numerify('9########'), // Celular simulado comenzando con 9
            'email' => $this->faker->safeEmail(), // Email seguro generado automáticamente
            'password' => Hash::make('password'), // Constraseña fija para todos lo usuarios (encriptada)
            'role' => $this->faker->randomElement(['lawyer', 'secretary']), // Rol del usuario: puede ser 'lawyer' o 'secretary'
            'status' => $this->faker->randomElement(['active', 'inactive']), // Estado del usuario: activo o inactivo
            'profile_photo' => null, // Foto de perfil (aquí null, puede añadirse luego)
            'cal_number' => $this->faker->numerify('#####'), // Número de colegiado simulado
            'lawyer_id' => null, // Relación con abogado (solo aplicable si es secretaria)
        ];
    }
}
