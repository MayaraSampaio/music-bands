@extends('layouts.fe_master')

@section('content')
    <h1>Criar Álbum para {{ $band->name }}</h1>

    {{-- Mostrar erros de validação --}}
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('albums.store', $band) }}" enctype="multipart/form-data">

        @csrf

        {{-- Nome do álbum --}}
        <div class="mb-3">
            <label class="form-label">Nome do álbum</label>
            <input
                type="text"
                name="name"
                class="form-control"
                value="{{ old('name') }}"
                required>
        </div>

        {{-- Data de lançamento --}}
        <div class="mb-3">
            <label class="form-label">Data de lançamento</label>
            <input
                type="date"
                name="released_at"
                class="form-control"
                value="{{ old('released_at') }}">

        </div>

        {{-- Imagem do álbum --}}
        <div class="mb-3">
            <label class="form-label">Imagem do álbum</label>
            <input
                type="file"
                name="image"
                class="form-control">
        </div>

        {{-- Band ID escondido (segurança extra) --}}
        <input type="hidden" name="band_id" value="{{ $band->id }}">

        <button class="btn btn-success">Criar Álbum</button>
        <a href="{{ route('bands.albums', $band) }}" class="btn btn-secondary">
            Cancelar
        </a>
    </form>
@endsection
