<?php

namespace App\Http\Controllers;
use App\Models\Band;
use App\Models\Album;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use App\Models\User;


class AlbumController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Band $band)
    {
        $albums = $band->albums()->get();
        return view('bands.albums', compact('albums', 'band'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Band $band)
    {
     if (Auth::user()->user_type != User::TYPE_ADMIN) {
        abort(403);
    }
    return view('albums.create', compact('band'));

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $data = $request->validate([
            'name' => 'required|string|max:255',
            'released_at' => 'required|date',
            'image' => 'nullable|image|max:2048',
            'band_id' => 'required|exists:bands,id',
        ]);

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('albums', 'public');
        }

        \App\Models\Album::create($data);
        return redirect()->route('bands.albums', $data['band_id'])->with('success', 'Álbum criado com sucesso!');
    }


    public function edit(\App\Models\Album $album)
    {
        return view('albums.edit', compact('album'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, \App\Models\Album $album)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'released_at' => 'required|date',
            'image' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('image')) {
            if ($album->image) {
                Storage::disk('public')->delete($album->image);
            }
            $data['image'] = $request->file('image')->store('albums', 'public');
        }

        $album->update($data);
        return redirect()->route('bands.albums', $album->band_id)->with('success', 'Álbum atualizado com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if (Auth::user()->user_type != User::TYPE_ADMIN) {
            abort(403);
        }
        if ($album->image){
            Storage::disk('public')->delete($album->image);
        }
        $album->delete();
        return redirect()->route('bands.albums', $album->band_id)->with('success', 'Álbum apagado');
    }
}
