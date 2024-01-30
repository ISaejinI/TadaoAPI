<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Shape;
use Illuminate\Http\Request;

class ShapeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function addPath(Request $request)
    {
        $request->validate([
            "shape_id" => "required | max:255",
            "data" => "required | array"
        ]);

        $data = $request -> input("data");
        $nb = 1;

        foreach ($data as $d) {
            Shape::create([
                "shape_id" => $request -> input("shape_id"),
                "shape_pt_lat" => $d[0],
                "shape_pt_lon" => $d[1],
                "shape_pt_sequence" => $nb
            ]);
            $nb++;
        };

        return response()->noContent();
    }

    /**
     * Display the specified resource.
     */
    public function show(Shape $shape)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Shape $shape)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Shape $shape)
    {
        //
    }
}
