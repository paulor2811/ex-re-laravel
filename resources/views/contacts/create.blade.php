@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-5">
        <div class="card shadow-sm">
            <div class="card-body">
                <h4 class="mb-1">Novo Contato</h4>
                <p class="text-muted small mb-4">Para: {{ $person->name }}</p>

                <form action="{{ route('contacts.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="person_id" value="{{ $person->id }}">
                    
                    <div class="mb-3">
                        <label for="country_select" class="form-label">País</label>
                        <select id="country_select" name="country_code" class="form-select @error('country_code') is-invalid @enderror" required>
                            <option value="">Carregando países...</option>
                        </select>
                        @error('country_code') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="mb-3">
                        <label for="number" class="form-label">Número (9 dígitos)</label>
                        <input type="text" name="number" id="number" class="form-control @error('number') is-invalid @enderror" maxlength="9" placeholder="Ex: 999000111" required>
                        @error('number') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="d-grid gap-2 mt-4">
                        <button type="submit" class="btn btn-primary">Salvar Contato</button>
                        <a href="{{ route('people.show', $person) }}" class="btn btn-outline-secondary">Cancelar</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const select = document.getElementById('country_select');
        fetch('https://restcountries.com/v3.1/all?fields=name,idd')
            .then(res => res.json())
            .then(data => {
                select.innerHTML = '<option value="">Selecione um país</option>';
                data.sort((a, b) => a.name.common.localeCompare(b.name.common));
                data.forEach(c => {
                    if (c.idd.root) {
                        const code = c.idd.root.replace('+', '') + (c.idd.suffixes ? c.idd.suffixes[0] : '');
                        const opt = document.createElement('option');
                        opt.value = code;
                        opt.textContent = `${c.name.common} (+${code})`;
                        select.appendChild(opt);
                    }
                });
            });
    });
</script>
@endsection
