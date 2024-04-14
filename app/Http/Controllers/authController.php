<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class authController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request)
    {
        $request->validate([
            'email'=>'email|required',
            'password'=>'required',
        ]);
        $credentials = request(['email', 'password']);
        if(!auth()->attempt($credentials)){
            return response()->json([
                'message'=>'The given data was invalid.',
                'data'=>[
                    'password'=>[
                        'invalid credentials'
                    ],
                ]
                ],422);
        }
        $user = User::where('email',$request->email)->first();
        if($user->isblock == 1)
        {
            return response("error", 401);
        }
        $authtoken = $user->createToken('auth-token')->plainTextToken;
        return response()->json([
            'message'=>'Login Success',
            'data'=>[
                'rating'=>number_format($user->rating,2),
                'img'=>$user->img,
                'userid'=>$user->id,
                'name'=> $user->name,
                'AccessToken'=>$authtoken,
                'isAdmin'=>$user->isAdmin]
        ],200);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {
        $request->validate([

            'email'=>'email|required',
            'password'=> 'required|min:6',
        ]);
        $user = User::create([
            'name'=>$request->name,
            'email'=>$request->email,
            'password'=>bcrypt($request->password),
            'img'=>$request->img
        ]);
        if(!$user){
            return response()->json(['message'=>'error',
        'img'=>$request->img],500);
        }
        return response()->json([
            'message'=>'Registration successful',
            'data'=>[$user]],200);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
