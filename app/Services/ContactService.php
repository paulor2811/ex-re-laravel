<?php

namespace App\Services;

use App\Models\Contact;

class ContactService
{
    public function create(array $data): Contact
    {
        return Contact::create($data);
    }

    public function update(Contact $contact, array $data): bool
    {
        return $contact->update($data);
    }

    public function delete(Contact $contact): ?bool
    {
        return $contact->delete();
    }
}
