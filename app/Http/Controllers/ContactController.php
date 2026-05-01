<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\Person;
use App\Http\Requests\Contacts\StoreContactRequest;
use App\Http\Requests\Contacts\UpdateContactRequest;
use App\Services\ContactService;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    protected $contactService;

    public function __construct(ContactService $contactService)
    {
        $this->contactService = $contactService;
    }

    public function index(Request $request)
    {
        $query = Contact::query();
        if ($request->has('person_id')) {
            $query->where('person_id', $request->person_id);
        }
        $contacts = $query->with('person')->get();

        if ($request->wantsJson() || $request->is('api/*')) {
            return response()->json($contacts);
        }
        return view('contacts.index', compact('contacts'));
    }

    public function create(Request $request)
    {
        $person = null;
        if ($request->has('person_id')) {
            $person = Person::findOrFail($request->person_id);
        }
        return view('contacts.create', compact('person'));
    }

    public function store(StoreContactRequest $request)
    {
        $contact = $this->contactService->create($request->validated());
        return redirect()->route('people.show', $contact->person_id)->with('success', 'Contato criado!');
    }

    public function show(Contact $contact)
    {
        return view('contacts.show', compact('contact'));
    }

    public function edit(Contact $contact)
    {
        return view('contacts.edit', compact('contact'));
    }

    public function update(UpdateContactRequest $request, Contact $contact)
    {
        $this->contactService->update($contact, $request->validated());
        return redirect()->route('people.show', $contact->person_id)->with('success', 'Contato atualizado!');
    }

    public function destroy(Contact $contact)
    {
        $personId = $contact->person_id;
        $this->contactService->delete($contact);
        return redirect()->route('people.show', $personId)->with('success', 'Contato removido!');
    }
}
