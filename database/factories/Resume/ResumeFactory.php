<?php

namespace Database\Factories\Resume;

use App\Models\Resume\Resume;
use Illuminate\Database\Eloquent\Factories\Factory;

class ResumeFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Resume::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'last_name' => $this->faker->unique()->lastName(),
            'name' => $this->faker->name(),
            'code' => $this->faker->name(),
            'second_name' => $this->faker->firstName(),
            'phone' => $this->faker->phoneNumber(),
            'email' => $this->faker->email(),
            'description' => $this->faker->word(2),
            'points' => 0,
            'is_active' => true,
            'sort' => 100,
            'form_id' => 1,
            'user_id' => 1,
            'company_id' => 1,
            'resume_status_id' => $this->faker->numberBetween(1,5),
        ];
    }
}
