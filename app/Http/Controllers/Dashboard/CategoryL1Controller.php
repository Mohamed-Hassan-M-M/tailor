<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Categoryl1;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CategoryL1Controller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Categoryl1::all();
        return view('dashboard.categorylevel1.index',compact(['categories']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = SubCategory::all();
        return view('dashboard.categorylevel1.create',compact(['categories']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        DB::beginTransaction();
        try {
            $filepath = "";
            if ($request->has('image')) {
                $filepath = saveImage('categorieslevel1', $request->image);
            }
            $id = Categoryl1::create([
                'name' => $request->name,
                'description' => $request->description,
                'sub_category_id' => $request->sub_category_id,
                'image' => $filepath,
            ]);
            DB::commit();
            return redirect()->route('categorylevel2.index')->with(['success'=>'Created Successfully.']);
        } catch (\Exception $ex) {
            DB::rollBack();
            return redirect()->route('categorylevel2.index')->with(['error' => 'Error, try again.']);
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
        $category = Categoryl1::find($id);
        $maincategories = SubCategory::all();
        return view('dashboard.categorylevel1.edit',compact(['category','maincategories']));
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
        $category = Categoryl1::find($id);
        if(!$category)
            return redirect()->route('categorylevel2.edit',$id)->with(['error' => 'Error, This Sub Category not found.']);
        DB::beginTransaction();
        try {
            $filepath = "";
            if ($request->has('image')) {
                $oldImage = $category->image;
                $filepath = saveImage('categorieslevel1', $request->image);
                $category->image = $filepath;
            }
            $category->name = $request->name;
            $category->description = $request->description;
            $category->sub_category_id = $request->sub_category_id;
            $category->save();
            if ($request->has('image')) {
                deleteImage($oldImage);
            }
            DB::commit();
            return redirect()->route('categorylevel2.index')->with(['success'=>'updated Successfully.']);
        } catch (\Exception $ex) {
            DB::rollBack();
            return redirect()->route('categorylevel2.edit',$id)->with(['error' => 'Error, try again later.']);
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
        $category = Categoryl1::find($id);
        if(!$category)
            return redirect()->route('categorylevel2.index')->with(['error' => 'Error, This Sub Category not found.']);
        $oldImage = $category->image;
        try {
            $category->delete();
            deleteImage($oldImage);
            return redirect()->route('categorylevel2.index')->with(['success'=>'Deleted Successfully.']);
        } catch (\Exception $ex) {
            return redirect()->route('categorylevel2.index')->with(['error' => 'Error, try again later.']);
        }
    }
}
