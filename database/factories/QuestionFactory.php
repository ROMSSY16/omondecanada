<?php
// database/factories/QuestionFactory.php

namespace Database\Factories;

use App\Models\Question;
use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

class QuestionFactory extends Factory
{
    protected $model = Question::class;

    public function definition()
    {
        return [
            'category_id' => Category::factory(),
            'question' => $this->faker->sentence,
        ];
    }
}
