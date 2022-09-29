<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Annexure1 extends Model
{
    //
    protected $table="annexure1";

    static function getAnnexureData($application_id,$user_id,$sub_annexure){
        //return self::
        return self::select('annexure1.*','master_module.module_type')
                    ->join('master_module', 'master_module.id', 'annexure1.module_type')
                    ->where('annexure1.application_id', $application_id)
                    ->where('annexure1.user_id', $user_id)
                    ->where('annexure1.sub_annexure', $sub_annexure)
                    ->get();
    }
    static function getAnnexureMultipleData($application_id,$user_id,$sub_annexure){
        //return self::
        return self::select('annexure1.*','master_module.module_type')
                    ->join('master_module', 'master_module.id', 'annexure1.module_type')
                    ->where('annexure1.application_id', $application_id)
                    ->where('annexure1.user_id', $user_id)
                    ->whereIn('annexure1.sub_annexure', $sub_annexure)
                    ->get();
    }
    
}