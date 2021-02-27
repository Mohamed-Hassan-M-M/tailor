<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Categoryl1;
use App\Models\Categoryl2;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CategoryL2Controller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Categoryl2::all();
        return view('dashboard.categorylevel2.index',compact(['categories']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Categoryl1::all();
        return view('dashboard.categorylevel2.create',compact(['categories']));
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
                $filepath = saveImage('categorieslevel2', $request->image);
            }
            $id = Categoryl2::create([
                'name' => $request->name,
                'description' => $request->description,
                'category_level1_id' => $request->category_level1_id,
                'image' => $filepath,
            ]);
            DB::commit();
            return redirect()->route('categorylevel3.index')->with(['success'=>'Created Successfully.']);
        } catch (\Exception $ex) {
            DB::rollBack();
            return redirect()->route('categorylevel3.index')->with(['error' => 'Error, try again.']);
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
        $category = Categoryl2::find($id);
        $maincategories = Categoryl1::all();
        return view('dashboard.categorylevel2.edit',compact(['category','maincategories']));
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
        $category = Categoryl2::find($id);
        if(!$category)
            return redirect()->route('categorylevel3.edit',$id)->with(['error' => 'Error, This Sub Category not found.']);
        DB::beginTransaction();
        try {
            $filepath = "";
            if ($request->has('image')) {
                $oldImage = $category->image;
                $filepath = saveImage('categorieslevel2', $request->image);
                $category->image = $filepath;
            }
            $category->name = $request->name;
            $category->description = $request->description;
            $category->category_level1_id = $request->category_level1_id;
            $category->save();
            if ($request->has('image')) {
                deleteImage($oldImage);
            }
            DB::commit();
            return redirect()->route('categorylevel3.index')->with(['success'=>'updated Successfully.']);
        } catch (\Exception $ex) {
            DB::rollBack();
            return redirect()->route('categorylevel3.edit',$id)->with(['error' => 'Error, try again later.']);
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
        $category = Categoryl2::find($id);
        if(!$category)
            return redirect()->route('categorylevel3.index')->with(['error' => 'Error, This Sub Category not found.']);
        $oldImage = $category->image;
        try {
            $category->delete();
            deleteImage($oldImage);
            return redirect()->route('categorylevel3.index')->with(['success'=>'Deleted Successfully.']);
        } catch (\Exception $ex) {
            return redirect()->route('categorylevel3.index')->with(['error' => 'Error, try again later.']);
        }
    }
}
