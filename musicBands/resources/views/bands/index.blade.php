@extends('layouts.fe_master')

@section('headline', 'Bandas')
@section('subtitle', 'Biblioteca')

@section('content')

<div class="card-panel mb-3 d-flex justify-content-between align-items-center">
    <div>
        <div style="color:var(--muted); font-size:14px;">Explora e gere as tuas bandas</div>
        <div style="font-size:18px; font-weight:700;">Lista de Bandas</div>
    </div>

    @auth
        @if(Auth::user()->user_type == \App\Models\User::TYPE_ADMIN)
            <a href="{{ route('bands.create') }}" class="btn btn-spotify">+ Nova Banda</a>
        @endif
    @endauth
</div>

<div class="table-darkish">
    <table class="table table-dark table-hover align-middle mb-0">
        <thead>
            <tr>
                <th style="width:80px;">Foto</th>
                <th>Nome</th>
                <th style="width:150px;">Álbuns</th>
                <th style="width:320px;">Ações</th>
            </tr>
        </thead>

        <tbody>
            @forelse($bands as $band)
                <tr>
                    <td>
                        @php
                            $src = str_starts_with($band->photo ?? '', 'images/')
                            ? asset($band->photo)               // public/images/...
                            : asset('storage/'.$band->photo);   // storage/app/public/...
                        @endphp
                        <img class="thumb" src="{{ $src }}" alt="Foto da banda">

                    </td>

                    <td>
                        <div style="font-weight:700;">{{ $band->name }}</div>
                        <div style="color:var(--muted); font-size:13px;">
                            {{ $band->albums_count }} {{ $band->albums_count == 1 ? 'álbum' : 'álbuns' }}
                        </div>
                    </td>

                    <td>
                        <span class="badge-green">{{ $band->albums_count }}</span>
                    </td>

                    <td>
                        <a href="{{ route('bands.albums', $band) }}" class="btn btn-ghost btn-sm">
                            Ver álbuns
                        </a>

                        @auth
                            <a href="{{ route('bands.edit', $band) }}" class="btn btn-ghost btn-sm">
                                Editar
                            </a>

                            @if(Auth::user()->user_type == \App\Models\User::TYPE_ADMIN)
                                <form action="{{ route('bands.destroy', $band) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-ghost btn-sm"
                                            onclick="return confirm('Tens a certeza que queres apagar esta banda?')">
                                        Apagar
                                    </button>
                                </form>
                            @endif
                        @endauth
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" style="color:var(--muted);">
                        Nenhuma banda cadastrada.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

@endsection
