<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\URL;

class AdminController extends Controller
{
    public function admin(){
        $data = Product::all();
        return view("admin_element.product",compact("data"));
    }

    public function add(){
        return view("admin_element.add");
    }
    public function add_create(Request $request){
        $inputs   = $request->all();
        $time     = strtotime(date('Y-m-d H:i:s'));
        $fileType = $request->product_image->extension();
        $fileName = $time . '.' . $fileType;
        $request->product_image->move(public_path('files/products'), $fileName);
        $inputs['product_image'] = URL::to('/files/products/'.$fileName);
        $data = new Product();
        $data->fill($inputs);
        $data->save();
        return redirect('/admin/product');
    }

    public function edit($id){
        $data = Product::find($id);
        return view("admin_element.edit",compact("data"));
    }
    public function edit_update(Request $request,$menu_id){
        $inputs = $request->all();
    if($request->hasFile('img')){
        $time     = strtotime(date('Y-m-d H:i:s'));
        $fileType = $request->product_image->extension();
        $fileName = $time . '.' . $fileType;
        $request->img->move(public_path('files/products'), $fileName);
        $inputs['product_image'] = URL::to('/files/products/'.$fileName);
    }
    $data = Product::find($product_id);
        $data->fill($inputs);
        $data->save();
        return redirect('/admin/product');
    }
    public function delete($id){
        $data = Product::find($id);
        $data->delete();
        return redirect('/admin/product');
    }
}