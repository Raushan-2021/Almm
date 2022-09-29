<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use DB,Auth;
use App\Traits\General;
use App\Models\Annexure1;

class ApplicationDetail extends Model
{
    //
    use General;
    protected $table="application_details";
    public static function getUserApplications($user_id){
        return self::select('application_details.application_no','application_details.application_type','application_details.manufacturer_name',
        'application_details.id','application_details.final_submission',
                    'manufaturer_users.name', 'manufaturer_users.email','manufaturer_users.phone','application_details.register_office_address',
                    'application_details.register_office_phone','application_details.register_office_email','application_details.updated_at',
                    'application_details.forward_status')
                    ->join('manufaturer_users', 'manufaturer_users.id', 'application_details.user_id')
                    ->where('manufaturer_users.id', $user_id)
                    ->get();
    }
    public static function getAttachmentName($file_name,$application_id){
        return self::select($file_name)->where('id',$application_id)->first();
    }
    
    public static function replicateAnnexures($application_id,$new_inserted_id){
        date_default_timezone_set('Asia/Kolkata');
        $getCurrentDate= date('Y-m-d H:i:s');
        $annexure1 = Annexure1::where('application_id',$application_id)->get();
        foreach($annexure1 as $a1_data){
            $new_annexure1_details = Annexure1::find($a1_data->id);
            //dd($new_annexure1_details);
            $new_annexure1_details = $a1_data->replicate();
            $new_annexure1_details->application_id = $new_inserted_id;
            $new_annexure1_details->created_at = $getCurrentDate;
            $new_annexure1_details->updated_at = $getCurrentDate;
            $new_annexure1_details->save();
        }

        date_default_timezone_set('Asia/Kolkata');
        $getCurrentDate= date('Y-m-d H:i:s');
        $annexure2 = Annexure2::where('application_id',$application_id)->get();
        foreach($annexure2 as $a2_data){
            $new_annexure2_details = Annexure2::find($a2_data->id);
            //dd($new_annexure2_details);
            $new_annexure2_details = $a2_data->replicate();
            $new_annexure2_details->application_id = $new_inserted_id;
            $new_annexure2_details->created_at = $getCurrentDate;
            $new_annexure2_details->updated_at = $getCurrentDate;
            $new_annexure2_details->save();
        }

        date_default_timezone_set('Asia/Kolkata');
        $getCurrentDate= date('Y-m-d H:i:s');
        $annexure3 = Annexure3::where('application_id',$application_id)->get();
        foreach($annexure3 as $a3_data){
            $new_annexure3_details = Annexure3::find($a3_data->id);
            //dd($new_annexure3_details);
            $new_annexure3_details = $a3_data->replicate();
            $new_annexure3_details->application_id = $new_inserted_id;
            $new_annexure3_details->created_at = $getCurrentDate;
            $new_annexure3_details->updated_at = $getCurrentDate;
            $new_annexure3_details->save();
        }

        date_default_timezone_set('Asia/Kolkata');
        $getCurrentDate= date('Y-m-d H:i:s');
        $annexure4 = Annexure4::where('application_id',$application_id)->get();
        foreach($annexure4 as $a4_data){
            $new_annexure4_details = Annexure4::find($a4_data->id);
            //dd($new_annexure4_details);
            $new_annexure4_details = $a4_data->replicate();
            $new_annexure4_details->application_id = $new_inserted_id;
            $new_annexure4_details->created_at = $getCurrentDate;
            $new_annexure4_details->updated_at = $getCurrentDate;
            $new_annexure4_details->save();
        }

        date_default_timezone_set('Asia/Kolkata');
        $getCurrentDate= date('Y-m-d H:i:s');
        $annexure5 = Annexure5::where('application_id',$application_id)->get();
        foreach($annexure5 as $a5_data){
            $new_annexure5_details = Annexure5::find($a5_data->id);
            //dd($new_annexure5_details);
            $new_annexure5_details = $a5_data->replicate();
            $new_annexure5_details->application_id = $new_inserted_id;
            $new_annexure5_details->created_at = $getCurrentDate;
            $new_annexure5_details->updated_at = $getCurrentDate;
            $new_annexure5_details->save();
        }
        
        date_default_timezone_set('Asia/Kolkata');
        $getCurrentDate= date('Y-m-d H:i:s');
        $annexure6 = Annexure6::where('application_id',$application_id)->get();
        foreach($annexure6 as $a6_data){
            $new_annexure6_details = Annexure6::find($a6_data->id);
            //dd($new_annexure6_details);
            $new_annexure6_details = $a6_data->replicate();
            $new_annexure6_details->application_id = $new_inserted_id;
            $new_annexure6_details->created_at = $getCurrentDate;
            $new_annexure6_details->updated_at = $getCurrentDate;
            $new_annexure6_details->save();
        }
    }
    
