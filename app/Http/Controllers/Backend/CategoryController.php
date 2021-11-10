<?php

namespace App\Http\Controllers\Backend;

use App\Category;
use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class CategoryController extends Controller
{
    public function index(){
        Session::flash('receive','Receive Data');
        return view('backend.category.viewcat');
    }
    public function categoryview(){
        $cats = Category::with('product')->orderBy('id','DESC')->get();
        /*
        $cats = DB::table('categories')
            ->leftJoin('products',function ($join){
                $join->on('categories.id','=','products.category_id');

            })
        ->select('categories.*',
            DB::raw('COUNT(products.id) as cid')
        )
            ->orderBy('id','DESC')->get();
        */

        return response()->json($cats);

    }
    public function store(Request $request){
        $request->validate([
            'name' => 'required|unique:categories,name',
        ]);
        $stu = new Category();
        $stu->name = $request->name;
        $stu->save();
        return response()->json($stu);
    }
    public function edit($id){
        $cats = Category::find($id);
        return response()->json($cats);
    }
    public function update(Request $request,$id){
        $request->validate([
            'name' => 'required',
        ]);
        $cats = Category::find($id);
        $cats->name = $request->name;
        $cats->save();
        return response()->json($cats);
    }
    public function delete ($id){
        $cats = Category::find($id)->delete();
        return response()->json($cats);
    }
}
