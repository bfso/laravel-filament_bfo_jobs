<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Location;

class LocationController extends Controller{
    public function index()
    {
        return Location::all();
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|unique:locations,name'
        ]);

        return Location::create($data);
    }

    public function show(Location $location)
    {
        return $location;
    }

    public function update(Request $request, Location $location)
    {
        $data = $request->validate([
            'name' => 'required|string|unique:locations,name,' . $location->id
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
