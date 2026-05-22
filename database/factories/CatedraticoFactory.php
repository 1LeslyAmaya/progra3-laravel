<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Catedratico>
 */
class CatedraticoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $nombres = $this->faker->firstName();
        $apellidos = $this->faker->lastName() . ' ' . $this->faker->lastName();

        return [
            'codigo' => $this->faker->unique()->numerify('CAT-####'),
            'nombres' => $nombres,
            'apellidos' => $apellidos,
            'email' => $this->faker->unique()->safeEmail(),
            'telefono' => $this->faker->numerify('####-####'),
            'especialidad' => $this->faker->randomElement([
                'Programacion',
                'Bases de Datos',
                'Redes',
                'Matematica',
                'Estadistica',
                'Administracion',
                'Contabilidad',
                'Sistemas Operativos',
            ]),
            'fecha_contratacion' => $this->faker->dateTimeBetween('-15 years', '-1 month')->format('Y-m-d'),
            'estado' => $this->faker->randomElement(['activo', 'inactivo']),
        ];
    }
}
