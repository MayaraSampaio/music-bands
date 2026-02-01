<!DOCTYPE html>
<html lang="pt">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>@yield('title', 'MusicBands CRM')</title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="{{ asset('css/spotify.css') }}">
</head>

<body>
  <div class="app-shell">
    {{-- Sidebar --}}
    <aside class="sidebar">
      <div class="brand">
        <span class="brand-dot"></span>
        <span>MusicBands</span>
      </div>

      <nav class="d-grid gap-1">
        <a class="side-link {{ request()->routeIs('home') ? 'active' : '' }}" href="{{ route('home') }}">Home</a>
        <a class="side-link {{ request()->routeIs('bands.*') ? 'active' : '' }}" href="{{ route('bands.index') }}">Bandas</a>

        @auth
         

          {{-- Admin (se quiseres mostrar itens admin aqui) --}}
          @if(Auth::user()->user_type == \App\Models\User::TYPE_ADMIN)
            <a class="side-link" href="{{ route('users.add') }}">Criar Utilizador</a>
          @endif
        @else
          <a class="side-link" href="{{ route('users.add') }}">Registar</a>
          <a class="side-link" href="{{ route('login') }}">Login</a>
        @endauth
      </nav>

      <div class="mt-4">
        @auth
          <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button class="btn btn-ghost w-100" type="submit">Logout</button>
          </form>
        @endauth
      </div>
    </aside>

    {{-- Main --}}
    <main class="main">
      <div class="topbar">
        <div>
          <div style="color:var(--muted); font-size:14px;">@yield('subtitle')</div>
          <h2 style="margin:0;">@yield('headline')</h2>
        </div>

        @auth
          <div class="badge-green">Olá, {{ auth()->user()->name }}</div>
        @endauth
      </div>

      @if(session('success'))
        <div class="flash">{{ session('success') }}</div>
      @endif

      @yield('content')
    </main>
  </div>

  <script defer src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
