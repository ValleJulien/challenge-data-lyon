<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Javascript;

/**
 *@description: create autocompletion for town choices following public/database/market.json
 */
class AutoCompleteController extends Controller
{
  /**
   * @description: get town array with deleting duplicate entries
   * @return json array
   */
  public function getTownAutoComplete(Request $request)
  {
    if($request->isXmlHttpRequest()) {
      // set url of data grand Lyon
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
      foreach ($arrayFeatures as $feature) {
        array_push($arrayTown, $feature["properties"]["commune"]);
      }

      // get unique entry for array
      $result = array_unique($arrayTown);
      // get only vales of array after do array_unique (no index)
      $whatIReallyNeed = array_values($result);

      // set charset
      $charset = "UTF-8";
      //set content type
      $type = "application/json";

      // the best return ever ;)
      return response()->json($whatIReallyNeed)->header('Content-type', $type, 'charset', $charset);

    } else {
        // don't dream
        echo "what do you think dude !!!";
    }
  }
}
