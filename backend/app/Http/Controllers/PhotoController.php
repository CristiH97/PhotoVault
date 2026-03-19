<?php

namespace App\Http\Controllers;

use App\Models\Photo;
use App\Models\Album;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class PhotoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

    }

    /**
    * Retrieve all photos from a given album with optional filtering and sorting.
     */
    public function getAllPhotosFromAlbum(Album $album, Request $request){
        Gate::authorize('view', $album);

        $query = $album->photos();

        if ($request->filled('uploader_id')) {
            $query->where('uploader_id', $request->uploader_id);
        }

        // Sort photos by creation date (default: newest first)
        $sort = $request->input('sort', 'newest');
        if ($sort === 'oldest') {
            $query->orderBy('created_at', 'asc');
        } else {
            $query->orderBy('created_at', 'desc');
        }

        $photos = $query->cursorPaginate(30);

        $response = [];

        foreach ($photos as $photo) {
            $response[] = [
                'id'            => $photo->id,
                'filename'      => $photo->filename,
                'type'          => $photo->type,
                'size'          => $photo->size,
                'uploader_name' => $photo->uploader_name,
                'url' => Storage::temporaryUrl(
                    $photo->path,
                    now()->addMinutes(5)
                ),
            ];
        }

        return response()->json([
            'data'        => $response,
            'next_cursor' => $photos->nextCursor()?->encode(),
        ]);

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
    * Store a new photo in the specified album.
    */
    public function store(Request $request, Album $album)
    {
        Gate::authorize('addPhoto', $album);

        $request->validate([
        'photo' => ['required', 'image', 'max:5120'], // 5 MB limit
        ]);

        $file = $request->file('photo');
        $user = $request->user();

        // Generate a unique filename for storage
        $extension = $file->getClientOriginalExtension();
        $filename = Str::uuid() . '.' . $extension;

         // Construct S3 key/path for storing the photo
        $key = "users/{$user->id}/albums/{$album->id}/photos/{$filename}";

        // Store the file in AWS S3
        Storage::put($key, file_get_contents($file));

        $photo = $album->photos()->create([
            'uploader_id' => $user->id,
            'uploader_name' => $user->name,
            'filename' => $filename,
            'type' => $extension,
            'size' =>$file->getSize(),
            'path' => $key, 
        ]);

        return response()->json([
        'message' => 'Photo uploaded successfully',
        'photo' => [
            'id' => $photo->id,
            'filename' => $photo->filename,
            'type' => $photo->type,
            'size' => $photo->size,
            'uploader_name' => $photo->uploader_name,
            'url' => Storage::temporaryUrl(
                $photo->path,
                now()->addMinutes(5)
            ),
        ],
    ], 201);

    }

    /**
     * Display the specified resource.
     */
    public function show(Photo $photo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Photo $photo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Photo $photo)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Photo $photo)
    {
        Gate::authorize('delete',$photo);

        Storage::delete($photo->path);
        $photo->delete();

    }
}
