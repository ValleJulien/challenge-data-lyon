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
class ApiMarketController extends Controller
{
    protected $charset = "UTF-8";
    protected $type = "application/json";

  /**
   * @description: get town from sqlite db
   * @return json array
   */
  public function getApiMarkets(Request $request)
  {
      $markets = DB::table('market')->get();
      $marketTown = array();
      foreach ($markets as $market) {
        array_push($marketTown, $market->town);
      }

      return response()->json($markets)->header('Content-type', $type = $this->type, 'charset', $charset = $this->charset);
  }

  /**
   * @description: get info town from sqlite db
   * @return json array
   */
  public function getApiMarketsInfo(Request $request, $name)
  {
      // $town = DB::table('town')->where('name', $name)->value('name', 'created_at');

      // $marketInTown = DB::table('market')->where('town', $town)->value('name', 'created_at');

      // return response()->json($town)->header('Content-type', $type = $this->type, 'charset', $charset = $this->charset);
  }
}