    public static function getAnnexureByApplicationID($id,$user_id=NULL){
        if($user_id==NULL){
            $user_id=Auth::user()->id;
        }
        $dataAry=array();
        $dataAry['applicationDetail'] = ApplicationDetail::where('id', base64_decode($id))->first()->toArray();
        $dataAry['applied_pvmodels'] = AppliedPvmodel::where('application_id', $dataAry['applicationDetail']['id'])->where('user_id', $dataAry['applicationDetail']['user_id'])->get();
        $dataAry['annexure6'] = Annexure6::where('application_id', $dataAry['applicationDetail']['id'])->where('user_id', $dataAry['applicationDetail']['user_id'])->get();
        $dataAry['annexure1'] = Annexure1::getAnnexureData($dataAry['applicationDetail']['id'],$dataAry['applicationDetail']['user_id'],1);         
        $dataAry['annexure1_sub2'] = Annexure1::where('application_id',$dataAry['applicationDetail']['id'])->where('user_id',$dataAry['applicationDetail']['user_id'])->where('sub_annexure',2)->get();
        $dataAry['annexure1_sub3'] = Annexure1::where('application_id',$dataAry['applicationDetail']['id'])->where('user_id',$dataAry['applicationDetail']['user_id'])->where('sub_annexure',3)->get();
        $dataAry['annexure1_sub4'] = Annexure1::where('application_id',$dataAry['applicationDetail']['id'])->where('user_id',$dataAry['applicationDetail']['user_id'])->where('sub_annexure',4)->get();
        $dataAry['annexure1_sub5'] = Annexure1::where('application_id',$dataAry['applicationDetail']['id'])->where('user_id',$dataAry['applicationDetail']['user_id'])->where('sub_annexure',5)->get();
        $dataAry['annexure1_sub6'] = Annexure1::where('application_id',$dataAry['applicationDetail']['id'])->where('user_id',$dataAry['applicationDetail']['user_id'])->where('sub_annexure',6)->get();
        $dataAry['annexure2'] = Annexure2::getAnnexureTwoData($dataAry['applicationDetail']['id'],$user_id);
        $annexure2_aryData=array(); $i=0;
        foreach($dataAry['annexure2'] as $dt){$i++;
            $bill_material_id_array=array();
            $annexure2_aryData[$i]=$dt;
            $bill_material_id = json_decode($dt['bill_material_id']);
            foreach($bill_material_id as $bill){
                $bill_material_id_array[] = BillMaterial::getBillMaterialTitle($bill)->bill_title;
            }
            $annexure2_aryData[$i]['bill_material_id']=json_encode($bill_material_id_array);
        } 
        $dataAry['annexure2_aryData']=$annexure2_aryData;
        //$annexure3=array();
        $dataAry['annexure3'] = Annexure3::getAnnexureThreeData($dataAry['applicationDetail']['id'],$user_id);
        $dataAry['annexure4'] = Annexure4::getAnnexureFourData($dataAry['applicationDetail']['id'],$user_id,2);
        $dataAry['annexure4_sub3'] = Annexure4::getAnnexureFourData($dataAry['applicationDetail']['id'],$user_id,3);
        $dataAry['annexure4_sub4'] = Annexure4::where('application_id',$dataAry['applicationDetail']['id'])->where('user_id',$user_id)->where('sub_annexure',4)->orderby('module_type','ASC')->get();
        $dataAry['annexure4_sub5'] = Annexure4::getAnnexureFourData($dataAry['applicationDetail']['id'],$user_id,5);
        // Vivek
        $startYear = date("Y")+1;
        $prevYear = date("Y");
        $current_financial_year = $prevYear."-".$startYear;
        $dataAry['annexure5_appData'] = Annexure5::where('application_id',$dataAry['applicationDetail']['id'])->where('user_id',$dataAry['applicationDetail']['user_id'])->where('financial_year',$current_financial_year)->get();

        $startYear = date("Y");
        $prevYear = date("Y")-1;
        $last_financial_year = $prevYear."-".$startYear;
        $dataAry['annexure5_lfyappData'] = Annexure5::where('application_id',$dataAry['applicationDetail']['id'])->where('user_id',$dataAry['applicationDetail']['user_id'])->where('financial_year',$last_financial_year)->get();

        $startYear = date("Y")-1;
        $prevYear = date("Y")-2;
        $lasttolast_financial_year = $prevYear."-".$startYear;
        $dataAry['annexure5_ltlfyappData'] = Annexure5::where('application_id',$dataAry['applicationDetail']['id'])->where('user_id',$dataAry['applicationDetail']['user_id'])->where('financial_year',$lasttolast_financial_year)->get();
        //Vivek
        return $dataAry;


    }
    
}