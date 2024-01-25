<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Route;
use App\Models\Stop;
use Illuminate\Http\Request;

class StopController extends Controller
{
    // 9	/api/stops	GET	retourne l'ensemble des arrêts gérés par la société TADAO
    public function index()
    {
        $stops = Stop::All();
        
        return response()->json($stops);
    }

    // 10	/api/stops/{id}	GET	retourne les informations relatives à l'arrêt de bus {id}
    public function show(Stop $stop)
    {
        return response()->json($stop);
    }

    // 11	/api/stops/{id}/routes	GET	retourne les lignes de bus desservant l'arrêt {id}
    public function routes(Stop $stop)
    {
        $routes = $stop->trips->unique('route_id')->pluck('route_id');
        $res = Route::whereIn('route_id', $routes)->get(); //get pour récupérer
        return response()->json($res);
    }

    // 12	/api/stops/{id1}/route/{id2}	GET	retourne les voyages (et les horaires) des bus de la ligne {id2} desservant l'arrêt {id1}
    public function route(Stop $stop, Route $route) //Pemret de dire ce qu'on rentre dans l'url sans passer par un id
    {
        //on mets des parenthèse à trips pour récupérer l'entiereté de la base de données
        //on mets pas de parenthèses à trips pour récupérer un tableau
        $route = $stop->trips()->where('route_id', "=", $route->route_id)->orderBy('arrival_time')->get();//where(là où on veut filtrer, opérateur, avec quoi on le compare)
        return response()->json($route);
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
}
