@extends('layouts.fe_master')
@section('content')
<h1>Bandas</h1>

    <table class="table table-bordered">
        <thead>
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
