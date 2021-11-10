<?php

namespace App\Http\Controllers\Backend;


use App\Color;
use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class ColorController extends Controller
{
    public function index(){
        return view('backend.color.color');
    }
    public function colorview(){
        $color = Color::orderBy('id','DESC')->get();
        return response()->json($color);

    }
    public function store(Request $request){
        $request->validate([
            'name' => 'required|unique:colors,name',
        ]);
        $color = new Color();
        $color->name = $request->name;
        $color->save();
        return response()->json($color);
    }
    public function edit($id){
        $color = Color::find($id);
        return response()->json($color);
    }
    public function update(Request $request,$id){
        $request->validate([
            'name' => 'required',
        ]);
        $color = Color::find($id);
        $color->name = $request->name;
        $color->save();
        return response()->json($color);
    }
    public function delete ($id){
        $color = Color::find($id)->delete();
        return response()->json($color);
    }
}
