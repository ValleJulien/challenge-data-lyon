<?php

use Illuminate\Database\Seeder;

class MarketTableSeeder extends Seeder
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
      $datas = json_decode($json, 1);
      // get the multi json array
      $arrayFeatures = $datas["features"];
      // define a new empty array
      $arrayMarkets = array();
      // populate the new array with values we need
      foreach ($arrayFeatures as $feature)
      {
        array_push($arrayMarkets, array(
            "id" => $feature["properties"]["gid"],
            "name"=>$feature["properties"]["nom"],
            "town"=>$feature["properties"]["commune"],
            "size"=>$feature["properties"]["surface"],
            "longitude" => $feature["geometry"]["coordinates"][0][0][0],
            "latitude" => $feature["geometry"]["coordinates"][0][0][1],
            "monday" => $feature["properties"]["lundi"],
            "tuesday" => $feature["properties"]["mardi"],
            "wednesday" => $feature["properties"]["mercredi"],
            "thursday" => $feature["properties"]["jeudi"],
            "friday" => $feature["properties"]["vendredi"],
            "saturday" => $feature["properties"]["samedi"],
            "sunday" => $feature["properties"]["dimanche"],
            "management" => $feature["properties"]["gestionnaire"],
            "referenceId" => $feature["properties"]["identifiant"],
          )
        );
      }

      foreach ($arrayMarkets as $arrayMarket) {
        DB::table('market')->insert([
            'gid' => $arrayMarket['id'],
            'referenceId' => $arrayMarket['referenceId'],
            'size' => $arrayMarket['size'],
            'management' => $arrayMarket['management'],
            'town' => strtolower($arrayMarket['town']),
            'description' => $arrayMarket['name'],
            'xLocation' => $arrayMarket['latitude'],
            'yLocation' => $arrayMarket['longitude'],
            "monday" => $arrayMarket["monday"],
            "tuesday" => $arrayMarket["tuesday"],
            "wednesday" => $arrayMarket["wednesday"],
            "thursday" => $arrayMarket["thursday"],
            "friday" => $arrayMarket["friday"],
            "saturday" => $arrayMarket["saturday"],
            "sunday" => $arrayMarket["sunday"],
        ]);
      }
  }
}

