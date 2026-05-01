<?php

namespace App\Services;

use App\Models\Person;
use Illuminate\Support\Facades\Http;

class PersonService
{
    public function create(array $data): Person
    {
        $data['avatar'] = $this->fetchAvatar();

        return Person::create($data);
    }

    public function update(Person $person, array $data): bool
    {
        if (isset($data['password']) && empty($data['password'])) {
            unset($data['password']);
        }

        return $person->update($data);
    }

    private function fetchAvatar(): ?string
    {
        try {
            $response = Http::get('https://app.pixelencounter.com/api/basic/monsters/random');
            if ($response->successful()) {
                return 'data:image/svg+xml;base64,' . base64_encode($response->body());
            }
        } catch (\Exception $e) {}

        return null;
    }
}
