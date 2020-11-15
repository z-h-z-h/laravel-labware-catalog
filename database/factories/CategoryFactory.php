<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Company;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class CategoryFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Category::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {


        $title = $this->faker->sentence(1);
        $slug = Str::slug($title);
        $description = $this->faker->realText();
        return [

            'title' => $title,
            'slug' => $slug,
            'description' => $description
        ];
    }
  }
