<?php

namespace App\Http\Controllers\Admin;

use App\Models\Brand;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;


class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::all();
        $p_categories = Category::where('parent_id',0)->orderBy('name', 'asc')->get();

        return view('admin.category.index', compact('categories','p_categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //$categories = Category::all();
        $categories = Category::where('parent_id',0)->orderBy('name', 'asc')->get();
        //$categories = Category::all();
        //dd($categories);
        //return view('admin.category.create');

        return view('admin.category.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'cat_name' => 'required|max:255',
            'sub_name' => 'required',
        ]);

        $category = new Category();
        $category->name = request('cat_name');
        $category->parent_id = request('sub_name');
        $category->description = request('description');
        $category->save();

        Session::flash('success','Category info successfully updated!');
        return redirect()->route('categories.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $categories = Category::where('parent_id','=',0)->orderBy('name', 'asc')->get();
        $category = Category::find($id);
        return view('admin.category.edit', compact('categories', 'category'));
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
        $this->validate($request, [
            'cat_name' => 'required|max:255',
            'sub_name' => 'required',
        ]);
        $category = Category::findOrfail($id);
        $category->name = request('cat_name');
        $category->parent_id = request('sub_name');
        $category->description = request('description');
        $category->save();

        Session::flash('success','Category Info Updated Successfully');
        return redirect()->route('categories.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = Category::find($id);
        $category->delete();

        Session::flash('error','Category Info Deleted Successfully');
        return redirect()->route('categories.index');
    }
}
