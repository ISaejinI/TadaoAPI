<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Trip;
use Illuminate\Http\Request;

class TripController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    // 5	/api/trips	GET	retroune l'ensemble des voyages de la société TADAO
    public function index()
    {
        $trips = Trip::All();

        return response()->json($trips);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    // 6	/api/trips/{id}	GET	retourne le voyage {id} avec l'itinéraire
    public function show(Trip $trip)
    {
        return response()->json($trip -> load(['shapes' => function($query){$query -> orderBy('shape_pt_sequence', 'asc');}]));
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
}
