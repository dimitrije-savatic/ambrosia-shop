<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\Subcategory;
use http\Env\Response;
use Illuminate\Http\Request;
use Faker\Factory;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{

    public function index()
    {
        $categories = Category::all();
        $sales = Product::select('*')->orderByDesc('price')->limit(3)->get();
        $products = Product::paginate(9);

        return view('pages.products.index', ["products" => $products, 'categories' => $categories, 'sales' => $sales]);
    }


    public function show($id)
    {
        $product = DB::table('products')->join('categories', 'products.category_id', '=', 'categories.id')->select('products.*', 'categories.name AS c_name')->where('products.id', $id)->first();
        return view('pages.products.product-detail', ["product" => $product]);
    }

    public function search(Request $request)
    {
        if ($request->search != "") {
            $products = DB::table('products')->select('*', 'categories.name AS c_name')->join('categories', 'products.category_id', '=', 'categories.id')->where('products.name', 'LIKE', '%' . $request->search . '%')->get();
            $output = $this->getStr($products);
            return response($output);
        }else{

        }
    }

    public function getCategories(Request $request)
    {
        $id = $request->input('id');
        $products = DB::table('products')->select('*', 'categories.name AS c_name')->join('categories', 'products.category_id', '=', 'categories.id')->where('category_id', $id)->get();
        $output = $this->getStr($products);
        return \response($output);
    }

    public function range(Request $request)
    {
        $price = $request->input('price');
        $products = DB::table('products')->select('*', 'categories.name AS c_name')->join('categories', 'products.category_id', '=', 'categories.id')->where('price','<=', $price)->get();
        $output = $this->getStr($products);
        return \response($output);
    }

    public function sorting(Request $request)
    {
        $value = $request->input('value');
        if($value == 'date'){
        $products = Product::orderByDesc('created_at')->get();
            }elseif ($value ==  'price-desc'){
            $products = Product::orderByDesc('price')->get();
        }elseif ($value == 'price-asc'){
            $products = Product::orderBy('price')->get();
        }else{
            $products = Product::paginate(9);
        }
        $output = $this->getStr($products);
        return \response($output);
    }

    /**
     * @param \Illuminate\Support\Collection $products
     * @return string
     */
    public function getStr(\Illuminate\Support\Collection $products): string
    {
        $output = '<div class="row g-4 justify-content-center">';
        foreach ($products as $product) {
            $output .= '<div class="col-md-6 col-lg-6 col-xl-4">
                                    <div class="rounded position-relative fruite-item  border border-secondary">
                                        <div class="fruite-img">
                                            <img src="' . asset('assets/img/products/' . $product->image) . '" class="img-fluid w-100 rounded-top" alt="">
                                        </div>
                                        <div class="text-white bg-secondary px-3 py-1 rounded position-absolute" style="top: 10px; left: 10px;">' . $product->c_name . '</div>
                                        <div class="p-4 rounded-bottom">
                                            <h4>' . $product->name . '</h4>
                                            <p>' . $product->description . '</p>
                                            <div class="d-flex justify-content-between flex-lg-wrap">
                                                <p class="text-dark fs-5 fw-bold mb-0">$' . $product->price . ' / kg</p>
                                                <a href="' . route('product', $product->id) . '" class="btn border border-secondary rounded-pill px-3 text-primary"><i class="fa fa-shopping-bag me-2 text-primary"></i> Add to cart</a>
                                            </div>
                                        </div>
                                    </div>
                                    </div>';
        }
        $output .= '</div>';
        return $output;
    }

}
