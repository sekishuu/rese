<?php

namespace App\Http\Controllers;

use App\Models\Area;
use App\Http\Requests\Area\StoreAreaRequest;
use App\Http\Requests\Area\UpdateAreaRequest;

class AreaController extends Controller
{
    public function update(UpdateAreaRequest $request, $id)
    {
        $validated = $request->validated();

        $area = Area::findOrFail($id);
        $area->update($validated);

        return redirect()->route('admin.index')->with('success', 'Area updated successfully.');
    }

    public function destroy($id)
    {
        $area = Area::findOrFail($id);
        $area->delete();

        return redirect()->route('admin.index')->with('success', 'Area deleted successfully.');
    }

    public function store(StoreAreaRequest $request)
    {
        $validated = $request->validated();

        Area::create($validated);

        return redirect()->route('admin.index')->with('success', 'Area created successfully.');
    }
}
