<?php

use Illuminate\Database\Seeder;

class TownTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $path = "public/database/market.json";
      // get contents of file
      $json = file_get_contents($path);
      // decode json datas
      $datas = json_decode($json, TRUE);
      // get the multi json array
      $arrayFeatures = $datas["features"];
      // define a new empty array
      $arrayTown = array();
      // populate the new array with values we need
      foreach ($arrayFeatures as $feature) {
        array_push($arrayTown, $feature["properties"]["commune"]);
      }
      // get unique entry for array
      $results = array_unique($arrayTown);
      // get only vales of array after do array_unique (no index)
      $whatIReallyNeed = array_values($results);
      foreach ($results as $result) {
        DB::table('town')->insert([
            'name' => $result,
        ]);
      }
    }
}
