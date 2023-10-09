<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title'=>$this->faker->text(15, 20),
            'desc'=>$this->faker->text(190),
            'category'=>$this->faker->randomElement([ "sale",
            "regular",
            "newest",
            "bargain"]),
            'price'=>$this->faker->randomFloat(2, 100, 500),
        ];
    }
}