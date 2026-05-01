@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Pessoas Cadastradas</h2>
    @auth
        <a href="{{ route('people.create') }}" class="btn btn-primary">Nova Pessoa</a>
    @endauth
</div>

<div class="card shadow-sm">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover mb-0 align-middle">
                <thead class="table-light">
                    <tr>
                        <th class="ps-3">Avatar</th>
                        <th>Nome</th>
                        <th>E-mail</th>
                        <th>Contatos</th>
                        <th class="text-end pe-3">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($people as $person)
                    <tr>
                        <td class="ps-3">
                            @if($person->avatar)
                                <img src="{{ $person->avatar }}" class="avatar-img" alt="Avatar">
                            @else
                                <div class="avatar-initials">{{ mb_substr($person->name, 0, 1) }}</div>
                            @endif
                        </td>
                        <td class="fw-bold">{{ $person->name }}</td>
                        <td>{{ $person->email }}</td>
                        <td><span class="badge bg-secondary">{{ $person->contacts_count }}</span></td>
                        <td class="text-end pe-3">
                            <a href="{{ route('people.show', $person) }}" class="btn btn-sm btn-outline-info">Ver</a>
                            @auth
                                <a href="{{ route('people.edit', $person) }}" class="btn btn-sm btn-outline-warning">Editar</a>
                                <form action="{{ route('people.destroy', $person) }}" method="POST" class="d-inline">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Excluir?')">Excluir</button>
                                </form>
                            @endauth
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center py-4">Nenhum registro encontrado.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
