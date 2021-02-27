<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\MainCategory;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SubCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = SubCategory::all();
        return view('dashboard.subCategory.index',compact(['categories']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = MainCategory::all();
        return view('dashboard.subCategory.create',compact(['categories']));
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
                $filepath = saveImage('subcategories', $request->image);
            }
            $id = SubCategory::create([
                'name' => $request->name,
                'description' => $request->description,
                'main_category_id' => $request->main_category_id,
                'image' => $filepath,
            ]);
            DB::commit();
            return redirect()->route('sub-category.index')->with(['success'=>'Created Successfully.']);
        } catch (\Exception $ex) {
            DB::rollBack();
            return redirect()->route('sub-category.index')->with(['error' => 'Error, try again.']);
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
        $category = SubCategory::find($id);
        $maincategories = MainCategory::all();
        return view('dashboard.subCategory.edit',compact(['category','maincategories']));
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
        $category = SubCategory::find($id);
        if(!$category)
            return redirect()->route('sub-category.edit',$id)->with(['error' => 'Error, This Sub Category not found.']);
        DB::beginTransaction();
        try {
            $filepath = "";
            if ($request->has('image')) {
                $oldImage = $category->image;
                $filepath = saveImage('subcategories', $request->image);
                $category->image = $filepath;
            }
            $category->name = $request->name;
            $category->description = $request->description;
            $category->main_category_id = $request->main_category_id;
            $category->save();
            if ($request->has('image')) {
                deleteImage($oldImage);
            }
            DB::commit();
            return redirect()->route('sub-category.index')->with(['success'=>'updated Successfully.']);
        } catch (\Exception $ex) {
            DB::rollBack();
            return redirect()->route('sub-category.edit',$id)->with(['error' => 'Error, try again later.']);
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
        $category = SubCategory::find($id);
        if(!$category)
            return redirect()->route('sub-category.index')->with(['error' => 'Error, This Sub Category not found.']);
        $oldImage = $category->image;
        try {
            $category->delete();
            deleteImage($oldImage);
            return redirect()->route('sub-category.index')->with(['success'=>'Deleted Successfully.']);
        } catch (\Exception $ex) {
            return redirect()->route('sub-category.index')->with(['error' => 'Error, try again later.']);
        }
    }
}
