<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Alumno>
 */
class AlumnoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'carnet' => $this->faker->unique()->numerify('0909-26-#####'),
            'nombres' => $this->faker->firstName(),
            'apellidos' => $this->faker->lastName(),
            'email' => $this->faker->unique()->safeEmail(),
            'telefono' => $this->faker->phoneNumber(),
            'fecha_nacimiento' => $this->faker->date(),
            'carrera' => $this->faker->randomElement([
                'Ingeniería en Sistemas',
                'Ingeniería Civil',
                'Administración de Empresas',
                'Medicina',
                'Derecho',
            ]),
            'semestre' => $this->faker->numberBetween(1, 10),
            'estado' => $this->faker->randomElement(['activo', 'inactivo', 'graduado', 'suspendido']),
        ];
    }
}
