@extends('layouts.fe_master')
@section('content')
<h1>Bandas</h1>

    <table class="table table-bordered">
        <thead>
    @auth
     @if(Auth::user()->user_type == \App\Models\User::TYPE_ADMIN)
        <a href="{{ route('bands.create') }}" class="btn btn-success mb-3">+ Nova Banda</a>
     @endif
    @endauth
        <tr>
            <th>Foto</th>
            <th>Nome</th>
            <th>Nº de álbuns</th>
            <th>Ações</th>
        </tr>
        </thead>
        <tbody>
        @forelse($bands as $band)
            <tr>
                <td style="width:120px">
                    @if($band->photo)
                        <img src="{{ asset('storage/'.$band->photo) }}" style="width:100px">
                    @else
                        <span>Sem foto</span>
                    @endif
                </td>
                <td>{{ $band->name }}</td>
                <td>{{ $band->albums_count }}</td>
                <td>
                    <a class="btn btn-sm btn-primary" href="{{ route('bands.albums', $band) }}"> Ver álbuns</a>
                @auth
                    <a href="{{ route('bands.edit', $band) }}" class="btn btn-sm btn-warning">Editar</a>

                    @if(Auth::user()->user_type == \App\Models\User::TYPE_ADMIN)
                    <form action="{{ route('bands.destroy', $band) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-sm btn-danger" onclick="return confirm('Tens a certeza?')">Apagar</button>
                    </form>
                    @endif

                @endauth
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="3">Nenhuma banda cadastrada.</td>
            </tr>
        @endforelse
        </tbody>
    </table>

@endsection
