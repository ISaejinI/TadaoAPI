<?php

namespace Database\Seeders;

use App\Models\Route;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RouteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Route::truncate(); //réinitialise la table

        $csvFile = fopen(base_path("/data/routes.txt"), "r"); // le chemin du fichier où sont les données

        $firstline = true;
        while (($data = fgetcsv($csvFile, 2000, ",")) !== FALSE){ //les datas, le maximum que peut faire une ligne, le séparateur
            if (!$firstline) { //si firstline = false
                Route::create([
                    "route_id" => $data['0'], //le nom de la catégorie => l'emplacement dans le doc texte des datas
                    "route_short_name" => $data['1'],
                    "route_long_name" => $data['2'],
                    "route_color" => $data['6']
                ]);
            }
            $firstline = false;
        }
        fclose($csvFile);
    }
}
