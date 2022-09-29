<?php

namespace App\Utils;

use App\Traits\General;
use App\Models\Annexure1;
use App\Models\Annexure2;
use App\Models\Annexure3;
use App\Models\Annexure4;
use App\Models\Annexure5;
use App\Models\Annexure6;
use App\Models\ApplicationDetail;
//use App\Models\Consumer;


use Auth;

class ApplicationProgress
{
    use General;
    public function __construct(){}

    public function getApplicationAnnexureProgress($application_id)
    {
        $annexure1 = Annexure1::where('application_id', $application_id)->count();
        $annexure2 = Annexure2::where('application_id', $application_id)->count();
        $annexure3 = Annexure3::where('application_id', $application_id)->count();
        $annexure4 = Annexure4::where('application_id', $application_id)->count();
        $annexure5 = Annexure5::where('application_id', $application_id)->count();
        $annexure6 = Annexure6::where('application_id', $application_id)->count();
        $annexure7 = ApplicationDetail::select('annexure7')->where('id', $application_id)->first();
        $annexure8 = ApplicationDetail::select('annexure8')->where('id', $application_id)->first();
        $progress =0;$a1=$a2=$a3=$a4=$a5=$a6=$a7=$a8='false';
        if($annexure1>0){$progress+=20;$a1='true';}
        if($annexure2>0){$progress+=20;$a2='true';}
        if($annexure3>0){$progress+=16;$a3='true';}
        if($annexure4>0){$progress+=16;$a4='true';}
        if($annexure5>0){$progress+=16;$a5='true';}
        if($annexure6>0){$progress+=20;$a6='true';}
        if($annexure7->annexure7!=null){$progress+=20;$a7='true';}
        if($annexure8->annexure8!=null){$progress+=20;$a8='true';}
        $response = [
            'application_id'    =>  $application_id,
            'annexure1' => $a1,
            'annexure2' => $a2,
            'annexure3' => $a3,
            'annexure4' => $a4,
            'annexure5' => $a5,
            'annexure6' => $a6,
            'annexure7' => $a7,
            'annexure8' => $a8,
            'progress'  => $progress
        ];
        return $response;
    }
    public function getApplicationProgress($application_id)
    {
        $step1 = ApplicationDetail::select('step1')->where('id', $application_id)->first();
        $step2 = ApplicationDetail::select('step2')->where('id', $application_id)->first();
        $annexure8 = ApplicationDetail::select('annexure8')->where('id', $application_id)->first();
        $attachment = ApplicationDetail::select('attachment_uploaded')->where('id', $application_id)->first();
        $progress = 0;$a1=$a2=$a3=$a4=$a5=$a6=$a7=$a8='false';
        if($step1!=null){$progress+=18;$a1='true';}
        if($step2!=null){$progress+=18;$a2='true';}
        if($attachment!=null){$progress+=20;$a3='true';}
        if($annexure8!=null){$progress+=20;$a8='true';}
        $response = [
            'application_id'=>$application_id,
            'step1' => $a1,
            'step2' => $a2,
            'attachment' => $a3,
            'annexure4' => $a4,
            'annexure5' => $a5,
            'annexure6' => $a6,
            'annexure7' => $a7,
            'annexure8' => $a8,
            'progress'  => $progress
        ];
        return $response;
    }
    
}