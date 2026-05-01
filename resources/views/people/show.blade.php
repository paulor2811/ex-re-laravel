@extends('layouts.app')

@section('content')
<div class="row">
    <!-- Coluna da Esquerda: Perfil -->
    <div class="col-md-4 mb-4">
        <div class="card shadow-sm text-center">
            <div class="card-body">
                @if($person->avatar)
                    <img src="{{ $person->avatar }}" class="avatar-img avatar-lg mb-3" alt="Avatar">
                @else
                    <div class="avatar-initials avatar-initials-lg mb-3">{{ mb_substr($person->name, 0, 1) }}</div>
                @endif
                <h4 class="mb-1">{{ $person->name }}</h4>
                <p class="text-muted mb-3">{{ $person->email }}</p>
                
                @auth
                    <div class="d-grid gap-2">
                        <a href="{{ route('people.edit', $person) }}" class="btn btn-warning">Editar Dados</a>
                        <form action="{{ route('people.destroy', $person) }}" method="POST">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn btn-outline-danger w-100" onclick="return confirm('Excluir?')">Excluir Pessoa</button>
                        </form>
                    </div>
                @endauth
                <hr>
                <a href="{{ route('people.index') }}" class="btn btn-link">← Voltar</a>
            </div>
        </div>
    </div>

    <!-- Coluna da Direita: Contatos -->
    <div class="col-md-8">
        <div class="card shadow-sm">
            <div class="card-header bg-white d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Contatos Associados</h5>
                @auth
                    <a href="{{ route('contacts.create', ['person_id' => $person->id]) }}" class="btn btn-sm btn-primary">+ Novo Contato</a>
                @endauth
            </div>
            <div class="card-body p-0">
                <table class="table table-hover mb-0 align-middle">
                    <thead class="table-light">
                        <tr>
                            <th class="ps-3">DDI</th>
                            <th>Número</th>
                            <th class="text-end pe-3">Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($person->contacts as $contact)
                        <tr>
                            <td class="ps-3"><span class="badge bg-info text-dark">+{{ $contact->country_code }}</span></td>
                            <td class="fw-bold">{{ $contact->number }}</td>
                            <td class="text-end pe-3">
                                <a href="{{ route('contacts.show', $contact) }}" class="btn btn-sm btn-outline-info">Ver</a>
                                @auth
                                    <a href="{{ route('contacts.edit', $contact) }}" class="btn btn-sm btn-outline-warning">Editar</a>
                                    <form action="{{ route('contacts.destroy', $contact) }}" method="POST" class="d-inline">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Excluir?')">Excluir</button>
                                    </form>
                                @endauth
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="3" class="text-center py-4 text-muted">Nenhum contato cadastrado.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
