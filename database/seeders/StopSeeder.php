<?php

namespace Database\Seeders;

use App\Models\Stop;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StopSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Stop::truncate(); //réinitialise la table

        $csvFile = fopen(base_path("/data/stops.txt"), "r"); // le chemin du fichier où sont les données

        $firstline = true;
        while (($data = fgetcsv($csvFile, 2000, ",")) !== FALSE){ //les datas, le maximum que peut faire une ligne, le séparateur
            if (!$firstline) { //si firstline = false
                Stop::create([
                    "stop_id" => $data['0'], //le nom de la catégorie => l'emplacement dans le doc texte des datas
                    "stop_name" => $data['2'],
                    "stop_desc" => $data['3'],
                    "stop_lat" => $data['4'],
                    "stop_lon" => $data['5']
                ]);
            }
            $firstline = false;
        }
        fclose($csvFile);
    }
}
