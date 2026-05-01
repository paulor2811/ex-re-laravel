<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alfasoft - Gerenciamento</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background-color: #f8f9fa; }
        .avatar-img { width: 45px; height: 45px; border-radius: 50%; object-fit: cover; background: #eee; }
        .avatar-lg { width: 120px; height: 120px; }
        .avatar-initials { 
            width: 45px; height: 45px; border-radius: 50%; 
            background: #0d6efd; color: white; 
            display: inline-flex; align-items: center; justify-content: center; 
            font-weight: bold; text-transform: uppercase; 
        }
        .avatar-initials-lg { width: 120px; height: 120px; font-size: 3rem; }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary mb-4">
        <div class="container">
            <a class="navbar-brand fw-bold" href="{{ route('people.index') }}">Alfasoft</a>
            <div class="navbar-nav ms-auto">
                @auth
                    <a class="nav-link text-white" href="{{ route('reports.contacts_by_country') }}">Relatórios</a>
                    <form action="{{ route('logout') }}" method="POST" class="d-inline">
                        @csrf
                        <button type="submit" class="btn btn-link nav-link text-white border-0">Sair</button>
                    </form>
                @else
                    <a class="nav-link text-white" href="{{ route('login') }}">Entrar</a>
                @endauth
            </div>
        </div>
    </nav>

    <div class="container">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @yield('content')
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
