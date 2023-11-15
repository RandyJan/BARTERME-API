<?php

namespace App\Http\Controllers;

use App\Models\message;
use Illuminate\Http\Request;

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
            'conv_participant_b'=>$message->email_b
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
        $response = message::all();
        if($response){
            return response()->json([

                'data'=>$response]);

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
