<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Company;
use App\Models\Set;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class SetFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Set::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $title = $this->faker->sentence(1);

        return [
            'title' => $title,
            'code' => $this->faker->randomNumber(),
            'slug' => Str::slug($title),
            'description' => $this->faker->realText()
        ];
    }
}
