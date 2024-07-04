<?php

namespace App\Http\Controllers;

use App\Models\Genre;
use App\Http\Requests\Genre\StoreGenreRequest;
use App\Http\Requests\Genre\UpdateGenreRequest;

class GenreController extends Controller
{
    public function update(UpdateGenreRequest $request, $id)
    {
        $validated = $request->validated();

        $genre = Genre::findOrFail($id);
        $genre->update($validated);

        return redirect()->route('admin.index')->with('success', 'Genre updated successfully.');
    }

    public function destroy($id)
    {
        $genre = Genre::findOrFail($id);
        $genre->delete();

        return redirect()->route('admin.index')->with('success', 'Genre deleted successfully.');
    }

    public function store(StoreGenreRequest $request)
    {
        $validated = $request->validated();

        Genre::create($validated);

        return redirect()->route('admin.index')->with('success', 'Genre created successfully.');
    }
}
