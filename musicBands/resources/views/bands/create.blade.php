@extends('layouts.fe_master')

@section('content')
    <h1>Criar Banda</h1>

    <form method="POST" action="{{ route('bands.store') }}" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label class="form-label">Nome</label>
            <input name="name" class="form-control" required>
            @error('name') <p class="text-danger">{{ $message }}</p> @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Foto</label>
            <input type="file" name="photo" class="form-control">
            @error('photo') <p class="text-danger">{{ $message }}</p> @enderror
        </div>

        <button class="btn btn-success">Criar</button>
        <a href="{{ route('bands.index') }}" class="btn btn-secondary">Voltar</a>
    </form>
@endsection
