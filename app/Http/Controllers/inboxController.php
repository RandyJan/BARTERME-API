<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\inbox;
use Illuminate\Http\Request;

class inboxController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {


        // $response = inbox::where('email_a', $request->email_a || $request->email_b)
        // ->where('email_b', $request->email_b || $request->email_a)
        // ->get('conv_id');
        $response = inbox::where(function ($query) use ($request) {
            $query->where('email_a', $request->email_a)
                ->orWhere('email_b', $request->email_a);
        })
        ->where(function ($query) use ($request) {
            $query->where('email_b', $request->email_b)
                ->orWhere('email_a', $request->email_b);
        })
        ->get('conv_id');
if ($response->isEmpty()) {
$response_b = inbox::insert([
'email_a' => $request->email_a,
'email_b' => $request->email_b,
'user_id' => $request->user_id,
'chatname'=>$request->chatname,
'chatnameb'=>$request->chatnameb
])->get('conv_id');

return response()->json(['data' => $response_b]);
} else {
return response()->json(['data' => $response]);
}

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $response = inbox::all();

        $imgA = [];
        $imgB = [];

        foreach ($response as $item) {
            $imgA[] = User::where('email', $item->email_a)->value('img');
            $imgB[] = User::where('email', $item->email_b)->value('img');
        }

        return response()->json([
            'data' => $response,
            'img' => [
                'img_a' => $imgA,
                'img_b' => $imgB
            ]
        ]);
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
