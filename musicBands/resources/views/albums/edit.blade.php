@extends('layouts.fe_master')

@section('content')
    <h1>Editar Álbum: {{ $album->name }}</h1>

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

    <form method="POST" action="{{ route('albums.update', $album) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        {{-- Nome do álbum --}}
        <div class="mb-3">
            <label class="form-label">Nome do álbum</label>
            <input
                type="text"
                name="name"
                class="form-control"
                value="{{ old('name', $album->name) }}"
                required>
        </div>

        {{-- Data de lançamento --}}
        <div class="mb-3">
            <label class="form-label">Data de lançamento</label>
            <input
                type="date"
                name="released_at"
                class="form-control"
                value="{{ old('released_at', $album->released_at) }}">
        </div>

        {{-- Imagem do álbum --}}
        <div class="mb-3">
            <label class="form-label">Imagem do álbum</label>
            <input type="file" name="image" class="form-control">

            @if($album->image)
                <p class="mt-2">Imagem atual:</p>
                <img src="{{ asset('storage/'.$album->image) }}" style="width:120px;">
            @endif
        </div>

        <button class="btn btn-primary">Guardar Alterações</button>

        <a href="{{ route('bands.albums', $album->band_id) }}" class="btn btn-secondary">
            Cancelar
        </a>
    </form>
@endsection
