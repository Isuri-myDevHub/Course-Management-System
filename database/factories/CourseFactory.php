<?php

namespace Database\Factories;

use App\Models\Course;
use Illuminate\Database\Eloquent\Factories\Factory;

class CourseFactory extends Factory
{
    protected $model = Course::class;

    public function definition()
    {
        return [
            'name' => $this->faker->sentence(3),
            'seo_url' => $this->faker->slug,
            'faculty' => $this->faker->word,
            'category' => 'Undergraduate',
            'status' => 'draft',
        ];
    }
}
