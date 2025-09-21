<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Task>
 */
class TaskFactory extends Factory
{

    public $tareasPosibles = [
    'Gestión de marketing',
    'Control de divisas',
    'Mobiliario urbano',
    'Medición de ruido',
    'Creación de equipos',
    'Estructuración de paisajes',
    'Control de contaminación lumínica',
    'Atención a la dependencia',
    'Gestión ciudadana',
    'Control de plagas',
    'Limpieza urbana',
    'Orden social',
    'Gestión de residuos',
    'Canalización de tráfico rodado',
    'Instalaciones primarias',
    'Mantenimiento de edificios',
    'Instituciones',
    'Relaciones públicas',
    'Seguridad ciudadana',
    'Gestión de convivencia'
];

    public function definition(): array
    {
        return [
            'tarea' => $this->faker->unique()->randomElement($this->tareasPosibles),
            'descripcion' => $this->faker->sentence(20)
        ];
    }
}
