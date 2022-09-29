<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Annexure2 extends Model
{
    //
    protected $table="annexure2";
    static function getAnnexureTwoData($application_id,$user_id){
        //return self::
        return self::select('annexure2.*','master_module.module_type')
                    ->join('master_module', 'master_module.id', 'annexure2.module_type')
                    ->where('annexure2.application_id', $application_id)
                    ->where('annexure2.user_id', $user_id)
                    ->get();
    }
    static function getCountryData($data){
        $data = json_decode($data);
        $machine = Country::select('name')->whereIn('countrycd',$data)->get()->toArray();
        $array=array();
        foreach($machine as $mh){
            $array[] = $mh['name'];
        }
        return json_encode($array);
    }
}
