<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\City;
use App\Models\Manager;
use App\Models\Task;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    
        

    public function run(): void
    {
        $cities = City::factory()->count(20)->create();
        $managers = Manager::factory()->count(10)->create();

        $faker = Faker::create();
        
        // creamos las tareas
        Task::factory()->count(20)->create()
        ->each(function($task) use($cities, $managers, $faker){
            $task->cities()
            ->attach($cities->random(mt_rand(5,15))
            ->pluck('id'),
            [
                //'f_inicio' => $this->$faker->dateTimeInInterval('- 2 years','+ 6 months'),
                //'f_final' => $this->$faker->dateTimeInInterval('- 1 years','+ 6 months'),
                'manager_id' => $managers->random()->id,
                'activa' => mt_rand(0,1),
            ]);
        });        
    }
}
