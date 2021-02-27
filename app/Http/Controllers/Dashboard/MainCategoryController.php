<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\MainCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MainCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = MainCategory::all();
        return view('dashboard.mainCategory.index',compact(['categories']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.mainCategory.create');
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
                $filepath = saveImage('maincategories', $request->image);
            }
            $id = MainCategory::create([
                'name' => $request->name,
                'description' => $request->description,
                'image' => $filepath,
            ]);
            DB::commit();
            return redirect()->route('main-category.index')->with(['success'=>'Created Successfully.']);
        } catch (\Exception $ex) {
            DB::rollBack();
            return redirect()->route('main-category.index')->with(['error' => 'Error, try again later.']);
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
        $category = MainCategory::find($id);
        return view('dashboard.mainCategory.edit',compact(['category']));
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
        $category = MainCategory::find($id);
        if(!$category)
            return redirect()->route('main-category.edit',$id)->with(['error' => 'Error, This Main Category not found.']);
        DB::beginTransaction();
        try {
            $filepath = "";
            if ($request->has('image')) {
                $oldImage = $category->image;
                $filepath = saveImage('maincategories', $request->image);
                $category->image = $filepath;
            }
            $category->name = $request->name;
            $category->description = $request->description;
            $category->save();
            if ($request->has('image')) {
                deleteImage($oldImage);
            }
            DB::commit();
            return redirect()->route('main-category.index')->with(['success'=>'updated Successfully.']);
        } catch (\Exception $ex) {
            DB::rollBack();
            return redirect()->route('main-category.edit',$id)->with(['error' => 'Error, try again later.']);
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
        $category = MainCategory::find($id);
        if(!$category)
            return redirect()->route('main-category.index')->with(['error' => 'Error, This Main Category not found.']);
        $oldImage = $category->image;
        try {
            $category->delete();
            deleteImage($oldImage);
            return redirect()->route('main-category.index')->with(['success'=>'Deleted Successfully.']);
        } catch (\Exception $ex) {
            return redirect()->route('main-category.index')->with(['error' => 'Error, try again later.']);
        }
    }
}
