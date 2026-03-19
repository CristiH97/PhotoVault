<?php

namespace App\Http\Controllers;

use App\Models\Album;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Auth;

class AlbumController extends Controller
{

    /**
     * Retrieve all albums accessible to the authenticated user.
     */
    public function getUserAlbums(){
            Gate::authorize('viewAny', Album::class);

            $user = Auth::user();

            $albums = Album::query()
            ->accessibleTo($user)
            ->withCount('photos')          
            ->orderByDesc('updated_at')->get();
            
            return response($albums);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Gate::authorize('create', Album::class);

        $fields = $request->validate([
            'title' => 'string|required',
        ]);
        $user = Auth::user();

        $album = Album::create([
            'owner_id' => $user->id,
            'title' =>$fields['title']
        ]);
        return response($album,201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Album $album)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Album $album)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Album $album)
    {
        Gate::authorize('update', $album);

        $validated = $request->validate([
            'title' => 'string|required'
        ]);

        $album->update($validated);

        return response($album,201);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Album $album)
    {
        Gate::authorize('delete', $album);

        $album->delete();
    }
}
