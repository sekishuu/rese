<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Area;

class AreaController extends Controller
{
    public function update(Request $request, $id)
    {
        $request->validate([
            'area_name' => 'required|string|max:255',
        ]);

        $area = Area::findOrFail($id);
        $area->update($request->all());

        return redirect()->route('admin.index')->with('success', 'Area updated successfully.');
    }

    public function destroy($id)
    {
        $area = Area::findOrFail($id);
        $area->delete();

        return redirect()->route('admin.index')->with('success', 'Area deleted successfully.');
    }

    public function store(Request $request)
    {
        $request->validate([
            'area_name' => 'required|string|max:255',
        ]);

        Area::create($request->all());

        return redirect()->route('admin.index')->with('success', 'Area created successfully.');
    }
}
