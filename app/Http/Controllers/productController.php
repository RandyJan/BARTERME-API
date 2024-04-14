<?php

namespace App\Http\Controllers;

use App\Models\bundle;
use App\Models\product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

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
        'username'=>$request->username,
        'user_img'=> $request->user_img

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
            // $product = product::where('isTraded', 0)->get('username')
            // ->get('email')->get('image')->get('prod_id')
            // ->get('prod_name')->get('price')->get('desc')
            // ->get('category')->get('user_img');
          
            $product = product::where('isblock',0)->where('istraded',0)->get();

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
    public function bundle(Request $request){

        $data = json_decode($request['data'],true);
        $maxvalue = bundle::max('bundle_id');
        $bundleid = $maxvalue + 1;
        Log::info($data);

            $response = bundle::create([
                'bundle_id'=>$bundleid,
                'prod_id'=>$data['prod_id'],
                'user'=>$data['user'],
                'desc'=>$data['desc'],
                'prod_name'=>$data['prod_name'],
                'price'=>$data['price']
            ]);



        return response()->json([
            'data'=>$response
        ]);


    }
    public function getbundle(Request $request){

        // $bundle = bundle::where('user',$request->user )->select('bundle_id','user','prod_id','price','desc')->get();
        if($request->user == null || $request->user == ''){
            return response('Error user is blank');
        }
        $bundle = bundle::where('user', $request->user)->where('isblock',0)->get();

        return response()->json([
            'data'=>$bundle
        ]);
    }

    public function updatedStatus(Request $request){

        $response = product::where('prod_id', $request->prod_id)->update([
            'isTraded'=>1,
            'traded_to'=>$request->traded_to
        ]);

        return response()->json($request->all());
    }
    public function deleteProduct(Request $request){
        $result = product::where('prod_id',$request->prod_id)->delete();

        return response()->json("Product deleted successfuly");
    }
}
