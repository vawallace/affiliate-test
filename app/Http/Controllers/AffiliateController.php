<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Affiliate;

class AffiliateController extends Controller
{
    public function index(){
        $affiliates = Affiliate::all();
        return view('welcome')->with('affiliates', $affiliates);
    }

    public function insert(){
        $affiliateSrc = file(storage_path() . "/app/public/affiliates.txt", FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

        foreach($affiliateSrc as $aff) {
            json_encode($aff);
            $newAffiliate = json_decode($aff,true);
            
            $affiliate = new Affiliate;

            $affiliate->affiliate_name = $newAffiliate['name'];
            $affiliate->affiliate_id = $newAffiliate['affiliate_id'];
            $affiliate->latitude = $newAffiliate['latitude'];
            $affiliate->longitude = $newAffiliate['longitude'];
            
            $affiliate->save();
        }

        return to_route('affiliates');
    }

    public function filter(){
        $dist = 100;
        $lat2 = '53.3340285';
        $lon2 = '-6.2535495';
        $filtered = array();
        
        $affiliateDbSrc = Affiliate::all()->toArray();

        foreach($affiliateDbSrc as $affiliate){
            
            $radLat1 = deg2rad($affiliate['latitude']);
            $radLat2 = deg2rad($lat2);
            $radLon1 = deg2rad($affiliate['longitude']);
            $radLon2 = deg2rad($lon2);

            $spanLat = $radLat1 - $radLat2;
            $spanLon = $radLon1 - $radLon2;

            $a = sin($spanLat / 2) ** 2;
            $b = cos($radLat1);
            $c = cos($radLat2);
            $d = sin($spanLon / 2) ** 2;
            
            $distance = 2 * 6378.137 * asin(sqrt($a + $b * $c * $d));

            if($distance < $dist){
                $affiliate['distance'] = number_format($distance,2);
                $filtered[] = $affiliate;
            }
        }

        return view('filtered')->with('affiliatesFiltered', $filtered);
    }
}
