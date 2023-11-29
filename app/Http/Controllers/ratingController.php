<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\rating;
use Illuminate\Http\Request;

class ratingController extends Controller
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


        $userRated = rating::where('user', $request->user)->where('customer', $request->customer)->first();

        if(!$userRated){
            $response = rating::insert([
                'user'=>$request->user,
                'customer'=>$request->customer,
                'ratings'=>$request->ratings
            ]);
            return response()->json([
                'Thank you for your feedback!'
            ]);

    }
    else{
        return response()->json([
            'You have already rated this user '
        ]);
    }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $rating = rating::where('user',$request->user)->sum('ratings');
        $numberRating = rating::where('user',$request->user)->count();
        $userRating = $rating/$numberRating;

        User::where('email', $request->user)->update([
            'rating'=>number_format($userRating, 2)
        ]);
        return response()->json(number_format($userRating,2));

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
