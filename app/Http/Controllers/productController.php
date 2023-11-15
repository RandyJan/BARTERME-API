<?php

namespace App\Http\Controllers;

use App\Models\product;
use Illuminate\Http\Request;

class productController extends Controller
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

$image = $request['image'];
// $stringimg =base64_decode($test);
// $stringimgb = base64_decode($stringimg);

// return response()->json([
//     'message'=>'base64 not decoded',
//     'data'=>$test
//     ],400);

// $img[]= base64_decode($stringimg);
// $encodedstring = base64_encode($decodedstring);
// fwrite($tempFile, $decodedstring);

 //$decodedAgain = base64_decode($decodedstring);

// $vatbinarydata = pack('H*', bin2hex($decodedAgain));

// $blobimg = fread($tempFile, filesize(stream_get_meta_data($tempFile)['uri']));


// fclose($tempFile);

// if($decodedstring == false){
//     return response()->json([
//         'message'=>'base64 not decoded',
//         'data'=>[$decodedstring]],400);
// }
// else{

    $product = product::insert([
        'email'=>$request->email,
        'prod_name'=>$request->prod_name,
        'price'=>$request->price,
        'desc'=>$request->desc,
        'category'=>$request->category,
        'image'=>$image,
        'isTraded'=>0,
        'username'=>$request->username

    ]);
    $productdb = product::get('image');
    if($product){

    // return response()->json([
    //     'message'=>'upload successful',
    //     'data'=>$productdb ],200);
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
            $product = product::where('isTraded', 0)->get();

            return response()->json(['data'=>$product],200);

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
    public function destroy(Request $request)
    {
        // $product = product::find($request->prodid);
        // $product->delete();
        $product = product::where('prod_id',$request->prodid)->delete();

        return response()->json([
            'Data'=> 'Product deleted successfully'
        ]);

    }
}
