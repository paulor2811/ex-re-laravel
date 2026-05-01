<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Person;
use App\Models\Contact;
use Illuminate\Support\Facades\Http;

class PeopleAndContactsSeeder extends Seeder
{
    public function run(): void
    {
        Person::factory(10)->create()->each(function ($person) {
            try {
                $response = Http::get('https://app.pixelencounter.com/api/basic/monsters/random');
                if ($response->successful()) {
                    $person->update(['avatar' => 'data:image/svg+xml;base64,' . base64_encode($response->body())]);
                }
            } catch (\Exception $e) {}

            Contact::factory(2)->create(['person_id' => $person->id]);
        });
    }
}
