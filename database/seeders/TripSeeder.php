<?php

namespace Database\Seeders;

use App\Models\Trip;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TripSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Trip::truncate();

        $csvFile = fopen(base_path("/data/trips.txt"), "r");

        $firstline = true;
        while (($data =  fgetcsv($csvFile, 2000, ",")) !== FALSE){
            if (!$firstline) {
                Trip::create([
                    "trip_id" => $data['2'],
                    "trip_headsign" => $data['3'],
                    "route_id" => $data['0'],
                    "shape_id" => $data['6']
                ]);
            }
            $firstline = false;
        }
        fclose($csvFile);
    }
}
