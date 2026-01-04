<?php

namespace App\Http\Controllers;

use App\Models\Album;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class AlbumController extends Controller
{
    // Catalog: alle ALBUMS die actief zijn
    public function catalog(Request $request)
    {
        // Filters uit de request
        $search       = $request->input('search');
        $artistFilter = $request->input('artists'); // naam komt uit jouw <select name="artists">
        $genreFilter  = $request->input('genre');
        $yearFilter   = $request->input('year');

        // Alleen actieve albums in de catalog
        $albums = Album::query()->where('is_active', true);

        // Zoeken op naam
        if ($search) {
            $albums->where('name', 'LIKE', "%{$search}%");
        }

        // Filter op artist (kolom heet 'artist' in de database)
        if ($artistFilter) {
            $albums->where('artist', $artistFilter);
        }

        // Filter op genre
        if ($genreFilter) {
            $albums->where('genre', $genreFilter);
        }

        // Filter op jaar
        if ($yearFilter) {
            $albums->where('year', $yearFilter);
        }

        // Resultaten ophalen
        $albums = $albums->get();

        // Dropdown-opties (alias 'artist as artists' zodat jouw Blade $artist->artists werkt)
        $artistOptions = Album::select('artist as artists')->distinct()->get();
        $genreOptions  = Album::select('genre')->distinct()->get();
        $yearOptions   = Album::select('year')->distinct()->get();

        return view('catalog', compact('albums', 'artistOptions', 'genreOptions', 'yearOptions'));
    }

    // My Albums: alle albums van de ingelogde gebruiker (actief + niet actief)
    public function myAlbums()
    {
        $user = Auth::user();

        if (!$user) {
            // extra safety, maar route heeft al middleware('auth')
            return redirect()->route('login');
        }

        $albums = Album::where('user_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->get();

        return view('my_albums', compact('albums'));
    }

    // Eén album tonen
    public function show($id)
    {
        $album = Album::findOrFail($id);
        return view('show', compact('album'));
    }

    // Form om een nieuw album toe te voegen (alleen admin)
    public function create()
    {
        if (!Auth::user() || Auth::user()->role !== 'admin') {
            return redirect()
                ->route('music.catalog')
                ->withErrors(['error' => 'You do not have permission to add a new album.']);
        }

        return view('albums.create');
    }

    // Opslaan van nieuw album
    public function store(Request $request)
    {
        $request->validate([
            'name'   => 'required|string|max:255',
            'artist' => 'required|string|max:255',
            'genre'  => 'required|string',
            'year'   => 'required|integer',
            'image'  => 'image|nullable|max:1999',
        ]);

        $albumData = [
            'name'      => $request->input('name'),
            'artist'    => $request->input('artist'),
            'genre'     => $request->input('genre'),
            'year'      => $request->input('year'),
            'user_id'   => Auth::id(),
            'is_active' => true,
        ];

        if ($request->hasFile('image')) {
            $albumData['image'] = $request->file('image')->store('images', 'public');
        }

        $album = Album::create($albumData);

        Log::info('New album added by user ID: ' . Auth::id(), ['album_id' => $album->id]);

        return redirect()
            ->route('music.catalog')
            ->with('success', 'Album successfully added.');
    }

    // Edit-form voor één album
    public function edit($id)
    {
        $album = Album::findOrFail($id);

        // Alleen eigenaar of admin mag bewerken
        if ($album->user_id !== Auth::id() && Auth::user()->role !== 'admin') {
            return redirect()
                ->route('music.catalog')
                ->withErrors(['error' => 'You do not have permission to edit this album.']);
        }

        return view('edit_album', compact('album'));
    }

    // Update album
    public function update(Request $request, $id)
    {
        $album = Album::findOrFail($id);

        // Alleen eigenaar of admin mag updaten
        if ($album->user_id !== Auth::id() && Auth::user()->role !== 'admin') {
            return redirect()
                ->route('music.catalog')
                ->withErrors(['error' => 'You do not have permission to update this album.']);
        }

        $request->validate([
            'name'   => 'required|string|max:255',
            'artist' => 'required|string|max:255',
            'genre'  => 'required|string',
            'year'   => 'required|integer',
            'image'  => 'image|nullable|max:1999',
        ]);

        $albumData = $request->only('name', 'artist', 'genre', 'year');

        if ($request->hasFile('image')) {
            if ($album->image) {
                Storage::disk('public')->delete($album->image);
            }
            $albumData['image'] = $request->file('image')->store('images', 'public');
        }

        $album->update($albumData);

        Log::info('Album updated by user ID: ' . Auth::id(), ['album_id' => $album->id]);

        return redirect()
            ->route('music.catalog')
            ->with('success', 'Album successfully updated.');
    }

    // Verwijder album
    public function destroy($id)
    {
        $album = Album::findOrFail($id);

        // Alleen eigenaar of admin mag verwijderen
        if ($album->user_id !== Auth::id() && Auth::user()->role !== 'admin') {
            return redirect()
                ->route('music.catalog')
                ->withErrors(['error' => 'You do not have permission to delete this album.']);
        }

        // Minimaal 3 albums regel
        $albumCount = Album::where('user_id', Auth::id())->count();
        if ($albumCount <= 3) {
            return redirect()
                ->route('music.catalog')
                ->withErrors(['error' => 'You must have added at least 3 albums before you can delete one.']);
        }

        if ($album->image) {
            Storage::disk('public')->delete($album->image);
        }

        $album->delete();

        Log::info('Album deleted by user ID: ' . Auth::id(), ['album_id' => $album->id]);

        return redirect()
            ->route('music.catalog')
            ->with('success', 'Album successfully deleted.');
    }

    // Toggle actief / niet-actief
    public function toggleStatus($id)
    {
        $album = Album::findOrFail($id);

        // Alleen eigenaar of admin mag status togglen
        if ($album->user_id !== Auth::id() && Auth::user()->role !== 'admin') {
            return redirect()
                ->back()
                ->withErrors(['error' => 'You do not have permission to change the status of this album.']);
        }

        $album->is_active = !$album->is_active;
        $album->save();

        Log::info('Status of album changed by user ID: ' . Auth::id(), [
            'album_id'   => $album->id,
            'is_active'  => $album->is_active,
        ]);

        return redirect()
            ->back()
            ->with('success', 'Album status successfully updated.');
    }
}
