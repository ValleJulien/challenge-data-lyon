<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Javascript;

/**
 * @descrition: monthly update of public/database/market.json in order to be up-to-date
 */
class CronController extends Controller
{
	/**
	 * @return json response 
	 */
	public static function updateJson(Request $request)
	{
		//définition du json header response
		$type="application/json";
		$charset="utf-8";
		
		$path = 'database/market.json';

		//Dernière date de modification du fichier
		$time=filemtime($path);
		$update=date("Y-M-d",$time);

		//Dernière date de modicfication du fichier + 1 mois
		$updateMonth= date('Y-M-d',strtotime('+1 month',strtotime($update)));
		//date du jour
		$now = date('Y-M-d');

		//Si date du jour >= date de dernière modif : on remplace le fichier 
		if($now >= $updateMonth)
		{
			$data = file_get_contents('https://download.data.grandlyon.com/wfs/grandlyon?SERVICE=WFS&VERSION=2.0.0&outputformat=GEOJSON&request=GetFeature&typename=gin_nettoiement.ginmarche&SRSNAME=urn:ogc:def:crs:EPSG::4171');

			$data = mb_convert_encoding($data, 'HTML-ENTITIES');
			$res= file_put_contents($path, $data);

			$whatIReallyNeed='update ok';

			return response()->json($whatIReallyNeed)->header('Content-type', $type, 'charset', $charset);

		} else {

			$error = 'no need to update';
			return response()->json($error)->header('Content-type', $type, 'charset', $charset);
		}
	}
}