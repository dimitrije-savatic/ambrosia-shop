<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Faker\Factory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index()
    {

        $products = DB::table('products')->join('categories', 'products.category_id', '=', 'categories.id')->select('products.*', 'categories.name AS c_name')->get();
        $categories = Category::all();
        $bestSellers = Product::where('price', '<', 3)->limit(6)->get();

        return view('pages.home', ["products" => $products, "bestSellers" => $bestSellers, "categories" => $categories]);
    }

    public function about()
    {
        return view('pages.about');
    }

    public function getProductsByCat(Request $request){
        $id = $request->input('id');
        $products = DB::table('products')->select('products.*', 'categories.name AS c_name')->join('categories', 'products.category_id', '=', 'categories.id')->where('category_id', $id)->get();
        $output = '<div class="row g-4">';
        foreach ($products as $product){
            $output .= '<div class="col-md-6 col-lg-4 col-xl-3">
                            <div class="rounded position-relative fruite-item border border-secondary">
                                                <div class="fruite-img">
                                                    <img src="'.asset('assets/img/products/' . $product->image).'"
                                                         class="img-fluid w-100 rounded-top" alt="{{$product->name}}">
                                                </div>
                                                <div class="text-white bg-secondary px-3 py-1 rounded position-absolute"
                                                     style="top: 10px; left: 10px;">'.$product->c_name.'
                                                </div>
                                                <div class="p-4 border-top-0 rounded-bottom">
                                                    <h4>'.$product->name.'</h4>
                                                    <p>'.$product->description.'</p>
                                                    <div class="d-flex justify-content-between flex-lg-wrap">
                                                        <p class="text-dark fs-5 fw-bold mb-0">$'.$product->price.' /
                                                            kg</p>
                                                        <a href="'.route('product', $product->id).'"
                                                           class="btn border border-secondary rounded-pill px-3 text-primary"><i
                                                                class="fa fa-shopping-bag me-2 text-primary"></i> Add to
                                                            cart</a>
                                                    </div>
                                                </div>
                                                </div>
                                            </div>';
        }
        $output .= '</div>';
        return response($output);
    }
}
