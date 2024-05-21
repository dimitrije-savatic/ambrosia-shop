<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductStoreRequest;
use App\Models\Category;
use App\Models\Contact;
use App\Models\Log;
use App\Models\Product;
use App\Models\Role;
use App\Models\User;
use Faker\Core\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Testing\Fluent\Concerns\Has;
use Mockery\Exception;

class AdminController extends Controller
{
    public function index()
    {
        $logs = Log::orderBy('created_at', 'DESC')->get();
        $categories = Category::all();
        $products = Product::orderBy('created_at', 'DESC')->get();
        $users = DB::table('users')->join('roles', 'users.role_id', '=', 'roles.id')->select('users.*', 'roles.role')->get();
        $contacts = Contact::all();

        return view('pages.admin.index', ["logs" => $logs, "categories" => $categories, "products" => $products, "users" => $users, "contacts" => $contacts]);
    }

    public function sorting(Request $request)
    {
        $value = $request->input('value');
        if($value == 'new'){
            $logs = Log::orderByDesc('created_at')->get();
        }elseif ($value == 'old'){
            $logs = Log::all();
        }else{
            return $output = '';
        }
        $output = '';
        foreach ($logs as $log){
            $output .= '<tr class="row">
                                        <td class="col">
                                            <img src="dist/img/default-150x150.png" alt="Product 1" class="img-circle img-size-32 mr-2">
                                            '.$log->first_name .' '. $log->last_name.'
                                        </td>
                                        <td class="col">
                                                <p>'.$log->message.'</p>
                                        </td>
                                        <td>'.$log->created_at.'</td>
                                    </tr>';
        }
        return $output;
    }

    public function productCreate(){

        $categories = Category::all();

        return view('pages.admin.product-create', ["categories" => $categories]);
    }

    public function productStore(ProductStoreRequest $request)
    {
        $data = $request->only('name', 'price', 'description', 'category_id');
        $imageName = $request->name . '.' . $request->image->extension();
                try{
                    DB::beginTransaction();
                    $newProduct = Product::create($data + ["image" => $imageName]);
                    DB::commit();
                    Log::create([
                        'first_name' => Auth::user()->first_name,
                        'last_name' => Auth::user()->last_name,
                        'message' => "Successfully added a product."
                    ]);
                    return redirect()->back()->with('success', "Product added successfully!");
                }catch(\Exception $e){
                    DB::rollBack();
                    if (\Illuminate\Support\Facades\File::exists(public_path('assets/img/' . $imageName))){
                        \Illuminate\Support\Facades\File::delete(public_path('assets/img/'. $imageName));
                    }
                    return redirect()->back()->with('error', $e->getMessage());
                }
    }

