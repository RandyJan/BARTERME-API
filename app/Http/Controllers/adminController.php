<?php

namespace App\Http\Controllers;

use App\Models\product;
use App\Models\report;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class adminController extends Controller
{
    public function blockUser(Request $request){
        $date = Carbon::now();
        $result1= User::where('email',$request->email)->update(['isblock'=>1,
            'dateofblock'=>$date]);
        $result2 = product::where('email',$request->email)->update(['isblock'=>1]);
        $result3 = report::where('email',$request->email)->update([
            'isblock'=>1
        ]);
        if($result1 && $result2 && $result3){
            return response("User successfully blocked");
        }
        return response("error occured while trying to block user");
    }
    public function getBlacklisted(){
        $result = User::select('name','email','dateofblock')->where('isblock',1)->get();

        return response()->json($result);
    }
}
