<?php

namespace Database\Seeders;

use App\Models\Matiere;
use Illuminate\Database\Seeder;

class MatiereSeeder extends Seeder
{
    public function run()
    {
        $names = [
            'Mathématiques', 'Physique', 'SVT', 'Histoire',
            'Géographie', 'Français', 'Anglais', 'Philosophie'
        ];

        foreach ($names as $nom) {
            Matiere::create(['nom' => $nom]);
        }
    }
}
