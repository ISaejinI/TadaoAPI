<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Route;
use App\Models\Stop;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RouteController extends Controller
{
    // 1	/api/routes	GET	retourne la liste complète des lignes de bus
    public function index()
    {
        $routes = Route::All();

        return response()->json($routes);
    }

    // 2	/api/routes/{id}	GET	retourne les informations de la route {id}
    public function show(Route $route)
    {
        return response()->json($route);
    }

    // 4	/api/routes/{id}/trips	GET	retourne les voyages associés à la route {id}
    public function trips(Route $route)
    {
        return response()->json($route->trips);
    }

    //3	/api/routes/{id}/stops	GET	retourne la liste des arrêts desservis par la ligne {id}
    public function stops(Route $route)
    {
        $trips = $route->trips()->pluck('trip_id');
        $stops = Stop::whereHas('Trips', function($query) use ($trips) {
            $query->whereIn('stop_trip.trip_id', $trips);
        })->get();
        return response()->json($stops);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Route $route)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Route $route)
    {
        //
    }
}
