<?php

namespace App\Http\Controllers\Backend;


use App\Brand;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class brandController extends Controller
{
    public function index(){
        return view('backend.brand.brand');
    }
    public function brandview(){
        $brnd = Brand::orderBy('id','DESC')->get();
        return response()->json($brnd);

    }
    public function store(Request $request){
        $request->validate([
            'name' => 'required|unique:brands,name',
        ]);
        $brnd = new Brand();
        $brnd->name = $request->name;
        $brnd->save();
        return response()->json($brnd);
    }
    public function edit($id){
        $brnd = Brand::find($id);
        return response()->json($brnd);
    }
    public function update(Request $request,$id){
        $request->validate([
            'name' => 'required',
        ]);
        $brnd = Brand::find($id);
        $brnd->name = $request->name;
        $brnd->save();
        return response()->json($brnd);
    }
    public function delete ($id){
        $brnd = Brand::find($id)->delete();
        return response()->json($brnd);
    }
}
