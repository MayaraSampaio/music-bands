@extends('layouts.fe_master')

@section('headline', 'Álbuns')
@section('subtitle', $band->name)

@section('content')

<div class="card-panel mb-3 d-flex justify-content-between align-items-center">
    <div>
        <div style="color:var(--muted); font-size:14px;">Discografia</div>
        <div style="font-size:18px; font-weight:700;">{{ $band->name }}</div>
    </div>

    <div class="d-flex gap-2">
        <a href="{{ route('bands.index') }}" class="btn btn-ghost">Voltar</a>

        @auth
            @if(Auth::user()->user_type == \App\Models\User::TYPE_ADMIN)
                <a href="{{ route('albums.create', $band) }}" class="btn btn-spotify">+ Novo Álbum</a>
            @endif
        @endauth
    </div>
</div>

<div class="table-darkish">
    <table class="table table-dark table-hover align-middle mb-0">
        <thead>
            <tr>
                <th style="width:80px;">Imagem</th>
                <th>Nome do álbum</th>
                <th style="width:170px;">Lançamento</th>
                <th style="width:280px;">Ações</th>
            </tr>
        </thead>

        <tbody>
            @forelse($albums as $album)
                <tr>
                    <td>
                        @if($album->image)
                            <img class="thumb" src="{{ asset('storage/'.$album->image) }}" alt="Capa do álbum">
                        @else
                            <div class="thumb d-flex align-items-center justify-content-center" style="color:var(--muted);">
                                —
                            </div>
                        @endif
                    </td>

                    <td>
                        <div style="font-weight:700;">{{ $album->name }}</div>
                        <div style="color:var(--muted); font-size:13px;">
                            {{ $band->name }}
                        </div>
                    </td>

                    <td style="color:var(--muted);">
                        {{ $album->released_at ? \Carbon\Carbon::parse($album->released_at)->format('d/m/Y') : '-' }}
                    </td>

                    <td>
                        @auth
                            <a href="{{ route('albums.edit', $album) }}" class="btn btn-ghost btn-sm">
                                Editar
                            </a>

                            @if(Auth::user()->user_type == \App\Models\User::TYPE_ADMIN)
                                <form action="{{ route('albums.destroy', $album) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-ghost btn-sm"
                                            onclick="return confirm('Tens a certeza que queres apagar este álbum?')">
                                        Apagar
                                    </button>
                                </form>
                            @endif
                        @else
                            <span style="color:var(--muted); font-size:13px;">Só visualização</span>
                        @endauth
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" style="color:var(--muted);">
                        Esta banda ainda não tem álbuns.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

@endsection
