<?php

namespace App\Http\Controllers;

use App\Models\Person;
use App\Http\Requests\People\StorePersonRequest;
use App\Http\Requests\People\UpdatePersonRequest;
use App\Services\PersonService;

class PersonController extends Controller
{
    protected $personService;

    public function __construct(PersonService $personService)
    {
        $this->personService = $personService;
    }

    public function index()
    {
        $people = Person::withCount('contacts')->get();
        return view('people.index', compact('people'));
    }

    public function create()
    {
        return view('people.create');
    }

    public function store(StorePersonRequest $request)
    {
        $this->personService->create($request->validated());
        return redirect()->route('people.index')->with('success', 'Pessoa criada com sucesso!');
    }

    public function show(Person $person)
    {
        $person->load('contacts');
        return view('people.show', compact('person'));
    }

    public function edit(Person $person)
    {
        return view('people.edit', compact('person'));
    }

    public function update(UpdatePersonRequest $request, Person $person)
    {
        $this->personService->update($person, $request->validated());
        return redirect()->route('people.index')->with('success', 'Dados atualizados!');
    }

    public function destroy(Person $person)
    {
        $person->delete();
        return redirect()->route('people.index')->with('success', 'Pessoa removida!');
    }
}
