<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Route;
use App\Models\Stop;
use Illuminate\Http\Request;

class StopController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $stops = Stop::All();
        
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
     * Display the specified resource.
     */
    public function show(Stop $stop)
    {
        return response()->json($stop);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Stop $stop)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Stop $stop)
    {
        //
    }

    public function routes(Stop $stop)
    {
        $routes = $stop->trips->unique('route_id')->pluck('route_id');
        $res = Route::whereIn('route_id', $routes)->get(); //get pour récupérer
        return response()->json($res);
    }

    public function route(Stop $stop)
    {
        //12	/api/stops/{id1}/route/{id2}	GET	retourne les voyages (et les horaires) des bus de la ligne {id2} desservant l'arrêt {id1}
    }
}
