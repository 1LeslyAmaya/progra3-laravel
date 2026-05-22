<?php

namespace Database\Factories;

use App\Models\Catedratico;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Curso>
 */
class CursoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'catedratico_id' => Catedratico::factory(),
            'codigo' => $this->faker->unique()->bothify('CUR-###-??'),
            'nombre' => $this->faker->randomElement([
                'Programacion III',
                'Base de Datos I',
                'Base de Datos II',
                'Analisis de Sistemas',
                'Redes de Computadoras',
                'Ingenieria de Software',
                'Matematica Discreta',
                'Estadistica Aplicada',
                'Contabilidad General',
                'Administracion de Proyectos',
                'Sistemas Operativos',
                'Desarrollo Web',
            ]),
            'descripcion' => $this->faker->sentence(12),
            'creditos' => $this->faker->numberBetween(2, 5),
            'ciclo' => $this->faker->randomElement(['Primer ciclo', 'Segundo ciclo', 'Interciclo']),
            'modalidad' => $this->faker->randomElement(['presencial', 'virtual', 'hibrido']),
            'cupo' => $this->faker->numberBetween(20, 45),
            'estado' => $this->faker->randomElement(['activo', 'inactivo']),
        ];
    }
}
