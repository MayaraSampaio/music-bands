@extends('layouts.fe_master')

@section('content')
    <h1>Bem-vindo ao Music Bands CRM</h1>

    @auth
        <p>Olá, {{ auth()->user()->name }}</p>
        <a href="{{ route('bands.index') }}" class="btn btn-success">Ver Bandas</a>
    @endauth
@endsection
