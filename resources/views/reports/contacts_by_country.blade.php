@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-7">
        <div class="card shadow-sm">
            <div class="card-header bg-white d-flex justify-content-between align-items-center py-3">
                <h4 class="mb-0">Contatos por País</h4>
                <a href="{{ route('people.index') }}" class="btn btn-sm btn-outline-secondary">Voltar</a>
            </div>
            <div class="card-body p-0">
                <table class="table table-hover mb-0 align-middle">
                    <thead class="table-light">
                        <tr>
                            <th class="ps-3">Código do País (DDI)</th>
                            <th class="text-end pe-3">Total de Contatos</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($report as $item)
                        <tr>
                            <td class="ps-3">
                                <span class="badge bg-primary fs-6">+{{ $item->country_code }}</span>
                            </td>
                            <td class="text-end pe-3 fs-5 fw-bold text-primary">
                                {{ $item->total }}
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="2" class="text-center py-5 text-muted">Ainda não há contatos cadastrados.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
