<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Provider\Fakecar;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Car>
 */
class CarFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    
    public function definition(): array
    {
        $this->faker->addProvider(new Fakecar($this->faker));
        $vehicle = $this->faker->vehicleArray();
        
        return [
            'licensePlateNumber' =>$this->faker->vehicleRegistration,
            'brand' =>$vehicle['brand'],
            'model' =>$vehicle['model'],
            'yearOfManufacture' => $this->faker->biasedNumberBetween(1990, date('Y'), 'sqrt'),
            'fuelType' =>$this->faker->vehicleFuelType
        ];
    }
}
