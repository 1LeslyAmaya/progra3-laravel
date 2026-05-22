<?php

namespace Database\Seeders;

use App\Models\Catedratico;
use App\Models\Curso;
use Illuminate\Database\Seeder;

class CatedraticosCursosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $catedraticos = Catedratico::factory()
            ->count(250)
            ->create();

        Curso::factory()
            ->count(1500)
            ->sequence(fn () => [
                'catedratico_id' => $catedraticos->random()->id,
            ])
            ->create();
    }
}
