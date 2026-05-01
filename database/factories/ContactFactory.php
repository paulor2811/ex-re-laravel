<?php

namespace Database\Factories;

use App\Models\Contact;
use App\Models\Person;
use Illuminate\Database\Eloquent\Factories\Factory;

class ContactFactory extends Factory
{
    protected $model = Contact::class;

    public function definition(): array
    {
        return [
            'person_id' => Person::factory(),
            'country_code' => $this->faker->numberBetween(1, 999),
            'number' => $this->faker->numerify('#########'),
        ];
    }
}
