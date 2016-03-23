<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Javascript;


/**
 * @description: get market array values following json result from public/database/market.json
 */
class GeometryController extends Controller
{

  /**
   * @description: get all rows contain towns informations
   * @return json array
   */
  public function getTowns(Request $request, $town )
  {

    // set url of data grand Lyon (en local)
    $json_url = "database/market.json";

    // get contents of file
    $json = file_get_contents($json_url);

    // decode json datas
    $datas = json_decode($json, TRUE);

    // get the multi json array
    $arrayFeatures = $datas["features"];


    // define a new empty array
    $arrayTown = array();



    // populate the new array with values we need
    foreach ($arrayFeatures as $feature)
    {
      if(strtolower($town) === strtolower($feature["properties"]["commune"]))
      {

        array_push($arrayTown, array("id" => $feature["properties"]["gid"],
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
                                  )
        );
      }

    }

    $type = "application/json";
    return response()->json($arrayTown)->header('Content-type', $type);

  }

  /**
   * @description: get all markets following days choices
   * @return json array
   */
  public function getDays(Request $request, $days )
  {

    $valeurs=explode(",",$days);

    // set url of data grand Lyon (en local)
    $json_url = "database/market.json";

    // get contents of file
    $json = file_get_contents($json_url);

    // decode json datas
    $datas = json_decode($json, TRUE);

    // get the multi json array
    $arrayFeatures = $datas["features"];


    // define a new empty array
    $arrayDays = array();

    // populate the new array with values we need
    foreach ($arrayFeatures as $feature)
    {
      for($i=0;$i<count($valeurs);$i++)
      {
        if(strtolower($feature["properties"][$valeurs[$i]] != "Non"))
        {

          array_push($arrayDays, array("id" => $feature["properties"]["gid"],
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
                                    )
          );
        }
      }
    }
    $type = "application/json";

    return response()->json($arrayDays)->header('Content-type', $type);
  }
}