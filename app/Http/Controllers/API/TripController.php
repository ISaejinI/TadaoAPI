<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Trip;
use Illuminate\Http\Request;
use Symfony\Component\Console\Input\Input;

class TripController extends Controller
{
    public function __construct() {
        $this->middleware('auth:sanctum')->only(['store']);
    }

    // 5	/api/trips	GET	retroune l'ensemble des voyages de la société TADAO
    public function index()
    {
        $trips = Trip::All();

        return response()->json($trips);
    }

    // 6	/api/trips/{id}	GET	retourne le voyage {id} avec l'itinéraire
    public function show(Trip $trip)
    {
        return response()->json($trip -> load(['shapes' => function($query){$query -> orderBy('shape_pt_sequence', 'asc');}]));
    }

    // 7	/api/trips/{id}/route	GET	retourne le voyage {id} ainsi que la ligne desservie par ce voyage
    public function routes(Trip $trip)
    {
        return response()->json($trip->route);
    }

    // 8	/api/trips/{id}/stops	GET	retourne le voyage {id} ainsi que les arrêts (avec les horaires) desservis par ce voyage
    public function stops(Trip $trip)
    {
        return response()->json($trip->load(["stops" => function($query)
            {
                $query -> orderBy('stop_sequence', 'asc');
            }])
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            "route_id" => "required | exists:routes,route_id",
            "trip_headsign" => "required | string",
            "shape_id" => "required | exists:shapes,shape_id",
            "data" => "required | array"
        ]);

        $data = $request->input("data");
        $nb = 1;

        $trip = Trip::create([
            "route_id" => $request->input("route_id"),
            "trip_headsign" => $request->input("trip_headsign"),
            "shape_id" => $request->input("shape_id")
        ]);

        foreach ($data as $d) {
            $trip->stops()->attach(
                $d["stop_id"],
                ["arrival_time" => $d["arrival_time"],
                "departure_time" => $d["departure_time"],
                "stop_sequence" => $nb]
            );
            $nb++;
        }

        return response()->json($trip, 201);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Trip $trip)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Trip $trip)
    {
        //
    }
}
