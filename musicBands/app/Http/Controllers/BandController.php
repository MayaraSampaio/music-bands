<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Band;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use App\Models\User;


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

//manipulação de bandas (create, store, edit, update, destroy)
//Função para mostrar o formulário de criação de banda
public function create()
{
    if (Auth::user()->user_type != User::TYPE_ADMIN) {
        abort(403);
    }
    return view('bands.create');
}

public function store(Request $request)
{
    $data = $request->validate([
        'name' => 'required|string|max:255',
        'photo' => 'nullable|image|max:2048',
    ]);

    if ($request->hasFile('photo')) {
        $data['photo'] = $request->file('photo')->store('bands', 'public');
    }
    \App\Models\Band::create($data);
    return redirect()->route('bands.index')->with('success', 'Banda criada com sucesso!');
}

public function edit(\App\Models\Band $band)
{
    return view('bands.edit', compact('band'));
}

public function update(Request $request,\App\Models\Band $band)
{
    $data = $request->validate([
        'name' => 'required|string|max:255',
        'photo' => 'nullable|image|max:2048',
    ]);

    if ($request->hasFile('photo')) {
        if ($band->photo) {
            Storage::disk('public')->delete($band->photo);
        }
        $data['photo'] = $request->file('photo')->store('bands', 'public');
    }
    $band->update($data);
    return redirect()->route('bands.index')->with('success', 'Banda atualizada com sucesso!');
}
public function destroy(\App\Models\Band $band)
{
    if ($band->photo) {
        Storage::disk('public')->delete($band->photo);
    }
    $band->delete();
    return redirect()->route('bands.index')->with('success', 'Banda apagada!');
}


}
