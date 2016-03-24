<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Javascript;

/**
 *@description: create autocompletion for town choices following public/database/market.json
 */
class ApiTownController extends Controller
{
  /**
   * @description: get town from sqlite db
   * @return json array
   */
  public function getTowns(Request $request)
  {
      $towns = DB::table('town')->get();
      // set charset
      $charset = "UTF-8";
      //set content type
      $type = "application/json";

      // the best return ever ;)
      return response()->json($towns)->header('Content-type', $type, 'charset', $charset);
  }
}