    public function deleteProduct($id){
        try{
            DB::beginTransaction();
            $product = Product::find($id);
            $product->delete();
            DB::commit();
            Log::create([
                'first_name' => Auth::user()->first_name,
                'last_name' => Auth::user()->last_name,
                'message' => "Successfully deleted a product."
            ]);
            return redirect()->back()->with('success', "Product successfully deleted.");
        }catch (\Exception $e){
            DB::rollBack();
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function getProducts($id){
        $product = Product::find($id);
        $categories = Category::all();
        return view('pages.admin.edit-products', ["product" => $product, "categories" => $categories]);
    }

    public function editProducts($id, Request $request){
            $data = $request->only('name', 'price', 'description', 'category_id');
            $conflictProduct = Product::where('name', $request->name)->where('id','!=', $id)->first();
            $product = Product::find($id);
            $category  = Category::where('id', $request->category_id)->first();
            try{
                if ($category == null){
                    return redirect()->back()->with('error', 'You must pick category.');
                }
                if ($conflictProduct != null){
                    return redirect()->back()->with('error', 'Product with same name already exists.');
                }
                if($request->image != null){
                    $imageId = $id . '.' . $request->image->extension();
                    $request->image->move(public_path('assets/img/products'), $imageId);
                }else {
                    $imageId = $product->image;
                }
                DB::beginTransaction();
                Product::find($id)->update(['name' => $request->name, 'price'=> $request->price, 'description'=> $request->description,'image' => $imageId  , 'category_id' => $category->id]);

                DB::commit();
                Log::create([
                    'first_name' => Auth::user()->first_name,
                    'last_name' => Auth::user()->last_name,
                    'message' => "Successfully updated a product."
                ]);
                return redirect()->back()->with('success', 'Changes saved.');
            }catch (\Exception $e){
                DB::rollBack();
                if(\Illuminate\Support\Facades\File::exists(public_path('assets/img/products/'. $imageId))){
                    \Illuminate\Support\Facades\File::delete(public_path('assets/img/'. $imageId));
                }
                return redirect()->back()->with('error', $e->getMessage());
            }

    }

    public function categoryCreate(){


        return view('pages.admin.category-create');
    }

    public function categoryStore(Request $request){
        $name = $request->only('name');
        try{
            DB::beginTransaction();
            $category = Category::where('name' , $request->name)->get();
            if($category->count() > 0){
                return redirect()->back()->with('error', $request->name . ' already exists.');
            }
            $newCategory = Category::create($name);
            DB::commit();
            Log::create([
                'first_name' => Auth::user()->first_name,
                'last_name' => Auth::user()->last_name,
                'message' => "Successfully added a category."
            ]);
            return redirect()->back()->with('success', "Category added successfully!");
        }catch (\Exception $e){
            DB::rollBack();
            return redirect()->back()->with('error', $e->getMessage());
        }
    }



    public function deleteCategory($id)
    {
        try {
            DB::beginTransaction();
            $category = Category::find($id);
            $productsIDs = $category->product()->pluck('id');
            $products = Product::whereIn('id', $productsIDs);
            $products->delete();
            $category->delete();
            Log::create([
                'first_name' => Auth::user()->first_name,
                'last_name' => Auth::user()->last_name,
                'message' => "Successfully deleted a category with their products."
            ]);
            DB::commit();
            return redirect()->back()->with('success', "Category and their products deleted successfully.");
        }catch (\Exception $e){
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function getCategories($id){
        $category = Category::find($id);
        return view('pages.admin.edit-category', ['category' => $category]);
    }

    public function editCategories($id, Request $request){
        try {
            DB::beginTransaction();
            $categoryName = $request->only('name')['name'];
            $categories = Category::where('name', $categoryName)->where('id', '!=', $id)->get();
            if ($categories->count() > 0) {
                return redirect()->back()->with('error', 'Category with same name already exists.');
            }
            Category::find($id)->update(['name' => $categoryName]);
            Log::create([
                'first_name' => Auth::user()->first_name,
                'last_name' => Auth::user()->last_name,
                'message' => "Successfully updated category."
            ]);
            DB::commit();
            return redirect()->back()->with('success', 'Changes saved.');
        }catch(Exception $e){
                DB::rollBack();
                return redirect()->back()->with('error', $e->getMessage());
            }
    }

    public function deleteUsers($id)
    {
        try {
            DB::beginTransaction();
            $user = User::find($id);
            if($user->role_id == 2){
                return redirect()->back()->with('error', 'Admin can not be deleted.');
            }
            $user->delete();
            DB::commit();
            Log::create([
                'first_name' => Auth::user()->first_name,
                'last_name' => Auth::user()->last_name,
                'message' => "Successfully deleted user."
            ]);
            return redirect()->back()->with('success', 'User successfully deleted.');
        }catch (\Exception $e){
            DB::rollBack();
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function getUsers($id)
    {
        $user = User::find($id);
        $roles = Role::all();
        return view('pages.admin.edit-user', ["user" => $user, "roles" => $roles]);
    }

    public function editUsers($id, Request $request)
    {
        $conflictUser = User::where('email', $request->email)->where('id', '!=', $id)->first();
        $role = Role::where('id', $request->role_id)->first();
        $password = $request->password;
        $passwordConfirm = $request->passwordConfirm;
        try{
            DB::beginTransaction();
            $user = User::find($id);
            if($password != $passwordConfirm){
                return redirect()->back()->with('error', 'Passwords must match.');
            }
            if($conflictUser != null){
                return redirect()->back()->with('error', 'User with same email already exists.');
            }
            $user->first_name = $request->first_name;
            $user->last_name = $request->last_name;
            $user->email = $request->email;
            if($request->password){
                $user->password = Hash::make($request->password);
            }
            $user->role_id = $role->id;
            $user->save();
            DB::commit();
            Log::create([
                'first_name' => Auth::user()->first_name,
                'last_name' => Auth::user()->last_name,
                'message' => "Successfully updated user."
            ]);
            return redirect()->back()->with('success', 'Changes saved.');
        }catch(\Exception $e){
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}
