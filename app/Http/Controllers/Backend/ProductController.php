<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\{Product,Category,Brand,Color,Size,ProductColor,ProductSize,ProductSubImage};
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Intervention\Image\Facades\Image;

class ProductController extends Controller
{
    public function productview(){
        $this->data['products'] = Product::orderBy('id','DESC')->get();
        return view("backend.product.viewProduct",$this->data);
    }

    public function add(){
        $this->data['categories'] = Category::all();
        $this->data['brands'] = Brand::all();
        $this->data['colors'] = Color::all();
        $this->data['sizes'] = Size::all();
        return view("backend.product.addProduct",$this->data);
    }

    public function store(Request $request){
        $this->validate($request,[
           'category' => 'required',
           'brand' => 'required',
           'color' => 'required',
           'size' => 'required',
           'name' => ['required',Rule::unique('products')->ignore($request->id)],
           'price' => 'required',
           'short_desc' => 'required',
           'long_desc' => 'required',
           'subimages' => 'required',
           'image' => 'required',
        ]);
        $product = new Product();
        $product -> category_id = $request -> category;
        $product -> brand_id = $request -> brand;
        $product -> name = $request -> name;
        $product -> slug_name = Str::slug($request -> name,'-');
        $product -> price = $request -> price;
        $product -> short_desc = $request -> short_desc;
        $product -> long_desc = $request -> long_desc;
        if ($request->file('image')) {
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $image = 'product'.rand().'.'.$extension;
            //Image::make($file)->resize('1920','900')->save(public_path('upload/sliders/'.$image));
            Image::make($file)->resize('520','500')->save(public_path('upload/products/'.$image));
            $product-> image = $image;
        }
        $product -> save();
        if (!empty($product->id)) {
            //store multiple color
            $colorList = $request-> color;
            foreach ($colorList as $clr){
                $color = new ProductColor();
                $color -> product_id = $product->id;
                $color -> color_id = $clr;
                $color -> save();
            }

            //store multiple size
            $sizeList = $request-> size;
            foreach ($sizeList as $sz){
                $size = new ProductSize();
                $size -> product_id = $product->id;
                $size -> size_id = $sz;
                $size -> save();
            }

            //store multiple image
            $imageList = $request-> subimages;
            foreach ($imageList as $img){
                $image = new ProductSubImage();
                $image -> product_id = $product->id;
                $subFile = $img;
                $extension = $subFile->getClientOriginalExtension();
                $subImage = 'product'.rand().'.'.$extension;
                Image::make($subFile)->resize('520','500')->save(public_path('upload/products/'.$subImage));
                $image -> sub_image = $subImage;
                $image -> save();
            }
            Session::flash('message','Product Added Successfully');
            return redirect()->route('products.view');

        }else{
            Session::flash('message','Something Wrong !');
            return redirect()->back();
        }
    }
    public function edit($slug_name){
        $this->data['product']    = Product::where('slug_name',$slug_name)->first();
        $this->data['categories'] = Category::all();
        $this->data['brands']     = Brand::all();
        $this->data['colors']     = Color::all();
        $this->data['color_array']= ProductColor::where('product_id',$this->data['product']->id)
                                        ->select('color_id')->get()->toArray();
        $this->data['size_array']= ProductSize::where('product_id',$this->data['product']->id)
            ->select('size_id')->get()->toArray();
        $this->data['productImage'] = ProductSubImage::where('product_id',$this->data['product']->id)
            ->select('id','sub_image')->get();
        $this->data['sizes']      = Size::all();


        return view("backend.product.editProduct",$this->data);
    }
    public function update(Request $request,$id){
        $this->validate($request,[
            'category' => 'required',
            'brand' => 'required',
            'color' => 'required',
            'size' => 'required',
            'name' => ['required',Rule::unique('products')->ignore($id)],
            'price' => 'required',
            'short_desc' => 'required',
            'long_desc' => 'required',
        ]);
        $product = Product::find($id);
        $product -> category_id = $request -> category;
        $product -> brand_id = $request -> brand;
        $product -> name = $request -> name;
        $product -> slug_name = Str::slug($request -> name,'-');
        $product -> price = $request -> price;
        $product -> short_desc = $request -> short_desc;
        $product -> long_desc = $request -> long_desc;
        if ($request->file('image')) {
            @unlink(public_path('upload/products/'.$product-> image));
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $image = 'product'.rand().'.'.$extension;
            Image::make($file)->resize('520','500')->save(public_path('upload/products/'.$image));
            $product-> image = $image;
        }
        $product -> save();

        if (!empty($product->id)) {
            //store multiple color
            ProductColor::where('product_id',$product->id)->delete();
            $colorList = $request-> color;
            foreach ($colorList as $clr){
                $color = new ProductColor();
                $color -> product_id = $product->id;
                $color -> color_id = $clr;
                $color -> save();
            }

            //store multiple size
            ProductSize::where('product_id',$product->id)->delete();
            $sizeList = $request-> size;
            foreach ($sizeList as $sz){
                $size = new ProductSize();
                $size -> product_id = $product->id;
                $size -> size_id = $sz;
                $size -> save();
            }

            //store multiple image
            $imageList = $request-> subimages;
            if (!empty($imageList)) {
                foreach ($imageList as $img){
                    $image = new ProductSubImage();
                    $image -> product_id = $product->id;
                    $subFile = $img;
                    $extension = $subFile->getClientOriginalExtension();
                    $subImage = 'product'.rand().'.'.$extension;
                    Image::make($subFile)->resize('520','500')->save(public_path('upload/products/'.$subImage));
                    $image -> sub_image = $subImage;
                    $image -> save();
                }
            }

            Session::flash('message','Product Updated Successfully');
            return redirect()->route('products.view');

        }else{
            Session::flash('message','Something Wrong !');
            return redirect()->back();
        }

    }
    public function delete($id){
        $product= Product::where('id',$id)->first();
        @unlink(public_path('upload/products/'.$product-> image));
        $productImage = ProductSubImage::where('product_id',$product->id)->get();
        foreach ($productImage as $simg){
            @unlink(public_path('upload/products/'.$simg-> sub_image));
            $simg->delete();
        }
        $product ->delete();
        return redirect()->back();
    }
    public function showMultiple($id){
        $productImage = ProductSubImage::where('product_id',$id)
            ->select('id','sub_image')->get();
        return response()->json($productImage);
    }
    public function deleteMultiple($id){
        $productImage = ProductSubImage::find($id);
        @unlink(public_path('upload/products/'.$productImage-> sub_image));
        $productImage->delete();
        return response()->json($productImage);
    }
}
