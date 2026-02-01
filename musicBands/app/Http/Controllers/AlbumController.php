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
    private const DEFAULT_ALBUM_IMAGE = 'images/default-album.png';

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
        } else {
            $data['image'] = self::DEFAULT_ALBUM_IMAGE; 
        }

        Album::create($data);

        return redirect()->route('bands.albums', $data['band_id'])
            ->with('success', 'Álbum criado com sucesso!');
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

            // apaga imagem antiga só se for do storage
            if ($album->image && !str_starts_with($album->image, 'images/')) {
                Storage::disk('public')->delete($album->image);
            }

            $data['image'] = $request->file('image')->store('albums', 'public');
        } elseif (!$album->image) {
            $data['image'] = self::DEFAULT_ALBUM_IMAGE;
        }

        $album->update($data);

        return redirect()->route('bands.albums', $album->band_id)
            ->with('success', 'Álbum atualizado com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Album $album)
    {
        if (Auth::user()->user_type != User::TYPE_ADMIN) {
            abort(403);
        }

        if ($album->image && !str_starts_with($album->image, 'images/')) {
            Storage::disk('public')->delete($album->image);
        }

        $bandId = $album->band_id;
        $album->delete();

        return redirect()->route('bands.albums', $bandId)
            ->with('success', 'Álbum apagado');
    }
}
