<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Genre;

class GenreController extends Controller
{
    public function update(Request $request, $id)
    {
        $request->validate([
            'genre_name' => 'required|string|max:255',
        ]);

        $genre = Genre::findOrFail($id);
        $genre->update($request->all());

        return redirect()->route('admin.index')->with('success', 'Genre updated successfully.');
    }

    public function destroy($id)
    {
        $genre = Genre::findOrFail($id);
        $genre->delete();

        return redirect()->route('admin.index')->with('success', 'Genre deleted successfully.');
    }
}
