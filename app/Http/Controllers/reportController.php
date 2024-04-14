<?php

namespace App\Http\Controllers;

use App\Models\report;
use App\Models\User;
use Illuminate\Http\Request;

class reportController extends Controller
{
    public function sendReport(Request $request){

        $result = report::insert([
            'email'=>$request->email,
            'img1'=>$request->img1,
            'img2'=>$request->img2,
            'reported'=>$request->reported,
            'report_note'=> $request->report_note
        ]);
        User::where('email',$request->reported)->update(['isReported'=>1]);
        // return $request->all();
        if($result){
            return response("User successfully reported");
        }
        return response("Error Occured while reporting, please try again");
    }
    public function getReports(){
        $result = report::where('isblock',0)->get();
        $reported = User::select('name','email')->where('isReported',1)->where('isblock',0)->get();
        if($result == '[]' || $result == null || empty($result)){
            return response("No report data",401);
        }
        return response()->json(['reported' =>$reported,
                                    'reports'=>$result]);
    }

}
