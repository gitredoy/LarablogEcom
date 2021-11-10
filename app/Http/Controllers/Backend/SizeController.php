<?php

namespace App\Http\Controllers\Backend;


use App\Http\Controllers\Controller;
use App\Size;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class SizeController extends Controller
{
    public function index(){
        return view('backend.size.size');
    }
    public function colorview(){
        $size = Size::orderBy('id','DESC')->get();
        return response()->json($size);

    }
    public function store(Request $request){
        $request->validate([
            'name' => 'required|unique:sizes,name',
        ]);
        $size = new Size();
        $size->name = $request->name;
        $size->save();
        return response()->json($size);
    }
    public function edit($id){
        $size = Size::find($id);
        return response()->json($size);
    }
    public function update(Request $request,$id){
        $request->validate([
            'name' => 'required',
        ]);
        $size = Size::find($id);
        $size->name = $request->name;
        $size->save();
        return response()->json($size);
    }
    public function delete ($id){
        $size = Size::find($id)->delete();
        return response()->json($size);
    }
}
