<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Category;

class RoleController extends Controller
{
    public function index()
    {

    }

    public function perMission()
    {
        $categories = Category::with('user')->orderBy('updated_at', 'asc')->get();
        return view('admin.components.role.permisstion',compact('categories'));

    }

    public function getProduct(){
    	$shop = Shop::find(2);
    	$name  = ['teo','ti'];
    	$productID= [];
    	foreach ($name as $key => $value) {
    		$product = new Product();
    		$product->name = $value;
    		$product->save();
    		$productID[] = $product->id;
    	}
		$shop->products()->sync($productID);
		dd(1123);
    }

    public function typeHead(Request $request){
        $text = ($request->get('text')) ? ($request->get('text')) :'';
        $product = \App\Article::select('id','content');
        if(count($text) > 0){
            $product = $product->where("content","LIKE","%".$text."%")->orderBy('id','DESC')->take(15)->get();

        }
         return (response($product));
    }
}
