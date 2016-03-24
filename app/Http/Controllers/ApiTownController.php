<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Javascript;

/**
 * @author : dev_julien, j.valle.julien[at]gmail.com
 * @description: create autocompletion for town choices following public/database/market.json
 */
class ApiTownController extends Controller
{
    protected $charset = "UTF-8";
    protected $type = "application/json";

  /**
   * @description: get town from sqlite db
   * @return json array
   */
  public function getApiTowns(Request $request)
  {
      $towns = DB::table('town')->get();
      $townName = array();
      foreach ($towns as $town) {
        array_push($townName, $town->name);
      }

      return response()->json($townName)->header('Content-type', $type = $this->type, 'charset', $charset = $this->charset);
  }

  /**
   * @description: get info town from sqlite db
   * @return json array
   */
  public function getApiTownsInfo(Request $request, $name)
  {
      $town = DB::table('town')->where('name', $name)->value('name', 'created_at');

      $marketInTown = DB::table('market')->where('town', $town)->value('name', 'created_at');

      return response()->json($town)->header('Content-type', $type = $this->type, 'charset', $charset = $this->charset);
  }

  /**
   * @description: get info town from sqlite db
   * @return json array
   */
  public function getApiMarketsByTown(Request $request, $name)
  {
      $town = DB::table('town')->where('name', $name)->value('name', 'created_at');

      $marketsInTown = DB::table('market')->where('town', $town)->value('id');
      dump(count($marketsInTown));
      dump($marketsInTown);

      return response()->json($marketsInTown)->header('Content-type', $type = $this->type, 'charset', $charset = $this->charset);
  }
}
