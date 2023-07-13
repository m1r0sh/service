<?php

namespace Database\Factories;

use App\Models\ServiceType;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Attribute>
 */
class AttributeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $serviceType = ServiceType::factory()->create(10);

        return [
            'name' => $this->faker->name,
            'type' => $this->faker->text(10),
            'description' => $this->faker->text(20),
            'service_type_id' => $serviceType->id,
        ];
    }
}
