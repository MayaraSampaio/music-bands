@extends('layouts.fe_master')

@section('content')
    <h1>Álbuns de {{ $band->name }}</h1>

    <a href="{{ route('bands.index') }}" class="btn btn-secondary mb-3">Voltar</a>
    @auth
  @if(Auth::user()->user_type == \App\Models\User::TYPE_ADMIN)
    <a href="{{ route('albums.create', $band) }}" class="btn btn-success mb-3"> + Novo Álbum</a>
  @endif
@endauth

    <table class="table table-bordered">
        <thead>
        <tr>
            <th>Imagem</th>
            <th>Nome do álbum</th>
            <th>Data de lançamento</th>
            @auth
            <th>Ações</th>
            @endauth
        </tr>
        </thead>

        <tbody>
        @forelse($albums as $album)
            <tr>
                <td style="width:120px">
                    @if($album->image)
                        <img src="{{ asset('storage/'.$album->image) }}" style="width:100px">
                    @else
                        <span>Sem imagem</span>
                    @endif
                </td>
                <td>{{ $album->name }}</td>
                <td>{{ $album->released_at ? \Carbon\Carbon::parse($album->released_at)->format('d/m/Y') : '-' }}</td>
                <td>
    @auth
        <a href="{{ route('albums.edit', $album) }}" class="btn btn-sm btn-warning">Editar</a>

        @if(Auth::user()->user_type == \App\Models\User::TYPE_ADMIN)
            <form action="{{ route('albums.destroy', $album) }}" method="POST" style="display:inline;">
                @csrf
                @method('DELETE')
                <button class="btn btn-sm btn-danger" onclick="return confirm('Tens a certeza?')">
                    Apagar
                </button>
            </form>
        @endif
    @endauth
</td>

                </td>
            </tr>
        @empty
            <tr>
                <td colspan="4">Esta banda ainda não tem álbuns.</td>
            </tr>
        @endforelse
        </tbody>
    </table>
@endsection
