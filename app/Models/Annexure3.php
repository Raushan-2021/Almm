<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Annexure3 extends Model
{
    //
    protected $table="annexure3";
    static function getAnnexureThreeData($application_id,$user_id){
        //return self::
        return self::select('annexure3.*','master_module.module_type')
                    ->join('master_module', 'master_module.id', 'annexure3.module_type')
                    ->where('annexure3.application_id', $application_id)
                    ->where('annexure3.user_id', $user_id)
                    ->get();
    }
}
