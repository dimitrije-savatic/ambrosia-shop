<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [\App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/about', [\App\Http\Controllers\HomeController::class, 'about'])->name('about');
Route::get('/products', [\App\Http\Controllers\ProductController::class, 'index'])->name('products');
Route::get('/product/{id}', [\App\Http\Controllers\ProductController::class, 'show'])->where('id', '[0-9]+')->name('product');
Route::get('/contact', [\App\Http\Controllers\ContactController::class, 'index'])->name('contact');
Route::post('/contact', [\App\Http\Controllers\ContactController::class, 'contactStore'])->name('contact.store');

//ajax routes
Route::get('/search', [\App\Http\Controllers\ProductController::class, 'search'])->name('search');
Route::get('/products/links', [\App\Http\Controllers\ProductController::class, 'getCategories'])->name('products.links');
Route::get('/products/categories', [\App\Http\Controllers\HomeController::class, 'getProductsByCat'])->name('get.categories');
Route::get('/range', [\App\Http\Controllers\ProductController::class, 'range'])->name('range');
Route::get('/sorting', [\App\Http\Controllers\ProductController::class, 'sorting'])->name('sorting');

Route::middleware(['auth', 'admin'])->group(function () {
//admin
    Route::get('/admin', [\App\Http\Controllers\AdminController::class, 'index'])->name('admin');
    Route::get('/admin/sorting', [\App\Http\Controllers\AdminController::class, 'sorting'])->name('admin.sorting');
//admin contact
    Route::delete('/admin/contact/{id}', [\App\Http\Controllers\ContactController::class, 'contactDelete'])->name('contact.delete');
//admin category
    Route::get('/admin/category', [\App\Http\Controllers\AdminController::class, 'categoryCreate'])->name('category.create');
    Route::post('/admin/category/store', [\App\Http\Controllers\AdminController::class, 'categoryStore'])->name('category.store');
    Route::get('/admin/category/{id}', [\App\Http\Controllers\AdminController::class, 'getCategories'])->where('id', '[0-9]+')->name('admin.category');
    Route::put('/admin/category/{id}', [\App\Http\Controllers\AdminController::class, 'editCategories'])->where('id', '[0-9]+')->name('admin.category.edit');
    Route::delete('/admin/category/{id}', [\App\Http\Controllers\AdminController::class, 'deleteCategory'])->where('id', '[0-9]+')->name('category.delete');

//admin product
    Route::get('/admin/product/create', [\App\Http\Controllers\AdminController::class, 'productCreate'])->name('product.create');
    Route::post('/admin/product/store', [\App\Http\Controllers\AdminController::class, 'productStore'])->name('product.store');
    Route::get('/admin/product/{id}', [\App\Http\Controllers\AdminController::class, 'getProducts'])->where('id', '[0-9]+')->name('admin.product');
    Route::put('/admin/product/{id}', [\App\Http\Controllers\AdminController::class, 'editProducts'])->where('id', '[0-9]+')->name('admin.product.edit');
    Route::delete('/admin/product/{id}', [\App\Http\Controllers\AdminController::class, 'deleteProduct'])->where('id', '[0-9]+')->name('product.delete');
//admin user
    Route::get('/admin/user/{id}', [\App\Http\Controllers\AdminController::class, 'getUsers'])->name('admin.user');
    Route::put('/admin/user/{id}', [\App\Http\Controllers\AdminController::class, 'editUsers'])->name('admin.user.edit');
    Route::delete('/admin/user/{id}', [\App\Http\Controllers\AdminController::class, 'deleteUsers'])->name('admin.user.delete');
});

Route::middleware(['not auth'])->group(function () {
//login
    Route::get('/login', [\App\Http\Controllers\AuthController::class, 'login'])->name('login');
    Route::post('login/post', [\App\Http\Controllers\AuthController::class, 'loginPost'])->name('loginPost');

// register
    Route::get('/register', [\App\Http\Controllers\AuthController::class, 'register'])->name('register');
    Route::post('/register/post', [\App\Http\Controllers\AuthController::class, 'registerPost'])->name('registerPost');

});

Route::middleware('authentication')->group(function (){

// cart
Route::get('/products/cart', [\App\Http\Controllers\CartController::class, 'index'])->name('products.cart');
Route::post('/products/order/{id}', [\App\Http\Controllers\CartController::class, 'orderItem'])->name('products.order');
Route::post('/products/cart/{id}', [\App\Http\Controllers\CartController::class, 'addToCart'])->name('products.addToCart');
Route::delete('/products/cart/{id}', [\App\Http\Controllers\CartController::class, 'deleteCartItem'])->name('products.delete.cartItem');
Route::put('/products/cart/{id}', [\App\Http\Controllers\CartController::class, 'updateCart'])->name('products.update.cartItem');

});

Route::post('logout', [\App\Http\Controllers\AuthController::class, 'logout'])->name('logout')->middleware('auth');


