<?php

namespace App\Http\Controllers;

use App\Models\Album;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class AlbumController extends Controller
{
    /**
     * Catalog: alle ALBUMS die actief zijn (is_active = true)
     * met zoeken en filteren.
     */
    public function catalog(Request $request)
    {
        // Filters uit de request
        $search       = $request->input('search');
        $artistFilter = $request->input('artists');  // let op: 'artists' uit de form
        $genreFilter  = $request->input('genre');
        $yearFilter   = $request->input('year');

        // Alleen actieve albums in de catalog
        $albums = Album::query()->where('is_active', true);

        // Zoeken op naam
        if ($search) {
            $albums->where('name', 'LIKE', "%{$search}%");
        }

        // Filter op artists (kolom heet 'artists' in de database)
        if ($artistFilter) {
            $albums->where('artists', $artistFilter);
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

        // Opties voor de filter-selects
        $artistOptions = Album::select('artists')->distinct()->get();
        $genreOptions  = Album::select('genre')->distinct()->get();
        $yearOptions   = Album::select('year')->distinct()->get();

        return view('catalog', compact('albums', 'artistOptions', 'genreOptions', 'yearOptions'));
    }

    /**
     * My Albums: alle albums van de ingelogde gebruiker
     * (zowel actief als niet-actief).
     */
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

    /**
     * Eén album tonen.
     */
    public function show($id)
    {
        $album = Album::findOrFail($id);
        return view('show', compact('album'));
    }

    /**
     * Form om een nieuw album toe te voegen.
     * Iedereen die is ingelogd mag dit (route heeft middleware('auth')).
     */
    public function create()
    {
        return view('create_album'); // jouw view: resources/views/create_album.blade.php
    }

    /**
     * Nieuw album opslaan.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'    => 'required|string|max:255',
            'artists' => 'required|string|max:255', // let op: 'artists'
            'genre'   => 'required|string',
            'year'    => 'required|integer',
            'image'   => 'nullable|image|max:1999',
        ]);

        $albumData = [
            'name'      => $request->input('name'),
            'artists'   => $request->input('artists'),
            'genre'     => $request->input('genre'),
            'year'      => $request->input('year'),
            'user_id'   => Auth::id(),
            'is_active' => true,
        ];

        // Image opslaan (alleen bestandsnaam in database)
        if ($request->hasFile('image')) {
            $file     = $request->file('image');
            $filename = $file->getClientOriginalName();

            // Verplaatsen naar public/images
            $file->move(public_path('images'), $filename);

            // In database alleen de naam opslaan
            $albumData['image_path'] = $filename;
        }

        $album = Album::create($albumData);

        Log::info('New album added by user ID: ' . Auth::id(), ['album_id' => $album->id]);

        return redirect()
            ->route('music.my_albums')
            ->with('success', 'Album successfully added.');
    }

    /**
     * Edit-form voor één album.
     * Alleen eigenaar of admin mag hierbij.
     */
    public function edit($id)
    {
        $album = Album::findOrFail($id);

        // Alleen eigenaar of admin
        if ($album->user_id !== Auth::id() && Auth::user()->role !== 'admin') {
            return redirect()
                ->route('music.catalog')
                ->withErrors(['error' => 'Only the owner of the album or an admin can edit this album.']);
        }

        return view('edit_album', compact('album'));
    }

    /**
     * Album bijwerken.
     */
    public function update(Request $request, $id)
    {
        $album = Album::findOrFail($id);

        // Alleen eigenaar of admin
        if ($album->user_id !== Auth::id() && Auth::user()->role !== 'admin') {
            return redirect()
                ->route('music.catalog')
                ->withErrors(['error' => ' Only the owner of the album or an admin can update this album.']);
        }

        $request->validate([
            'name'    => 'required|string|max:255',
            'artists' => 'required|string|max:255',
            'genre'   => 'required|string',
            'year'    => 'required|integer',
            'image'   => 'nullable|image|max:1999',
        ]);

        $albumData = [
            'name'    => $request->input('name'),
            'artists' => $request->input('artists'),
            'genre'   => $request->input('genre'),
            'year'    => $request->input('year'),
        ];

        // Nieuwe image uploaden (optioneel)
        if ($request->hasFile('image')) {
            // Oude image verwijderen als die bestaat
            if ($album->image_path) {
                $oldPath = public_path('images/' . $album->image_path);
                if (file_exists($oldPath)) {
                    @unlink($oldPath);
                }
            }

            $file     = $request->file('image');
            $filename = $file->getClientOriginalName();
            $file->move(public_path('images'), $filename);

            $albumData['image_path'] = $filename;
        }

        $album->update($albumData);

        Log::info('Album updated by user ID: ' . Auth::id(), ['album_id' => $album->id]);

        return redirect()
            ->route('music.catalog')
            ->with('success', 'Album successfully updated.');
    }

    /**
     * Album verwijderen.
     * Alleen eigenaar of admin.
     * Extra eis: user moet minimaal 3 albums hebben om te mogen verwijderen.
     */
    public function destroy($id)
    {
        $album = Album::findOrFail($id);

        // Alleen eigenaar of admin
        if ($album->user_id !== Auth::id() && Auth::user()->role !== 'admin') {
            return redirect()
                ->route('music.catalog')
                ->withErrors(['error' => 'Only the owner of the album or an admin can delete this album.']);
        }

        // Minimaal 3 albums regel
        $albumCount = Album::where('user_id', Auth::id())->count();

        if ($albumCount <= 3) {
            return redirect()
                ->route('music.catalog')
                ->withErrors(['error' => 'You must have added at least 3 albums before you can delete one.']);
        }

        // Image verwijderen als die bestaat
        if ($album->image_path) {
            $oldPath = public_path('images/' . $album->image_path);
            if (file_exists($oldPath)) {
                @unlink($oldPath);
            }
        }

        $album->delete();

        Log::info('Album deleted by user ID: ' . Auth::id(), ['album_id' => $album->id]);

        return redirect()
            ->route('music.catalog')
            ->with('success', 'Album successfully deleted.');
    }

    /**
     * Toggle actief / niet-actief.
     * Alleen eigenaar of admin.
     */
    public function toggleStatus($id)
    {
        $album = Album::findOrFail($id);

        // Alleen eigenaar of admin
        if ($album->user_id !== Auth::id() && Auth::user()->role !== 'admin') {
            return redirect()
                ->back()
                ->withErrors(['error' => 'You do not have permission to change the status of this album.']);
        }

        $album->is_active = !$album->is_active;
        $album->save();

        Log::info('Status of album changed by user ID: ' . Auth::id(), [
            'album_id'  => $album->id,
            'is_active' => $album->is_active,
        ]);

        return redirect()
            ->back()
            ->with('success', 'Album status successfully updated.');
    }
}
