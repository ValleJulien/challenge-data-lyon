<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use \Geocode;
use League\Geotools\Coordinate\Ellipsoid;
use Toin0u\Geotools\Facade\Geotools;

/**
 *@description: get the nearest market to my location 1,5 km
 */
class GeocodeController extends Controller
{
    /**
     * @description: calcul distance and returns if there is a market near
     * @return bool
     */
    function calculDistance($myLocation, $marketLocation)
    {
        $coordA   = Geotools::coordinate([$myLocation->latitude, $myLocation->longitude]);
        $coordB   = Geotools::coordinate([$marketLocation[1], $marketLocation[0]]);
        $distance = Geotools::distance()->setFrom($coordA)->setTo($coordB);

        if ($distance->in('km')->haversine() < 1.5) {
            return true;
        }
        else {
            return false;
        }
    }

    /**
     * @description: get ip and location of user
     * @return json
     */
    function geo_ip()
    {
        $ip  = !empty($_SERVER['HTTP_X_FORWARDED_FOR']) ? $_SERVER['HTTP_X_FORWARDED_FOR'] : $_SERVER['REMOTE_ADDR'];
        //$ip = '109.190.123.248'; //Set an ip to test
        $url = "http://freegeoip.net/json/{$ip}";
        $ch  = curl_init();

        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
        $data = curl_exec($ch);
        curl_close($ch);

        if ($data) {
            return json_decode($data);
        } else {
            return false;
        }
    }

    /**
     * @description: get nearest market
     * @return json
     */
    function getNearestMarket()
    {
        $myLocation = self::geo_ip();

        $json_url = "database/market.json";

        $json = file_get_contents($json_url);

        // decode json datas
        $datas = json_decode($json, TRUE);

        // get the multi json array
        $arrayFeatures = $datas["features"];

        // define a new empty array
        $arrayTown = array();

        $arr = array();

        // populate the new array with values we need
        foreach ($arrayFeatures as $feature) {
            $market[1] = $feature["geometry"]["coordinates"][0][0][1];
            $market[0] = $feature["geometry"]["coordinates"][0][0][0];
            //dd($market);
            if (self::calculDistance($myLocation, $market)) {
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
                                            //$feature["geometry"]["coordinates"][0][0]
                                            ));
            }
        }

        return utf8_encode(json_encode($arrayTown));
    }
}
