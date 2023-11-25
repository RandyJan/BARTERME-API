<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class messagingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $message = json_decode($request->getContent());
        message::insert([
            'sender'=>$message->sender,
            'message'=>$message->message,
            'conv_id'=>$message->conv_id,
            'date'=>$message->date,
            'conv_participant_a'=>$message->email_a,
            'conv_participant_b'=>$message->email_b,
            'img_a'=>$message->img_a,
            'img_b'=>$message->img_b,
            'receiver'=>$message->receiver
        ]);

        return response()->json([
            'data'=>'message sent!'
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {

        // $result = DB::table('users')
        //     ->join('conversation', 'users.email', '=', 'conversation.conv_participant_a')
        //     ->join('conversation', 'users.email', '=', 'conversation.conv_participant_b')
        //     ->select('users.*', 'conversation.*')
        //     ->get();

            // er::all();
        $response = message::where('conv_participant_a', $request->email)->orwhere('conv_participant_b', $request->email)->get();
        if($response){
            return response()->json([

                'data'=>$response,
                ]);

        }

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
