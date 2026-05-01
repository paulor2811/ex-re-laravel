@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-5">
        <div class="card shadow-sm text-center">
            <div class="card-body">
                <h4 class="mb-4">Detalhes do Contato</h4>
                
                <div class="mb-4">
                    <p class="text-muted small mb-0">Proprietário</p>
                    <h5 class="fw-bold">{{ $contact->person->name }}</h5>
                </div>

                <div class="bg-light p-4 rounded-3 mb-4">
                    <span class="badge bg-primary mb-2">+{{ $contact->country_code }}</span>
                    <h2 class="display-6 fw-bold mb-0" style="letter-spacing: 2px;">{{ $contact->number }}</h2>
                </div>

                <div class="d-grid gap-2">
                    @auth
                        <a href="{{ route('contacts.edit', $contact) }}" class="btn btn-warning">Editar</a>
                        <form action="{{ route('contacts.destroy', $contact) }}" method="POST">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn btn-outline-danger w-100" onclick="return confirm('Excluir?')">Excluir</button>
                        </form>
                    @endauth
                    <a href="{{ route('people.show', $contact->person_id) }}" class="btn btn-link">← Voltar para Detalhes</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
