<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Route;
use App\Models\Stop;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\DB;

class RouteController extends Controller
{
    public function __construct() {
        $this->middleware('auth:sanctum')->only(['store','update','destroy']);
    }


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
        $request->validate([
            "route_long_name" => "required | max:255",
            "route_color" => "required | between:6,6"
        ]);

        $route = Route::create(["route_long_name" => $request -> input("route_long_name"),
                               "route_short_name" => "",
                               "route_color" => $request -> input("route_color")
        ]);

        // $route->save();

        $route->update(["route_short_name" => $route -> route_id]);

        return response()->json($route,201);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Route $route)
    {
        $request->validate([
            "route_long_name" => "required | max:255",
            "route_color" => "required | between:6,6",
            "route_short_name" => "required | max:255"
        ]);

        $route->update([
            "route_long_name" => $request -> input("route_long_name"),
            "route_color" => $request -> input("route_color"),
            "route_short_name" => $request -> input("route_short_name")
        ]);

        return response()->json($route,200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Route $route)
    {
        $trips = $route->trips; //Séléction des voyages attachés à la ligne

        foreach ($trips as $t) {
            $t->stops()->detach();
            $t->delete();
        }
        
        $route->delete();
        return response()->noContent();
    }
}
