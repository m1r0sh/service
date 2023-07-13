<?php

namespace Database\Factories;

use App\Models\Executor;
use App\Models\ServiceType;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Service>
 */
class ServiceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $executor = Executor::factory()->create();
        $servicesType = ServiceType::factory()->create();

        return [
            'title' => $this->faker->title,
            'description' => $this->faker->text(20),
            'status' => $this->faker->text(5),
            'start_date' => $this->faker->date('Y_m_d'),
            'end_date' => $this->faker->date('Y_m_d'),
            'executor_id' => $executor->id,
            'service_type_id' => $servicesType->id,
        ];
    }
}
