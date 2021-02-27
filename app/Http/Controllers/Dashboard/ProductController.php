<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Categoryl2;
use App\Models\Color;
use App\Models\Image;
use App\Models\Product;
use App\Models\ProductColor;
use App\Models\ProductColorSize;
use App\Models\Size;
use BaconQrCode\Encoder\QrCode;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::all();
        //return $products[0]->barcode;
        return view('dashboard.product.index',compact(['products']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $brands = Brand::all();
        $sizes = Size::all();
        $colors = Color::all();
        $categories = Categoryl2::all();
        return view('dashboard.product.create',compact(['brands','sizes','colors','categories']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $count=[];
        foreach ($request->input('count') as $index => $counts)
        {
            for($i=0;$i<count($counts);$i++){
                if($counts[$i] != null)
                {
                    $count[$index][] = $counts[$i];
                }
            }
        }
        DB::beginTransaction();
        try {
            $productID = Product::insertGetId([
                'name' => $request->name,
                'description' => $request->description,
                'price' => $request->price,
                'discount' => $request->discount,
                'barcode' => 'notyet',
                'brand_id' => $request->brand_id,
                'category_id' => $request->category_id
            ]);
            Product::where('id', $productID)->update([
                'barcode' => \QrCode::size(100)->generate(asset('product/' . $productID))
            ]);
            for ($i = 0; $i<count($request->color_id); $i++)
            {
                $product_colorIDs= ProductColor::insertGetId([
                    'product_id' => $productID,
                    'color_id' => (int)$request->color_id[$i]
                ]);
                for ($l = 0; $l<count($request->image); $l++)
                {
                    $filepath = saveImage('products', $request->image[$i][$l]);
                    Image::create([
                        'name' => $filepath,
                        'product_color_id' => $product_colorIDs
                    ]);
                }
                for ($s = 0; $s<count($request->size); $s++)
                {
                    ProductColorSize::create([
                        'size_id' => (int)$request->size[$i][$s],
                        'product_color_id' => $product_colorIDs,
                        'count' => $count[$i][$s]
                    ]);
                }
            }
            DB::commit();
            return redirect()->route('product.index')->with(['success'=>'Created Successfully.']);
        } catch (\Exception $ex) {
            DB::rollBack();
            return redirect()->route('product.index')->with(['error' => 'Error, try again later.']);
        }
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
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = Product::find($id);
        $product_colors = ProductColor::where('product_id', $product->id)->get();
        $product_colorarray = ProductColor::where('product_id', $product->id)->pluck('id');
        $product_sizes = ProductColorSize::whereIn('product_color_id', $product_colorarray)->get();
        $product_images = Image::where('product_color_id', $product_colorarray)->get();
        $brands = Brand::all();
        $sizes = Size::all();
        $colors = Color::all();
        $categories = Categoryl2::all();
        return view('dashboard.product.edit',compact(['brands','sizes','colors','categories','product','product_colors','product_colorarray','product_sizes','product_images']));
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
        $count=[];
        foreach ($request->input('count') as $index => $counts)
        {
            for($i=0;$i<count($counts);$i++){
                if($counts[$i] != null)
                {
                    $count[$index][] = $counts[$i];
                }
            }
        }

        DB::beginTransaction();
        try {
            $productID = Product::where('id',$id)->update([
                'name' => $request->name,
                'description' => $request->description,
                'price' => $request->price,
                'discount' => $request->discount,
                'brand_id' => $request->brand_id,
                'category_id' => $request->category_id
            ]);
            $product_colorarray = ProductColor::where('product_id', $id)->pluck('id');
            ProductColorSize::whereIn('product_color_id',array_values((array)$product_colorarray)[0])->delete();
            for ($i = 0; $i<$product_colorarray->count(); $i++)
            {
                for ($s = 0; $s<count($request->size); $s++)
                {
                    ProductColorSize::create([
                        'size_id' => (int)$request->size[$i][$s],
                        'product_color_id' => $product_colorarray[$i],
                        'count' => $count[$i][$s]
                    ]);
                }
            }
            DB::commit();
            return redirect()->route('product.index')->with(['success'=>'Created Successfully.']);
        } catch (\Exception $ex) {
            DB::rollBack();
            return redirect()->route('product.index')->with(['error' => 'Error, try again later.']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::find($id);
        if(!$product)
            return redirect()->route('product.index')->with(['error' => 'Error, This product not found.']);
        DB::beginTransaction();
        try {
            $product_colors = ProductColor::where('product_id', $id)->pluck('id');
            $images = Image::whereIn('product_color_id',array_values((array)$product_colors)[0])->get();
            foreach ($images as $img)
                deleteImage($img->name);
            Image::whereIn('product_color_id',array_values((array)$product_colors)[0])->delete();
            ProductColorSize::whereIn('product_color_id',array_values((array)$product_colors)[0])->delete();
            ProductColor::where('product_id', $id)->delete();
            $product->delete();
            DB::commit();
            return redirect()->route('product.index')->with(['success'=>'Deleted Successfully.']);
        } catch (\Exception $ex) {
            DB::rollBack();
            return redirect()->route('product.index')->with(['error' => 'Error, try again later.']);
        }
    }
}
