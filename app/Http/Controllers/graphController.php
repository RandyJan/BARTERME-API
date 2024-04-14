<?php

namespace App\Http\Controllers;

use App\Models\product;
use Illuminate\Http\Request;

class graphController extends Controller
{
    public function computeCategories(){
        $furniture = count(product::select("category")->where('category', 'Furniture')->get());
       $wearables = count(product::select('category')->where('category','Wearables')->get());
       $health = count(product::select('category')->where('category','Health')->get());
       $gadgets = count(product::select('category')->where('category','Gadgets')->get());
       $appliances = count(product::select('category')->where('category','Appliances')->get());
       $vehicles = count(product::select('category')->where('category','Vechicles')->get());
       $clothes = count(product::select('category')->where('category','Clothes')->get());
       $summary = $furniture + $wearables + $health + $gadgets + $vehicles +  $clothes + $appliances;
        return response()->json([
            'furniture'=>$furniture,
            'wearables'=>$wearables,
            'gadgets'=>$gadgets,
            'health'=>$health,
            'appliances'=>$appliances,
            'vehicles'=>$vehicles,
            'clothes'=>$clothes,
            'Sum'=>$summary
        ]);
    }
 public function computeBarteredGoods(){
    $furniture = count(product::select("category")->where('category', 'Furniture')->where('isTraded',1)->get());
    $wearables = count(product::select('category')->where('category','Wearables')->where('isTraded',1)->get());
    $health = count(product::select('category')->where('category','Health')->where('isTraded',1)->get());
    $gadgets = count(product::select('category')->where('category','Gadgets')->where('isTraded',1)->get());
    $appliances = count(product::select('category')->where('category','Appliances')->where('isTraded',1)->get());
    $vehicles = count(product::select('category')->where('category','Vechicles')->where('isTraded',1)->get());
    $clothes = count(product::select('category')->where('category','Clothes')->where('isTraded',1)->get());

    return response()->json([
        'furniture'=>$furniture,
        'wearables'=>$wearables,
        'gadgets'=>$gadgets,
        'health'=>$health,
        'appliances'=>$appliances,
        'vehicles'=>$vehicles,
        'clothes'=>$clothes,
    ]);
 }
}
