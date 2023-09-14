<?php

namespace Database\Factories\Report;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\SalesReport>
 */
class SalesReportFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'client_name' => $this->faker->name(),
            'project_name' => $this->faker->company(),
            'business_branch' => $this->faker->country(),
            'amount' => $this->faker->numberBetween($min = 1500, $max = 6000),
            'InvoceNo' => $this->faker->regexify('[A-Z]{5}[0-4]{3}'),
            'date' => $this->faker->dateTimeBetween('-1 week', '+1 week')
        ];
    }
}
