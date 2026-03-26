<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Location;
use Illuminate\Validation\Rule;

class LocationController extends Controller
{
    public function index()
    {
        return Location::all();
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|unique:locations,name'
        ]);

        return response()->json(Location::create($data), 201);
    }

    public function show(Location $location)
    {
        return $location;
    }

    public function update(Request $request, Location $location)
    {
        $data = $request->validate([
            'name' => ['required', 'string', Rule::unique('locations', 'name')->ignore($location->id)],
        ]);

        $location->update($data);

        return $location;
    }

    public function destroy(Location $location)
    {
        $location->delete();

        return response()->json(null, 204);
    }
}
