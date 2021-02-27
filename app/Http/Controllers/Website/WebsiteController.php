<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Categoryl1;
use App\Models\Categoryl2;
use App\Models\Image;
use App\Models\MainCategory;
use App\Models\Product;
use App\Models\ProductColor;
use Illuminate\Http\Request;

class WebsiteController extends Controller
{
    public function index(){
        $mainCategory = MainCategory::all();
        return view('website.index',compact(['mainCategory']));
    }
    public function showCategory($l1catID){
        $mainCategory = MainCategory::all();
        $targetl2Category = Categoryl2::where('category_level1_id',$l1catID)->get();
        $targetl1Category = Categoryl1::find($l1catID);
        $catIDl2 = [];
        foreach ($targetl1Category->categoryl2 as $catl2)
            $catIDl2[] = $catl2->id;
        $products = Product::whereIn('category_id',$catIDl2)->paginate(9);
        $brands = Brand::all();
        return view('website.category',compact(['mainCategory','targetl2Category','targetl1Category','brands','products']));
    }
}
