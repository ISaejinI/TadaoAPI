<?php

namespace Database\Seeders;

use App\Models\Trip;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StopTripSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('stop_trip')->delete();

        $csvFile = fopen(base_path("/data/stop_times.txt"), "r");

        $fisrtline = true;
        while (($data = fgetcsv($csvFile, 2000, ",")) !== FALSE) {
            if (!$fisrtline) {
                $trip = Trip::find($data['0']); //On récupère dans la table trips tous les  id qui correspondent à l'indice 0 de la table actuelle
                $trip->stops()->attach($data['3'], 
                                      ["arrival_time" => $data['1'],
                                       "departure_time" => $data['2'],
                                       "stop_sequence" => $data['4']]);  
                    
            }
            $fisrtline = false;
        }
        fclose($csvFile);
    }
}
