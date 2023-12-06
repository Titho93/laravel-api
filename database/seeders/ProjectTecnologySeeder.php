<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Tecnology;
use App\Models\Project;

class ProjectTecnologySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 0; $i <= 30; $i++) {
            $project = Project::inRandomOrder()->first();
            $tecnology_id = Tecnology::inRandomOrder()->first()->id;
            $project->tecnologies()->attach($tecnology_id);
        }
    }
}
