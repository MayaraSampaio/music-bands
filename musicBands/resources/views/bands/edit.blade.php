@extends('layouts.fe_master')

@section('content')
    <h1>Editar Banda</h1>

    <form method="POST" action="{{ route('bands.update', $band) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label class="form-label">Nome</label>
            <input name="name" class="form-control" value="{{ $band->name }}" required>
            @error('name') <p class="text-danger">{{ $message }}</p> @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Foto</label>
            <input type="file" name="photo" class="form-control">
            @error('photo') <p class="text-danger">{{ $message }}</p> @enderror

            @if($band->photo)
                <p class="mt-2">Foto atual:</p>
                <img src="{{ asset('storage/'.$band->photo) }}" style="width:120px">
            @endif
        </div>

        <button class="btn btn-primary">Guardar</button>
        <a href="{{ route('bands.index') }}" class="btn btn-secondary">Voltar</a>
    </form>
@endsection
