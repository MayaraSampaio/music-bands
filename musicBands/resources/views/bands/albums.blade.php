@extends('layouts.fe_master')

@section('content')
    <h1>Álbuns de {{ $band->name }}</h1>

    <a href="{{ route('bands.index') }}" class="btn btn-secondary mb-3">Voltar</a>

    <table class="table table-bordered">
        <thead>
        <tr>
            <th>Imagem</th>
            <th>Nome do álbum</th>
            <th>Data de lançamento</th>
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
            </tr>
        @empty
            <tr>
                <td colspan="3">Esta banda ainda não tem álbuns.</td>
            </tr>
        @endforelse
        </tbody>
    </table>
@endsection
