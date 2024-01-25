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

    public function route(Stop $stop, Route $route) //Pemret de dire ce qu'on rentre dans l'url sans passer par un id
    {
        //on mets des parenthèse à trips pour récupérer l'entiereté de la base de données
        //on mets pas de parenthèses à trips pour récupérer un tableau
        $route = $stop->trips()->where('route_id', "=", $route->route_id)->orderBy('arrival_time')->get();//where(là où on veut filtrer, opérateur, avec quoi on le compare)
        return response()->json($route);
    }
}
