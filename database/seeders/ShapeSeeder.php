<?php

namespace Database\Seeders;

use App\Models\Shape;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ShapeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Shape::truncate(); //réinitialise la table

        $csvFile = fopen(base_path("/data/shapes.txt"), "r"); // le chemin du fichier où sont les données

        $firstline = true;
        while (($data = fgetcsv($csvFile, 2000, ",")) !== FALSE){ //les datas, le maximum que peut faire une ligne, le séparateur
            if (!$firstline) { //si firstline = false
                Shape::create([
                    "shape_id" => $data['0'], //le nom de la catégorie => l'emplacement dans le doc texte des datas
                    "shape_pt_lat" => $data['1'],
                    "shape_pt_lon" => $data['2'],
                    "shape_pt_sequence" => $data['3']
                ]);
            }
            $firstline = false;
        }
        fclose($csvFile);
    }
}
