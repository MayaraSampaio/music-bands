<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Band;
class BandController extends Controller
{

// função para listar as bandas com a contagem de albuns
public function index()
{
    $bands = Band::withCount('albums')->get();
    return view('bands.index', compact('bands'));
}
//fução para listar os albuns de uma banda ordenados pela data de lançamento
public function albums(Band $band)
{
    $albums = $band->albums()->orderBy('released_at', 'desc')->get();
    return view('bands.albums', compact('band', 'albums'));
}
}
